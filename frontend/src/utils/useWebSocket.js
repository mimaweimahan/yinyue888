import { ref, onUnmounted } from 'vue';
import Cache from './cache'
// 创建单例WebSocket实例
class WebSocketService {
  constructor(url) {
    this.websocket = null;
    this.websocketUrl = url;
    this.reconnectTimer = null;
    this.heartbeatTimer = null;
    this.isConnected = ref(false);
    this.message = ref(null); // 用于存储接收到的消息
  }

  // 初始化WebSocket连接
  init() {
    // 关闭已存在的连接
    if (this.websocket) {
      this.websocket.close();
    }

    try {
      this.websocket = new WebSocket(this.websocketUrl);

      // 连接成功回调
      this.websocket.onopen = (event) => {
        console.log('WebSocket 连接成功', event);
        this.isConnected.value = true;

        // 清除重连计时器
        if (this.reconnectTimer) {
          clearTimeout(this.reconnectTimer);
          this.reconnectTimer = null;
        }

        // 启动心跳机制
        this.startHeartbeat();
      };

      // 接收消息回调
      this.websocket.onmessage = (event) => {
        //console.log('收到消息:', event.data);
        this.message.value = event.data;
      };

      // 连接关闭回调
      this.websocket.onclose = (event) => {
        console.log('WebSocket 连接关闭', event);
        this.isConnected.value = false;

        // 如果不是主动关闭，尝试重连
        if (event.wasClean === false) {
          this.reconnect();
        }
      };

      // 连接错误回调
      this.websocket.onerror = (error) => {
        console.error('WebSocket 错误', error);
        this.isConnected.value = false;
        // 发生错误时关闭连接，触发重连
        this.websocket.close();
      };
    } catch (error) {
      console.error('WebSocket 初始化失败', error);
      this.isConnected.value = false;
      this.reconnect();
    }
  }

  // 重连函数
  reconnect() {
    // 如果已经有重连计时器，不重复设置
    if (this.reconnectTimer) return;

    console.log('5秒后尝试重新连接...');
    this.reconnectTimer = setTimeout(() => {
      this.init();
    }, 5000); // 5秒后重连
  }

  // 启动心跳机制
  startHeartbeat() {
    // 清除已有的心跳计时器
    if (this.heartbeatTimer) {
      clearInterval(this.heartbeatTimer);
    }

    // 每10秒发送一次心跳
    this.heartbeatTimer = setInterval(() => {
      if (this.websocket && this.websocket.readyState === WebSocket.OPEN) {
        //console.log('发送心跳');
		let user = Cache.get('user_data');
		let user_id = 0;
		if(user.userInfo?.uid){
			user_id = user.userInfo.uid;
		}
        this.websocket.send(JSON.stringify({ type: 'ping', uid:user_id }));
      }
    }, 10000); // 10秒一次心跳
  }

  // 发送消息
  sendMessage(data) {
    if (this.websocket && this.websocket.readyState === WebSocket.OPEN) {
      try {
        const sendData = typeof data === 'string' ? data : JSON.stringify(data);
        this.websocket.send(sendData);
        return true;
      } catch (error) {
        console.error('发送消息失败', error);
        return false;
      }
    } else {
      console.error('WebSocket 连接未建立，无法发送消息');
      return false;
    }
  }

  // 关闭连接
  close() {
    if (this.websocket) {
      this.websocket.close();
      this.websocket = null;
    }
    if (this.reconnectTimer) {
      clearTimeout(this.reconnectTimer);
      this.reconnectTimer = null;
    }
    if (this.heartbeatTimer) {
      clearInterval(this.heartbeatTimer);
      this.heartbeatTimer = null;
    }
    this.isConnected.value = false;
  }
}

// 创建单例实例
let websocketInstance = null;

// 导出composable函数
export function useWebSocket(url = 'ws://your-websocket-server.com') {
  if (!websocketInstance) {
    websocketInstance = new WebSocketService(url);
  }

  // 组件卸载时清理
  onUnmounted(() => {
    // 这里不关闭连接，因为其他组件可能还需要使用
    // 如果需要在整个应用退出时关闭，可以在根组件中处理
  });

  return {
    websocket: websocketInstance,
    isConnected: websocketInstance.isConnected,
    message: websocketInstance.message,
    sendMessage: (data) => websocketInstance.sendMessage(data),
    reconnect: () => websocketInstance.reconnect()
  };
}
/*
 初始化链接
 <script setup>
 import { onMounted, onUnmounted } from 'vue';
 import { useWebSocket } from './composables/useWebSocket';

 // 初始化WebSocket连接
 const { websocket } = useWebSocket('ws://your-websocket-server.com');

 // 在根组件挂载时建立连接
 onMounted(() => {
   websocket.init();
 });

 // 在根组件卸载时关闭连接（通常是应用退出时）
 onUnmounted(() => {
   websocket.close();
 });
 </script>

 #++++++++++++++++++++++++++++++
 其它页面调用demo

 <template>
   <div class="example-page">
     <h1>示例页面</h1>
     <p>连接状态: {{ isConnected ? '已连接' : '未连接' }}</p>

     <button
       @click="sendTestMessage"
       :disabled="!isConnected"
     >
       发送测试消息
     </button>

     <div v-if="message" class="message-box">
       <h3>收到消息:</h3>
       <pre>{{ message }}</pre>
     </div>
   </div>
 </template>

 <script setup>
 import { useWebSocket } from '../composables/useWebSocket';

 // 引入WebSocket服务
 const { isConnected, message, sendMessage } = useWebSocket();

 // 发送测试消息
 const sendTestMessage = () => {
   const testData = {
     type: 'test',
     content: '这是一条测试消息',
     timestamp: new Date().toISOString()
   };

   const success = sendMessage(testData);
   if (success) {
     console.log('测试消息发送成功');
   }
 };
 </script>
 */
