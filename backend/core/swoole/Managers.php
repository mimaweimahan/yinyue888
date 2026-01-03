<?php
namespace core\swoole;
use app\common\model\User;
use Exception;
use think\Config;
use think\Event;
use think\Request;
use think\swoole\contract\websocket\HandlerInterface;
use think\swoole\Websocket;
use think\swoole\websocket\Event as WsEvent;
use think\swoole\websocket\socketio\EnginePacket;
use think\swoole\websocket\socketio\Packet;
use Swoole\Timer;
use Swoole\Websocket\Frame;
class Managers implements HandlerInterface
{
    /** @var Config */
    protected $config;

    protected $event;

    protected $websocket;

    protected $eio;
    protected $pingTimeoutTimer  = null;
    protected $pingIntervalTimer = null;
    protected $pingInterval;
    protected $pingTimeout;

    public function __construct(Event $event, Config $config, Websocket $websocket)
    {
        $this->event        = $event;
        $this->config       = $config;
        $this->websocket    = $websocket;
        $this->pingInterval = $this->config->get('swoole.websocket.ping_interval', 0);
        $this->pingTimeout  = $this->config->get('swoole.websocket.ping_timeout', 0);
    }

    /**
     * 连接时发送
     * @param Request $request
     */
    public function onOpen(Request $request)
    {
        $this->eio = $request->param('EIO');
        $this->push('Connection successful');
        $this->event->trigger('swoole.websocket.Open', $request);
        $this->onConnect();
    }

    /**
     * 回复信息
     * @param Frame $frame
     */
    public function onMessage(Frame $frame)
    {
        if(isset($frame->data) && $frame->data){
            $_data = json_decode($frame->data, true);
            $this->push(json_encode(['type'=>'message','data'=>$_data['type'].'_'.time()],256));
            if(isset($_data['type']) && $_data['type'] == 'ping' && isset($_data['uid']) && intval($_data['uid']) > 0){
                // 更新在线时间
                $user = User::where('id', $_data['uid'])->field('reg_time,last_login_time,is_online_up,is_online')->find();
                
                if ($user) {
                    $currentTime = time();
                    $lastLoginTime = intval($user->last_login_time);
                    if ($lastLoginTime <= 0) {
                        $lastLoginTime = intval($user->reg_time);
                    }

                    $lastActiveTime = intval($user->is_online_up);
                    $offlineTooLong = $lastActiveTime > 0 ? ($currentTime - $lastActiveTime) > 300 : false;
                    $isNewSession = intval($user->is_online) === 0 || $offlineTooLong;
                    if ($isNewSession) {
                        $lastLoginTime = $currentTime;
                        $user->last_login_time = $currentTime;
                    }

                    $onlineSeconds = max(0, $currentTime - $lastLoginTime);
                    $user->is_online_up = $currentTime;
                    $user->is_online = 1;
                    $user->is_online_time = $this->formatOnlineTime($onlineSeconds);
                    $user->save();
                }
            }
        }
        $this->schedulePing();
    }

    /**
     * "onClose" listener.
     */
    public function onClose()
    {
        Timer::clear($this->pingTimeoutTimer);
        Timer::clear($this->pingIntervalTimer);
        $this->event->trigger('swoole.websocket.Close');
    }

    protected function onConnect($data = null)
    {
        try {
           $this->event->trigger('swoole.websocket.Connect', $data);
            $packet = Packet::create(Packet::CONNECT);
            if ($this->eio >= 4) {
                $packet->data = ['sid' => base64_encode(uniqid())];
            }
        } catch (Exception $exception) {
            $packet = Packet::create(Packet::CONNECT_ERROR, [
                'data' => ['message' => $exception->getMessage()],
            ]);
        }

        $this->push($packet);
    }

    protected function resetPingTimeout($timeout)
    {
        Timer::clear($this->pingTimeoutTimer);
        $this->pingTimeoutTimer = Timer::after($timeout, function () {
            $this->websocket->close();
        });

    }

    protected function schedulePing()
    {
        //$this->push('重置ping超时定时器1');
        Timer::clear($this->pingIntervalTimer);
        $this->pingIntervalTimer = Timer::after($this->pingInterval, function () {
            $this->push(EnginePacket::ping());
            $this->resetPingTimeout($this->pingTimeout);
        });
    }

    public function encodeMessage($message)
    {
        if ($message instanceof WsEvent) {
            $message = Packet::create(Packet::EVENT, [
                'data' => array_merge([$message->type], $message->data),
            ]);
        }

        if ($message instanceof Packet) {
            $message = EnginePacket::message($message->toString());
        }

        if ($message instanceof EnginePacket) {
            $message = $message->toString();
        }

        return $message;
    }

    protected function push($data)
    {
        $this->websocket->push($data);
    }

    /**
     * 格式化在线时长
     * @param int $seconds
     * @return string
     */
    protected function formatOnlineTime(int $seconds): string
    {
        if ($seconds <= 0) {
            return '1分钟';
        }
        $days = intdiv($seconds, 86400);
        $hours = intdiv($seconds % 86400, 3600);
        $minutes = intdiv($seconds % 3600, 60);
        if ($days > 0) {
            return sprintf('%d天%d小时%d分钟', $days, $hours, $minutes);
        }
        if ($hours > 0) {
            return sprintf('%d小时%d分钟', $hours, $minutes);
        }
        return sprintf('%d分钟', max(1, $minutes));
    }
}
