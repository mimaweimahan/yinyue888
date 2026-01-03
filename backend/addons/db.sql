/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:3306
 Source Schema         : cms2022

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 21/09/2022 13:23:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
BEGIN;
INSERT INTO `tp_admin` VALUES (1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '内容ID',
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '发布人ID',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '显示状态[1是,0否]',
  `user_type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '阅读权限（用户类型id）',
  `is_page` tinyint(1) NOT NULL DEFAULT '0' COMMENT '单页内容[1是,0否]',
  `posid` int(11) NOT NULL DEFAULT '0' COMMENT '推荐位ID',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐[1是,0否]',
  `is_exp` tinyint(1) NOT NULL DEFAULT '0' COMMENT '步骤内容[1是,0否]',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重(越大越靠前)',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '封面图',
  `author` varchar(60) DEFAULT NULL COMMENT '作者',
  `source` varchar(60) DEFAULT NULL COMMENT '来源',
  `video` varchar(255) DEFAULT NULL COMMENT '视频',
  `video_time` varchar(255) DEFAULT NULL COMMENT ' 视频时间',
  `tags` varchar(255) DEFAULT NULL COMMENT '标签',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(300) DEFAULT NULL COMMENT '描述',
  `images` text COMMENT '图片集',
  `content` text COMMENT '内容',
  `experience` text COMMENT '经验内容',
  `template` varchar(255) DEFAULT NULL COMMENT '模版',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_link` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为外部连接',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '内容地址',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `yester_day_views` int(11) NOT NULL DEFAULT '0' COMMENT '昨日访问量',
  `day_views` int(11) NOT NULL DEFAULT '0' COMMENT '日访问量',
  `week_views` int(11) NOT NULL DEFAULT '0' COMMENT '周访问量',
  `month_views` int(11) NOT NULL DEFAULT '0' COMMENT '月访问量',
  `hits_update_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='cms内容';

-- ----------------------------
-- Records of tp_article
-- ----------------------------
BEGIN;
INSERT INTO `tp_article` VALUES (12, 1, 0, 0, 0, 1, 0, 0, 0, 0, '用户协议', '', '', '', '', NULL, '用户协议', '用户协议', '用户协议', '', '<p>《巨龙崛起会员注册协议》（“本协议”）并使用本平台服务！</p><p><br/></p><p>巨龙崛起的网站、公众号、小程序、生活号、H5页面等及 巨龙崛起购物商城APP客户端、微信公众号、WAP端等，以及基于第三方平台但由成都乾贞科技有限公司（以下简称“本公司”）提供服务并明确用户需遵循本协议的各类应用、软件、专属频道等 （ 以下统称为 “本平台”）在此特别提醒您仔细阅读（未成年人应在其法定监护人的陪同下阅读）本协议中的各个条款，尤其是以粗体并下划线标示的条款， 包括但不限于免除或者限制 本平台 责任的条款、对用户权利进行限制的条款以及约定争议解决方式、司法管辖的条款。您有权选择同意或者不同意本协议。您与 本平台 均应当严格履行本协议及其补充协议所约定的各项义务，如发生争议或者纠纷，双方可以友好协商解决；协商不成的，任何一方均可向本协议签订地有管辖权的人民法院提起诉讼。本协议签订地为成都市武侯区。</p><p><br/></p><p>&nbsp; &nbsp;您如果通过登录 （ 也包括通过第三方授权登录方式）本平台申请 页面或者 本平台 提供的其他 申请 渠道注册用户账号，完成 本平台 的注册流程 或使用本平台的服务， 即视为您完全同意本协议，愿意接受本协议所有及任何条款的约束。</p><p><br/></p><p>一.&nbsp; 名词解释</p><p>除您与本平台另有约定外，本协议及其补充协议当中的下列名词均采用如下解释：</p><p><br/></p><p>1.本平台 ：指本平台享有全部著作权及其他知识产权的、提供给您及其他用户登录和使用的巨龙崛起购物商城的网站，以及对应的APP 客户端、微信公众号及WAP端多媒体、多应用、多软件服务工具等，以及基于第三方平台但由本公司提供服务并明确用户需遵循本协议的各类应用、软件等 。 本平台由成都乾贞科技有限公司经营，部分服务由关联公司提供，如有必要，本平台将依法在适当场景下披露具体服务主体。</p><p><br/></p><p>2.巨龙崛起特权服务协议 ：即本协议，指您与 本平台 订立的旨在约定您申请巨龙崛起特权、激活、 登录、使用本平台，以及通过本平台下达订单、购买商品、支付货款、收取商品等整个网购过程中，您与 本平台 之间的权利、义务的书面合同。</p><p><br/></p><p>3.商品：是销售商通过本平台向您展示推荐并进行销售的具体商品或服务的统称。</p><p><br/></p><p>4.销售商：可能是本平台的运营主体或关联公司，也可能是入驻巨龙崛起商城的第三方商家。本平台会以恰当方式向您展示相关主体信息。</p><p><br/></p><p>5.&nbsp; 订单：指由本平台生成的记录您通过本平台所购买的商品的名称、品牌、价款、折扣等交易信息的表格。这份文件将被用作所有可能发生的与您购买有关的询问、请求和争议的参考。</p><p><br/></p><p>6.巨龙崛起会员卡号 ：指您通过本平台提供的会员卡 注册渠道，注册获得并可据以登录本平台的会员卡号 。</p><p><br/></p><p>7.本平台规则：本平台在平台内已经发布及后续发布的各类规则、实施细则、解读、产品流程说明、公告等。</p><p><br/></p><p>8.&nbsp; 推广奖励：指本平台举办的基于商家或用户的真实有效的推广分享等行为而承诺用户支付的一定奖励， 用户同意并确认， 用户应基于其分享推广行为与巨龙崛起平台或优品平台委托的第三方公司建立推广服务合作关系，并确认与巨龙崛起平台或巨龙崛起平台合作的 第三方公司签署附件的服务协议，奖励收益由优品平台或优品平台合作的第三方公司进行费用结算。 具体的合作协议内容、奖励规则、 以及领取方式等请以本平台内 “我的”---“返现中心”展示的具体协议及规则为准 。</p><p><br/></p><p><br/></p><p>二.&nbsp; 用户使用本平台规则</p><p><br/></p><p>1. 您确认，在您开始 申请注册本平台会员， 使用 本平台 服务前，您应当具备中华人民共和国法律规定的与您行为相适应的民事行为能力。 若您不具备前述与您行为相适应的民事行为能力，则您的监护人应依照法律规定承担因此而造成的一切后果。 此外，您还需确保您不是任何国家、国际组织或者地域实施的贸易限制、制裁或其他法律、规则限制的对象，否则您可能无法正常注册及使用 本平台 服务。</p><p><br/></p><p><br/></p><p><br/></p><p>2. 您可以通过登录本平台会员申请页面申请本平台会员卡，并按照相应指引激活会员权益，一经激活，您即可以凭借卡号及登录密码，或采用本平台提供的其他登录方式登录及使用本平台。</p><p><br/></p><p><br/></p><p><br/></p><p>3.您成功获取会员卡后，需要绑定一个手机号码。如果需要从本平台购买商品的，还应当填写一个收货人、收货地址。除此之外，您还可以按照本平台相关页面的说明填写 其他个人信息，上述个人信息 的填写并非您购买商品所必须，您可以选择填写与否。为使您更好地使用本平台的各项服务，保障您的账户安全，本平台可要求您按要求及我国法律规定完成实名认证。</p><p><br/></p><p>4 .本平台原则上只允许每位用户使用一个本平台账户。如有证据证明或根据本平台规则判断您存在不当注册或不当使用多个本平台账户，或您的账号来源于此类不当行为的情形，本平台 可以采取冻结或关闭账户、取消订单、拒绝提供服务等措施，如给 本平台 及相关方造成损失的，您还应承担赔偿责任 。</p><p><br/></p><p>5 .&nbsp; 您务必妥善保管您的 会员卡号 、登录密码、支付密码（如有）及您填写的所有个人信息。账户因您主动泄露或因您遭受他人攻击、诈骗等行为导致的损失及后果，本平台并不承担责任，您应通过司法、行政等救济途径向侵权行为人追偿。除本平台存在过错外，您应对您账户项下的所有行为结果（包括但不限于在线签署各类协议、 提供 信息、购买商品及服务 、 发表评论、售后处理决定 等）负责。</p><p><br/></p><p>6 . 为了防止您及其他用户的 会员卡号 及其项下的个人信息泄露或者被他人窃取， 本平台 可能会随时采取计算机病毒查杀技术、计算机加密技术等措施进行保护。对此，您完全同意并接受，但这并不能免除您对 会员卡号 及其项下的个人信息所负有的妥善保管义务。</p><p><br/></p><p>7 . 由于 本平台 会员卡号 关联您的个人信息及平台商业信息，您的 本平台 会员卡号 仅限您本人使用。否则本平台有权追究您的违约责任。</p><p><br/></p><p>8 .&nbsp; 您充分理解并完全同意： 根据您的 会员卡号及该卡号绑定的手机号项下 下的商品购买记录及其他相关信息，销售商如果发现或者合理怀疑您此前或者当次通过本平台提供的 网购 渠道购买的商品有出现并非用于个人消费或者使用用途的情形，对于您的这个用户账号的商品购买需求，销售商有权不予接受；您如果已经下达订单，销售商有权不予接受订单；销售商如果已经接受订单的，有权单方面解除并不予发货。而且， 本平台 视情况还有权冻结您的这个用户账号，使之无法通过本平台以及 本平台 提供的网购渠道下达订单、购买商品。</p><p><br/></p><p>9. 平台发现您参与相关促销、拉新或其他各类平台活动存在虚假交易、刷单等行为，平台有权按照 * 虚假交易规则 及活动规则做出惩戒处理，包括但不限于取消分佣等奖励、冻结账号、移交公安机关追究刑事责任等。</p><p><br/></p><p><br/></p><p>10.&nbsp; &nbsp;您可以通过本平台申请 注销 本平台会员卡 。 我们在此善意的提醒您， 您注销 会员卡 的行为 将会导致您在本平台的会员权益一并注销， 会给您的售后维权带来诸多不便。您知晓，根据法律法规规定，相关交易记录可能须在平台后台保存 5 年甚至更长时间。 经 本平台 确认您的账户满足以下条件的，您的账户将被注销：</p><p><br/></p><p>（1） 账户无任何纠纷，包括投诉举报 、 被投诉举报 及诉讼 ；</p><p><br/></p><p>（2） 账户为正常使用中的账户且无任何账户被限制的记录；</p><p><br/></p><p>（3） 账户内无未完成的订单、服务；</p><p><br/></p><p>（4） 账户已经解除与其他网站、其他 APP 的授权登录或绑定关系。 一旦您的个人帐户注销，您将无法登录、使用 本平台 账户，您也将无法找回您账户中及与账户相关的任何 记录、 内容或信息，在您的会员期间累积的积分、及代金券也将不复存在。如果您希望日后再次加入 本平台 ，您理解并同意，本平台无法协助您重新恢复前述服务。 同时，为保障您的个人合法权益，本平台严格依照法律法规规定的内容为您提供账户注销服务。但若您恶意利用法律赋予的用户注销权利，在一定时间内重复注销、新注册等有损平台运营资源行为的，本平台有权对您的账号采取取消新用户奖励权益等的止损措施。故 请您在提交注销申请前，务必先了解须解绑的其他相关账户信息，具体可与 本平台 的客服联系。</p><p><br/></p><p>三． 商品描述与营销信息</p><p>1 . 商品描述：相关商品信息均由销售商提供， 本平台 尽可能根据所接收到的商品信息准确、详尽地描述每一件商品。然而，由于销售商所提供的商品 信息 不一定是准确、完整、可靠、有效和没有错误的，因此 本平台 不能保证本平台所有商品的描述和其他相关内容是准确、完整、可靠、有效和没有错误的。</p><p><br/></p><p>2 . 营销信息：您一经注册 会员卡 ，即视为您同意 本平台 通过短信 、 微信 或者电子邮件的方式向您注册时填写的手机号码或者电子邮箱发送相应的商品广告信息、促销优惠等营销信息；您如果不同意发送 ，您可以通过相应的退订功能进行退订。</p><p><br/></p><p>四． 商品价格</p><p>除适用于海外消费的折扣券以外， 本平台上显示的所有价格都是以人民币为计价单位，包括所有的税费，但不包括运费 （ 除非特殊说明） 。结帐之前运费会自动计算包含在订单总价之内。在商品详情页面里您可以找到所有的相关信息，支付价格为下订单时的有效价格。 跨境电商的商品，请以商品详情页面告示的价格方式为准。</p><p><br/></p><p>五 .订单&nbsp; &nbsp;</p><p><br/></p><p>1 .&nbsp; 本平台 保留对单个商品的 区域出售 数量 、 规格 进行限制 的权利，有权 对单个订单的商品购买数量及同 一 IP地址对同类商品购买数量 、 规格 进行限制。</p><p>2 .&nbsp; &nbsp;根据您填写的订单信息，系统将会生成一份包含您的订单的必要信息的电子订单 ， 是该次交易的有效证据，这份文件被认为是所有的发货、问题、退货和争议事项的参考，所以您必须非常仔细地 查看清楚 这些信息并纠正一切可能的错误。点击“ 去结算 ” 意味着您认可订单表格中包含的所有信息都是正确和完整的。</p><p>3 .&nbsp; &nbsp;如果您填写的收货人与用户本人不一致的，收货人的行为和意思表示视为您的行为和意思表示，您应对收货人的行为及意思表示的法律后果承担连带责任。</p><p>4 . 您可以选择取消订单， 对反复的取消行为，我们可能会 通过大数据分析 调查其原因， 为维护合理的商业利益，也为给正常消费者提供更多交易机会，我们 可能会 因您多次反复取消订单行为而 拒绝 继续 向您提供服务、冻结或关闭您的 会员账号 。</p><p>5.针对活动的促销、分销订单，平台已建立相应的风控机制，在基于平台风控规则被判定为虚假交易/刷单行为的，不论您是销售商还是用户，平台有权取消相关订单，不对佣金进行结算并视具体情节决定追究民事、刑事责任。</p><p><br/></p><p>六 .合同成立</p><p>您理解并同意： 本平台上销售商展示的商品和价格等信息仅仅是要约邀请 ，当您作为消费者为生活消费需要下单时须填写您希望购买的商品数量、价款及支付方式、收货人、联系方式、收货地址（合同履行地点）、合同履行方式等内容； 系统生成的订单信息是计算机信息系统根据您填写的内容自动生成的数据，仅是您向销售商发出的合同要约 ；销售商收到您的订单信息后， 只有在销售商将您订单状态更改为已发货状态，方视为您与销售商之间就实际直接向您发出的商品建立了合同关系 ；如果您在一份订单里订购了多种商品并且销售商只给您发出了部分商品时，您与销售商之间仅就实际直接向您发出的商品建立了合同关系， 只有在销售商实际直接向您发出了订单中订购的其他商品时，您和销售商之间就订单中其他已实际直接向您发出的商品才成立合同关系 ；对于电子书、数字音乐、在线手机充值等数字化商品，当您作为消费者为生活消费需要下单并支付货款后合同即成立。</p><p><br/></p><p>七 .商品缺货</p><p>由于市场变化 、 技术原因 及各种以合理商业努力难以控制因素的影响，无法避免的会出现您提交的订单信息中的商品出现缺货、价格标示错误等情况 。 如您下单所购买的商品出现以上情况，您有权取消订单，销售商亦有权自行取消订单，若您已经付款，则将为您办理退款。</p><p><br/></p><p>八．配送服务</p><p>您所订购的商品有两种配送方式：（1）由 本平台 选择具有运输服务资质的公司为您提供运输代理服务；（2）由销售商选择具有提供运输服务资质的公司为您提供运输代理服务。 基于配送合作、配送秩序的考虑，原则上本平台及销售商无法按照您的指定由某个物流服务商进行配送，除非本平台页面有明确说明。</p><p><br/></p><p>九．商品收取</p><p>1 . 您所订购的商品将被送至订单表格上注明的送货地址。无论什么原因商品不能送达到送货地址的，销售商将会尽快跟您取得联系。假如从销售商第一次试 图跟您联系之日 7天内您没有提供答复，销售商 有权 取消该订单。 对于生鲜品类商品，因配送时间的耽误，商品极有可能已经损坏，故我们将不再退回您已支付的所有款项；对于其他商品，我们将收取来回的快递费。&nbsp; &nbsp;</p><p><br/></p><p>2 . 在您收到订购商品时，您书面签收则证明您收到了完好状态的商品。如果 包装出现破损，请拒收。</p><p><br/></p><p>3 . 您在本平台购买的商品由配送公司为您完成订单交付的，系统或者单据记录的签收时间为交付时间；您购买的商品采用在线传输方式交付的，销售商向您指定系统发送的时间为交付时间；您购买服务的，生成的电子或者实物凭证中载明的时间为交付时间。</p><p><br/></p><p>4 . 如果您收到的商品与送货单中的商品列表不符，您可以按照本平台对外公布且正在实施的退货政策及退货程序，将相应的商品退回销售商 。</p><p><br/></p><p>十． 退回订单&nbsp; &nbsp;</p><p><br/></p><p>1.对于适用七天无理由退货的商品， 您如果需要退货的，请 在 收到商品之日起 7 天内，按照不影响商品正常使用及再次销售的原则，将您需要退货的商品及其包装、赠品、送货单、税务发票（如有）等送货时一并交付给您的物品和资料，全部完好无损地退回销售商。否则，销售商有权不予退货。除有相反的证据外，退货的日期以销售商收到的包裹上显示的寄出邮戳所显示的日期为准。 对于某些商品，如在商品详情页面及有关退货政策中已提示该类商品不予以退货的，您的下达订单行为将被视为您已同意接受销售商对此类商品不予退货的安排。</p><p><br/></p><p>2. 销售商有权拒绝不符合 本平台 对外公布实施的退货政策所规定的条件的所有退货。仅当销售商确认以上规定的这些条款得到了适时的遵从后，才会启动返还货款金额的程序 。</p><p><br/></p><p>3.如果您的退货与上述退货规定不符，您将 无法 得到任何退款。不过， 您仍有资格自行支付费用（包括运费）以便接收已经退回到销售商的商品。如果您不想接收已经退回到销售商的商品，销售商有权保有这些商品并保留已经收到 的金额。</p><p><br/></p><p><br/></p><p>十一． 知识产权 及不当技术行为</p><p><br/></p><p>1. 本平台 对平台的内容享有全部知识产权，包括但不限于：编码、商标、 服务标志、商号、图形、美术品、照片、肖像、文字内容、音频片断、按钮图标 以 及计算机 软件、标识、数码下载、数据汇编 、 评论 都是 本平台 或其内容提供者的财产，受到中华人民共和国版权相关法律法规的保护。</p><p><br/></p><p>2.您仅在符合本平台使用目的的前提下被许可浏览和使用本平台，即以个人名义浏览信息和购买供个人使用商品的目的。 禁止 其他方式的使用 ， 包括但不 限于以下方式：复制、修改、销售、传送、再版、删除、添加、展览、记入或演示本平台的内容或以其他方式部分地或整体地非法使用本平台的内容，但 基于宣传、分享本平台及商品，且 经 本平台 允许将本平台当中的资讯转发至微信朋友圈等第三方媒体的除外。</p><p><br/></p><p><br/></p><p>3.您不得进行任何侵犯本平台或其他用户合法权益的行为， 本平台保留追究您法律责任的权利。这些将被追究法律责任的行为 包括但不限于：&nbsp; &nbsp;</p><p><br/></p><p>（ 1 ）修改、复制和/或发行本平台；</p><p><br/></p><p>（ 2 ）进行编译、反编译、反向工程或者以其他方式破解本平台的行为；</p><p><br/></p><p>（ 3 ）使用本平台外挂和/或利用本平台当中的 BUG 来获得不正当的利益； （ 4 ）利用劫持域名服务器等技术非法侵入、破坏本平台的服务器软件系统，非法挤占本平台的服务器空间，或者实施其他的使之超负荷运行的行为；</p><p><br/></p><p>（ 5） 修改、增加、删除、窃取、截留、替换本平台的客户端和/或服务器软件系统中的数据 ；</p><p><br/></p><p>（ 6 ）假冒 本平台 或签约商家在本平台当中发布任何诈骗或虚假信息；</p><p><br/></p><p>（ 7 ）在本平台当中内置插件程序或者其他的第三方程序；</p><p><br/></p><p>（ 8 ）利用本平台故意传播恶意程序或计算机病毒 ；</p><p><br/></p><p>（ 9）利用爬虫程序或其他类似技术对本平台上的数据、信息、用户信息进行爬取及引用。</p><p><br/></p><p>十二 .用户 行为 守则</p><p><br/></p><p>1.您如果需要进行下载、安装、 运行、登录或者使用 本平台 ，您至少必须自备一部可供上网的 电脑或 智能移动终端，并确保其能够通过互联网与本平台服务器软件进行实时的信息（即电子数据）交互，相应的上网流量费等相关费用由您自行承担。除非另有说明， 本平台 存储在其服 务 器上的数据是 本平台 和其会员之间交易的唯一有效证据。</p><p><br/></p><p>2.本平台的发放及本平台 目前免费使用 ， 仅收取本平台寄送过程中的快递费用 。 本平台 有权 基于运营成本等考虑， 设置收费 标准或服务 、费率标准、收费对象及/或收费时段。您如果不同意 相关 收费，则应当立即停止使用本平台； 您如果继续使用的，则视为您接受 本平台 的上述设置并支付相应的费用。</p><p><br/></p><p>3.您充分理解： 本平台 可能会不定期地通过发布软件升级包或软件补丁、 在线升级等方式对本平台进行更新。更新的过程中， 本平台 可能通过互联网调取、 收集您的终端上的关于本平台的客户端软件版本信息、数据及其他有关资料，并自动进行替换、修改、删除和/或补充。此种行为是平台更新所必须的一种操作或步骤，您如果不同意 本平台 进行此种操作，请您不要进行更新；您更新的行为即视为您同意 本平台 进行此种操作。</p><p><br/></p><p>4.在本平台开放评论专区的情况下， 您有权在本平台当中发表评论，或者回复其他用户的评论， 但您应确保评论真实、客观且不会侵犯任何第三方的著作权、肖像权、名誉权、隐私权等合法权利。而且，您不得借助本平台用户评论功能发布任何广告。</p><p><br/></p><p>5.您应当遵守国家有关法律法规，不得在本平台当中发表、转发或者传播含有下列内容的信息：</p><p><br/></p><p>（1）反对宪法所确定的基本原则的；</p><p><br/></p><p>（2）危害国家安全、泄露国家秘密、颠覆国家政权、破坏国家统一的；</p><p><br/></p><p>（3）损害国家荣誉和利益的；</p><p><br/></p><p>（4）煽动民族仇恨、民族歧视，破坏民族团结的；</p><p><br/></p><p>（5）破坏国家宗教政策，宣扬邪教和封建迷信的；</p><p><br/></p><p>（6）散布谣言，扰乱社会秩序，破坏社会稳定的；</p><p><br/></p><p>（7）散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；</p><p><br/></p><p>（8）侮辱或者诽谤他人，侵害他人合法权益的；</p><p><br/></p><p>（9）含有法律、行政法规禁止的其他内容的。</p><p><br/></p><p><br/></p><p>6.&nbsp; 您充分理解并完全同意：对您在本平台当中发表、转发或者传播的评论及其内容，包括但不限于视频、照片、文字内容，不论是否属于著作权法意义上的作品， 本平台 均享有永久的、无期限及地域限制的、完全免费的使用权。而且， 对于上述评论和/或内容， 本平台 还享有下列各项权利，且实际行使时无须另行 征得您的同意：</p><p><br/></p><p>（1）有权将其许可给任何第三方使用，被许可的第三方征得 本平台 同意后，既可以将其使用于 本平台 网站和/或其 App 等 本平台 自有网络平台，也可以将其使用于被许可的第三方自有的网络平台。</p><p><br/></p><p>（ 2） 有权对其进行修改、编辑、汇编、改编、分发或者以其他的方式进行使用；</p><p><br/></p><p>（ 3 ）既有权使用其全部内容，也有权使用其中的某一部分或某几部分内容；</p><p><br/></p><p>（4）有权单独以自己的名义，对未经 本平台 许可而擅自使用上述评论和/或内容的第三方进行取证、证据保全、公证、提起诉讼和/或依法采取其他合法措施，以追究其法律责任。</p><p><br/></p><p>7.&nbsp; &nbsp;巨龙崛起卡是 本平台 授权您使用 本平台 的唯一凭证。 本平台 所提供优惠均发放 至该会员卡项下 ，并且仅提供给获得授权的用户个人使用。您同意在符合法律法规及本条款规定的情况下使用个人帐户， 本平台 有可能在某些情况（包括但不限于您违反有关法律法规规定或本协议和/或其它公开规则，或者您严重违背社会公德、提供虚假注册身份信息、经 本平台 判定认为存在恶意退货或不合常理的高退货率等情形、或其他损害或经本平台判定认为可能损害 本平台 利益的不正当行为等）下暂时冻结、永久冻结、修改、删除您的个人账户或者采取其他处理措施。 特别地， 您了解并同意， 本平台 用户管理系统中个人帐户、积分、代金券等互联网产品及服务所有权归属 于本平台 ，会员在满足 本平台 公布的规则的前提下有权使用上述产品及服务。非经 本平台 同意，您不得将 本平台 各项产品及服务用于商业用途（例如：销售 本平台会员卡 、销售 会员卡 帐户下积分、代金券等）。在使用 本平台 服务过程中，如果您或您的个人帐户刻意规避 本平台 管理措施，或存在涉嫌欺诈、商业牟利、不恰当地使用服务或者其他违反本协议和/或其他公开规则的行为（包括但不限于使用作弊软件获取积分及/ 或代金券 、 分佣奖励、各类活动奖励 及/或贩卖个人帐号、积分及/或代金券、盗号、 协助盗号、非用于个人或家庭的合理消费 、 恶意购买、恶意维权 等）， 本平台 有权拒绝为您继续提供服务，永久冻结您的个人帐户，并根据具体情况有权对该等个人帐号中因上述手段而产生、获得的一切虚拟产品予以清零 ， 有权对您的行为追究您的违约或侵权法律责任乃至刑事责任 。 本平台采取上述行动无需事先通知您。&nbsp; &nbsp;</p><p>8. 如您的行为使 本平台 及/或其关联公司遭受损失（包括自身的直接经济损失、商誉损失及对外支付的赔偿金、和解款、律师费、诉讼费等间接经济损失）， 您应赔偿 本平台 及/或其关联公司的上述全部损失。 如您的行为使 本平台 及/或其关联公司遭受第三人主张权利， 本平台 及/或其关联公司可在对第三人承担金钱给付等义务后就全部损失向您追偿。如因您的行为使得第三人遭受损失， 本平台 及/或其关联公司出于社会公共利益保护或消费者权益保护目的，可自您的任何 本平台 账户中划扣相应款项进行支付。</p><p><br/></p><p>十三、 免责声明</p><p>1.&nbsp; &nbsp;本平台与其他的在线使用的互联网网站一样，也会受到各种不良信息、 网络安全和网络故障问题的困扰，包括但不限于：</p><p><br/></p><p>（1） 其他用户可能会发布诈骗或虚假信息，或者发表有谩骂、诅咒、诋毁、攻击内容的，或者含有淫秽、色情 、 下流、反动、煽动民族仇恨等让人反感、厌恶 的内容的非法言论；</p><p><br/></p><p>（2） 其他用户可能会发布一些侵犯您或者其他第三方知识产权、肖像权、姓名权、名誉权、隐私权和/或其他合法权益的图片、照片、文字等资料；</p><p><br/></p><p>（3） 面临着诸如黑客攻击、计算机病毒困扰、系统崩溃、网络掉线、网速缓慢、程序漏洞等问题的困扰和威胁。</p><p><br/></p><p>2.&nbsp; 您充分理解到： 上 述的各种不良信息、网络安全和网络故障问题，并不是 本平台 或者本平台所导致的问题，您造成的任何损失，概由您自行承担， 本平台 无须向您承担任何责任。</p><p><br/></p><p>3.&nbsp; 您完全同意：除法律法规规定或者您与巨龙崛起平台约定须提前通知的以外，巨龙崛起平台在解散、注销、合并、分立，或巨龙崛起运营公司 将本平台或其运营权转让给了第三方， 或 国家法律、法规、政策及国家机关的命令或者 发生 其他的诸如地震、火灾、海啸、台风、罢工、战争等不可抗力事件， 或 因您违反本协议所约定的用户守则 等原因，可单方中止或终止本协议的履行 。 本平台将及时通知您。</p><p><br/></p><p><br/></p><p>4.&nbsp; 关于商品销售的免责声明 ：</p><p><br/></p><p>（1） 不同手机终端设备观看页面 会存在 显示 上的 差异， 本平台 上 展示 的商品在图像 、 颜色可能 与实物存在差异 。因此，所有显示的图片、视频和其他商品显示方法仅限于图示目的，在任何情况下不认为是合同的组成部分。</p><p><br/></p><p>（2） 销售商保留根据市场价格波动随时修改上线商品价格的权利而无须事 先通知您。在由于排版错误或销售商提供价格信息错误的情况下以不正确的价 格列出来的商品，销售商有拒绝或取消任何对以不正确的价格列出来的商品所 下订单的权利。</p><p><br/></p><p>（3） 由于合理的或不可避免的送货延迟对您或第三方带来的任何损失， 本平台 不负任何责任。</p><p><br/></p><p><br/></p><p>十四． 个人信息保护</p><p><br/></p><p>1 .&nbsp; &nbsp;本平台 可能通过本平台在您自愿选择服务或提供信息的情况下收集您的 个人信息（简称“个人信息”） 。 为了更好帮助您理解我们在保护个人信息保护方面的规则，您可以查看我们在本平台公示的《巨龙崛起用户隐私权政策》进行了解。该政策是本协议的一部分，与本协议具有同等法律效力。</p><p><br/></p><p>2.本平台使用各种安全技术和程序防止您的个人信息的丢失、不当使用、未经授权阅览或披露。但您充分理解并同样：由于技术的局限以及可能存在的各种恶意手段，在互联网行业，即便竭尽所能加强安全措施，也不可能始终保证信息绝对的安全。</p><p><br/></p><p>十五．通知 与送达</p><p><br/></p><p>1 .&nbsp; 联系方式 ： 您在注册成为 本平台会员 ，并接受 本平台 服务时，您应该向 本平台 提供真实有效的联系方式 ， 对于联系方式发生变更的，您有义务及时更新有关信息，并保持可被联系的状态。 您在注册 申请本平台会员 时生成的用于登陆 本平台 接收站内信、您指定的邮寄地址为您的法定联系地址或您提供的有效联系地址。您同意司法机关可采取以上一种或多种送达方式向您达法律文书，司法机关采取多种方式向您送达法律文书，送达时间以上述送达方式中最先送达的为准。 您同意上述送达方式适用于各个司法程序阶段。如进入诉讼程序的，包括但不限于一审、二审、再审、执行以及督促程序等。 您 应当保证所提供的联系方式是准确、有效的，并进行实时更新。如果因提供的联系方式不确切，或不及时告知变更后的联系方式，使法律文书无法送达或未及时送达，由您自行承担由此可能产生的法律后果。消息的 会员卡卡号 （包括子账号），也作为您的有效联系方式。 本平台 将向您的上述联系方式的其中之一或其中若干向您送达各类通知，而此类通知的内容可能对您的权利义务产生重大的有利或不利影响，请您务必及时关注。 本平台 通过上述联系方式向您发出通知，其中以电子的方式发出的书面通知，包括但不限于在 本平台 公告，向您提供的联系电话发送手机短信，向您提供的电子邮件地址发送电子邮件，向您的账号发送系统消息以及站内信信息，在发送成功后即视为送达；以纸质载体发出的书面通知，按照提供联系地址交邮后的第五个自然日即视为送达。 对于在 本平台 上因交易活动引起的任何纠纷，您同意司法机关（包括但不限于人民法院）可以通过手机短信、电子邮件等现代通讯方式或邮寄方式向您送达法律文书（包括但不限于诉讼文书）。您指定接收法律文书的手机号码、电子邮箱等联系方式为您在 本平台 注册、更新时提供的手机号码、电子邮箱联系方式，司法机关向上述联系方式发出法律文书即视为送达。</p><p><br/></p><p>十六． 其他约定&nbsp; &nbsp;</p><p><br/></p><p>1 .&nbsp; &nbsp;本平台 保留随时地不需要任何理由地、单方面地修订本协议的权利。本协议一经修订即完全替代修订前的协议版本，并通过适当的方式向所有用户公开征求意见，您可以通过平台指定的方式 向我们 反馈意见。如果您不同意修订后协议版本，请您立即停止使用本平台，否则即视同您同意并完全接受修订后的协议版本。&nbsp; &nbsp;</p><p><br/></p><p>2 .&nbsp; 由于互联网高速发展，您与 本平台 签署的本协议列明的条款并不能完整覆盖您与巨龙崛起平台所有权利与义务，现有的约定也不能保证完全符合未来发展的需求。因此，本平台 隐私权政策、 本平台 规则均为本协议的补充协议，与本协议不可分割且具有同等法律效力。如您使用 本平台 服务，视为您同意上述补充协议。</p><p><br/></p><p>3 .&nbsp; 您与 本平台 均应当严格履行本协议及其补充协议所约定的各项义务，如发生争议或者纠纷，双方可以友好协商解决；协商不成的，任何一方均可向本协议签订地有管辖权的人民法院提起诉讼。</p><p><br/></p><p>5 .本协议及其补充协议签订地为广东省广州市 海珠 区，均受中华人民共和国 法律、法规管辖。&nbsp; &nbsp;</p><p><br/></p>', NULL, NULL, 1656926618, 1657033633, 0, '/article/zcxy.html?cat_id=1', 0, 0, 0, 0, 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for tp_article_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_article_data`;
CREATE TABLE `tp_article_data` (
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '内容ID',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='内容副表';

-- ----------------------------
-- Records of tp_article_data
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `pid` mediumint(9) NOT NULL DEFAULT '0',
  `sort` mediumint(9) NOT NULL DEFAULT '0' COMMENT '排序',
  `module` varchar(20) NOT NULL DEFAULT 'admin' COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) DEFAULT NULL COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` text COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='角色';

-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
BEGIN;
INSERT INTO `tp_auth_group` VALUES (1, 0, 1, 'admin', 1, '超级管理员', '默认全部权限，不需要再配置权限', 1, '24,32,34,35,38,40,41,42,100,102,103');
INSERT INTO `tp_auth_group` VALUES (2, 0, 0, 'admin', 1, '运营', '运营人员', 1, NULL);
COMMIT;

-- ----------------------------
-- Table structure for tp_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group_access`;
CREATE TABLE `tp_auth_group_access` (
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户组id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色关系';

-- ----------------------------
-- Records of tp_auth_group_access
-- ----------------------------
BEGIN;
INSERT INTO `tp_auth_group_access` VALUES (1, 1);
INSERT INTO `tp_auth_group_access` VALUES (2, 1);
COMMIT;

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '父级',
  `sort` mediumint(9) NOT NULL DEFAULT '0' COMMENT '排序',
  `module` char(20) NOT NULL DEFAULT '' COMMENT '规则所属module',
  `icon` char(20) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-只为菜单;1-认证规则+菜单;2认证+主菜单',
  `name` char(80) DEFAULT NULL COMMENT '规则唯一英文标识',
  `title` char(20) DEFAULT NULL COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示 1显示 0 不显示',
  `note` varchar(255) DEFAULT NULL,
  `condition` varchar(300) DEFAULT NULL COMMENT '规则附加条件',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `module` (`module`,`status`,`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=368 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='菜单权限';

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
BEGIN;
INSERT INTO `tp_auth_rule` VALUES (4, 45, 0, 'admin', NULL, 1, 'admin/user.index/view', '详情', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (5, 23, 0, 'admin', NULL, 1, 'admin/index/main', '管理面板', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (6, 23, 0, 'admin', NULL, 1, 'admin/index/index', '管理首页', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (7, 8, 0, 'admin', NULL, 1, 'admin/log/delete', '删除', 1, 1, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (8, 23, 0, 'admin', NULL, 1, 'admin/log/index', '日志', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (9, 72, 0, 'admin', NULL, 1, 'admin/config/save', '保存配置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (10, 23, 0, 'admin', NULL, 1, 'admin/index/public_icon', '系统图标', 1, 1, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (11, 25, 4, 'admin', NULL, 1, 'admin/user.record/index', '账户明细', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (23, 0, 100, 'admin', '#xe61a;', 1, 'admin/config/init', '系统管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (24, 0, 10, 'admin', '#xe637;', 1, 'admin/admin/init', '管理员管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (25, 0, 1, 'admin', '#xe649;', 1, 'admin/user/init', '用户管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (26, 23, 1, 'admin', NULL, 1, 'admin/rule/index', '菜单规则', 1, 1, '规则通常对应一个控制器的方法,同时左侧的菜单栏数据也从规则中体现,通常建议通过命令行进行生成规则节点', '');
INSERT INTO `tp_auth_rule` VALUES (27, 26, 0, 'admin', NULL, 1, 'admin/rule/add', '新增', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (28, 26, 0, 'admin', NULL, 1, 'admin/rule/edit', '编辑', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (29, 26, 0, 'admin', NULL, 1, 'admin/rule/delete', '删除', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (30, 26, 0, 'admin', NULL, 1, 'admin/rule/show', '状态设置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (31, 26, 0, 'admin', NULL, 1, 'admin/rule/sort', '排序', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (32, 24, 0, 'admin', NULL, 1, 'admin/admin/index', '成员管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (33, 32, 0, 'admin', NULL, 1, 'admin/admin/add', '新增', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (34, 32, 0, 'admin', NULL, 1, 'admin/admin/edit', '编辑', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (35, 32, 0, 'admin', NULL, 1, 'admin/admin/delete', '删除', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (36, 32, 0, 'admin', NULL, 1, 'admin/admin/status', '状态设置', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (37, 32, 0, 'admin', NULL, 1, 'admin/admin/sort', '排序', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (38, 24, 0, 'admin', NULL, 1, 'admin/group/index', '角色管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (39, 38, 0, 'admin', NULL, 1, 'admin/group/add', '新增', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (40, 38, 0, 'admin', NULL, 1, 'admin/group/edit', '编辑', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (41, 38, 0, 'admin', NULL, 1, 'admin/group/delete', '删除', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (42, 38, 0, 'admin', NULL, 1, 'admin/group/status', '状态设置', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (43, 38, 0, 'admin', NULL, 1, 'admin/group/sort', '排序', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (44, 26, 0, 'admin', NULL, 1, 'admin/rule/icon', '图标设置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (45, 25, 1, 'admin', NULL, 1, 'admin/user.index/index', '用户列表', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (46, 45, 0, 'admin', NULL, 1, 'admin/user.index/add', '新增', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (47, 45, 0, 'admin', NULL, 1, 'admin/user.index/edit', '编辑', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (48, 45, 0, 'admin', NULL, 1, 'admin/user.index/delete', '删除', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (49, 45, 0, 'admin', NULL, 1, 'admin/user.index/status', '状态设置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (51, 25, 2, 'admin', NULL, 1, 'admin/user.type/index', '用户类型', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (52, 51, 0, 'admin', NULL, 1, 'admin/user.type/add', '新增', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (53, 51, 0, 'admin', NULL, 1, 'admin/user.type/edit', '编辑', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (54, 51, 0, 'admin', NULL, 1, 'admin/user.type/delete', '删除', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (55, 51, 0, 'admin', NULL, 1, 'admin/user.type/status', '状态设置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (56, 51, 0, 'admin', NULL, 1, 'admin/user.type/sort', '排序', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (57, 25, 3, 'admin', NULL, 1, 'admin/user.grade/index', '用户等级', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (58, 57, 0, 'admin', NULL, 1, 'admin/user.grade/add', '新增', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (59, 57, 0, 'admin', NULL, 1, 'admin/user.grade/edit', '编辑', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (60, 57, 0, 'admin', NULL, 1, 'admin/user.grade/delete', '删除', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (61, 57, 0, 'admin', NULL, 1, 'admin/user.grade/status', '状态设置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (62, 57, 0, 'admin', NULL, 1, 'admin/user.grade/sort', '排序', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (63, 25, 5, 'admin', NULL, 1, 'admin/user.connect/index', '第三方用户', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (64, 63, 0, 'admin', NULL, 1, 'admin/connect/delete', '删除', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (65, 0, 9, 'admin', '#xe66f;', 1, 'admin/module/init', '应用管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (66, 65, 0, 'admin', NULL, 1, 'admin/module/modules', '应用列表', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (67, 65, 0, 'admin', NULL, 1, 'admin/module/index', '应用管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (68, 65, 0, 'admin', NULL, 1, 'admin/module/install', '安装应用', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (69, 65, 0, 'admin', NULL, 1, 'admin/module/uninstall', '应用卸载', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (70, 65, 0, 'admin', NULL, 1, 'admin/module/shop', '应用商店', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (71, 65, 0, 'admin', NULL, 1, 'admin/module/disabled', '应用状态', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (72, 23, 2, 'admin', NULL, 1, 'admin/config/index', '配置管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (73, 72, 2, 'admin', NULL, 1, 'admin/config/add', '新增', 1, 1, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (74, 72, 0, 'admin', NULL, 1, 'admin/config/edit', '编辑', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (75, 72, 0, 'admin', NULL, 1, 'admin/config/delete', '删除', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (76, 72, 1, 'admin', NULL, 1, 'admin/config/config', '参数管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (77, 72, 0, 'admin', NULL, 1, 'admin/config/sort', '排序', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (78, 72, 0, 'admin', NULL, 1, 'admin/config/save', '批量保存', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (79, 23, 3, 'admin', NULL, 1, 'admin/config/config', '配置参数', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (92, 23, 0, 'admin', NULL, 1, 'admin/file/index', '文件管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (93, 92, 0, 'admin', NULL, 1, 'admin/file/api', '文件上传', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (94, 92, 0, 'admin', NULL, 1, 'admin/file/move', '移动', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (95, 92, 0, 'admin', NULL, 1, 'admin/file/delete', '删除', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (96, 92, 0, 'admin', NULL, 1, 'admin/file/type', '获取分类', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (97, 92, 0, 'admin', NULL, 1, 'admin/file/addtype', '添加分类', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (98, 92, 0, 'admin', NULL, 1, 'admin/file/deltype', '删除分类', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (99, 92, 0, 'admin', NULL, 1, 'admin/file/edittype', '编辑分类', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (100, 0, 11, 'admin', '#xe6eb;', 1, 'admin/addon/index', '插件管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (101, 100, 0, 'admin', NULL, 1, 'admin/addon/config', '插件配置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (102, 100, 0, 'admin', NULL, 1, 'admin/addon/configsave', '保存配置', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (103, 100, 0, 'admin', NULL, 1, 'admin/addon/state', '插件状态', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (104, 100, 0, 'admin', NULL, 1, 'admin/addon/install', '安装插件', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (105, 100, 0, 'admin', NULL, 1, 'admin/addon/uninstall', '卸载插件', 1, 0, '', '');
INSERT INTO `tp_auth_rule` VALUES (106, 0, 2, 'article', '#xe681', 1, 'article/admin.article/index', 'CMS模块', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (107, 106, 0, 'article', NULL, 1, 'article/admin.article/lists', '内容管理', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (108, 107, 0, 'article', NULL, 1, 'article/admin.article/add', '添加', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (109, 107, 0, 'article', NULL, 1, 'article/admin.article/edit', '修改', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (110, 107, 0, 'article', NULL, 1, 'article/admin.article/delete', '删除', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (111, 107, 0, 'article', NULL, 1, 'article/admin.article/sort', '排序', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (112, 107, 0, 'article', NULL, 1, 'article/admin.article/setfield', '设置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (113, 107, 0, 'article', NULL, 1, 'article/admin.article/push', '推送', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (114, 106, 0, 'article', NULL, 1, 'article/admin.position/index', '推荐位管理', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (115, 114, 0, 'article', NULL, 1, 'article/admin.position/add', '添加', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (116, 114, 0, 'article', NULL, 1, 'article/admin.position/edit', '修改', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (117, 114, 0, 'article', NULL, 1, 'article/admin.position/delete', '删除', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (118, 114, 0, 'article', NULL, 1, 'article/admin.position/setfield', '设置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (119, 106, 0, 'article', NULL, 1, 'article/admin.data/index', '推荐位内容', 1, 0, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (120, 119, 0, 'article', NULL, 1, 'article/admin.data/add', '添加', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (121, 119, 0, 'article', NULL, 1, 'article/admin.data/edit', '修改', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (122, 119, 0, 'article', NULL, 1, 'article/admin.data/delete', '删除', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (123, 119, 0, 'article', NULL, 1, 'article/admin.data/sort', '排序', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (124, 106, 0, 'article', NULL, 1, 'article/admin.tag/index', '标签管理', 1, 0, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (125, 124, 0, 'article', NULL, 1, 'article/admin.tag/add', '添加', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (126, 124, 0, 'article', NULL, 1, 'article/admin.tag/edit', '修改', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (127, 124, 0, 'article', NULL, 1, 'article/admin.tag/delete', '删除', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (128, 124, 0, 'article', NULL, 1, 'article/admin.tag/sort', '排序', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (129, 106, 0, 'article', NULL, 1, 'article/admin.tags/index', '标签内容', 1, 0, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (130, 129, 0, 'article', NULL, 1, 'article/admin.tags/add', '添加', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (131, 129, 0, 'article', NULL, 1, 'article/admin.tags/edit', '修改', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (132, 129, 0, 'article', NULL, 1, 'article/admin.tags/delete', '删除', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (133, 129, 0, 'article', NULL, 1, 'article/admin.tags/sort', '排序', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (134, 106, 0, 'article', NULL, 1, 'article/admin.category/index', '栏目管理', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (135, 134, 0, 'article', NULL, 1, 'article/admin.category/add', '添加栏目', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (136, 134, 0, 'article', NULL, 1, 'article/admin.category/edit', '编辑栏目', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (137, 134, 0, 'article', NULL, 1, 'article/admin.category/delete', '删除栏目', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (138, 134, 0, 'article', NULL, 1, 'article/admin.category/sort', '栏目排序', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (139, 134, 0, 'article', NULL, 1, 'article/admin.category/setfield', '字段更新', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (140, 134, 0, 'article', NULL, 1, 'article/admin.category/cache', '更新缓存', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (141, 106, 0, 'article', NULL, 1, 'article/admin.extend/index', '扩展字段', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (142, 141, 0, 'article', NULL, 1, 'article/admin.extend/add', '添加', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (143, 141, 0, 'article', NULL, 1, 'article/admin.extend/edit', '修改', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (144, 141, 0, 'article', NULL, 1, 'article/admin.extend/delete', '删除', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (145, 141, 0, 'article', NULL, 1, 'article/admin.extend/setfield', '设置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (146, 66, 0, 'city', '#xe642', 1, 'city/city/index', '城市管理', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (147, 146, 0, 'city', NULL, 1, 'city/city/add', '添加城市', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (148, 146, 0, 'city', NULL, 1, 'city/city/edit', '修改城市', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (149, 146, 0, 'city', NULL, 1, 'city/city/delete', '删除城市', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (150, 146, 0, 'city', NULL, 1, 'city/city/sort', '城市排序', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (151, 146, 0, 'city', NULL, 1, 'city/city/public_cache', '更新缓存', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (152, 66, 0, 'sms', '#xe65a', 1, 'sms/index/init', '短信模块', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (153, 152, 0, 'sms', NULL, 1, 'sms/index/index', '发送记录', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (154, 153, 0, 'sms', NULL, 1, 'sms/index/delete', '删除记录', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (155, 153, 0, 'sms', NULL, 1, 'sms/index/view', '查看详细', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (156, 153, 0, 'sms', NULL, 1, 'sms/index/send', '发送短信', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (157, 153, 0, 'sms', NULL, 1, 'sms/index/reply', '重新发送', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (158, 152, 0, 'sms', NULL, 1, 'sms/template/index', '短信模板', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (159, 158, 0, 'sms', NULL, 1, 'sms/template/add', '新增模板', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (160, 158, 0, 'sms', NULL, 1, 'sms/template/edit', '编辑模板', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (161, 158, 0, 'sms', NULL, 1, 'sms/template/delete', '删除记录', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (162, 158, 0, 'sms', NULL, 1, 'sms/index/setField', '状态设置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (163, 0, 8, 'swiper', '#xe60f;', 1, 'swiper/index/init', '轮播图管理', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (164, 163, 0, 'swiper', NULL, 1, 'swiper/index/index', '轮播图列表', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (165, 164, 0, 'swiper', NULL, 1, 'swiper/index/delete', '删除', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (166, 164, 0, 'swiper', NULL, 1, 'swiper/index/view', '查看', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (167, 164, 0, 'swiper', NULL, 1, 'swiper/index/add', '新增', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (168, 164, 0, 'swiper', NULL, 1, 'swiper/index/edit', '编辑', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (169, 164, 0, 'swiper', NULL, 1, 'swiper/index/setfield', '设置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (170, 164, 0, 'swiper', NULL, 1, 'goods/admin.type/sort', '排序', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (352, 25, 6, 'admin', NULL, 1, 'admin/user.relation/index', '推荐关系', 1, 1, '', '');
INSERT INTO `tp_auth_rule` VALUES (353, 352, 0, 'admin', NULL, 1, 'admin/user.relation/add', '新增', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (354, 352, 0, 'admin', NULL, 1, 'admin/user.relation/edit', '编辑', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (355, 352, 0, 'admin', NULL, 1, 'admin/user.relation/delete', '删除', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (356, 352, 0, 'admin', NULL, 1, 'admin/user.relation/status', '状态设置', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (357, 352, 0, 'admin', NULL, 1, 'admin/user.relation/sort', '排序', 1, 0, NULL, NULL);
INSERT INTO `tp_auth_rule` VALUES (362, 25, 0, 'sign', NULL, 1, 'sign/index/index', '会员签到', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (363, 362, 0, 'sign', NULL, 1, 'sign/index/delete', '删除记录', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (364, 362, 0, 'sign', NULL, 1, 'sign/cfg/add', '添加配置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (365, 362, 0, 'sign', NULL, 1, 'sign/cfg/edit', '编辑配置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (366, 362, 0, 'sign', NULL, 1, 'sign/cfg/delete', '删除配置', 1, 1, NULL, '');
INSERT INTO `tp_auth_rule` VALUES (367, 362, 0, 'sign', NULL, 1, 'sign/cfg/config', '批量编辑配置', 1, 1, NULL, '');
COMMIT;

-- ----------------------------
-- Table structure for tp_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `module` char(30) NOT NULL DEFAULT '' COMMENT '所属内容模型',
  `open_link` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为外部连接[1是,0否]',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID[备用]',
  `is_menu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `icon` varchar(60) DEFAULT NULL COMMENT '栏目图标',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否存在子栏目，1存在',
  `child_ids` mediumtext COMMENT '所有子栏目ID',
  `cat_name` varchar(30) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '栏目图片',
  `description` mediumtext COMMENT '栏目描述',
  `parentdir` varchar(100) NOT NULL DEFAULT '' COMMENT '父目录',
  `catdir` varchar(30) NOT NULL DEFAULT '' COMMENT '栏目目录',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '链接地址',
  `setting` mediumtext COMMENT '相关配置信息',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `letter` varchar(30) NOT NULL DEFAULT '' COMMENT '栏目拼音',
  PRIMARY KEY (`cat_id`),
  KEY `module` (`module`),
  KEY `open_link` (`open_link`),
  KEY `modelid` (`modelid`),
  KEY `pid` (`pid`),
  KEY `child` (`child`),
  KEY `cat_name` (`cat_name`),
  KEY `sort` (`sort`),
  KEY `ismenu` (`is_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='栏目管理';

-- ----------------------------
-- Records of tp_category
-- ----------------------------
BEGIN;
INSERT INTO `tp_category` VALUES (1, 'page', 0, 0, 0, '', 0, 0, '0', '用户协议', '', NULL, '', 'zcxy', '/article/zcxy', 'a:2:{s:3:\"seo\";a:3:{s:5:\"title\";s:12:\"用户协议\";s:8:\"keywords\";s:12:\"用户协议\";s:11:\"description\";s:12:\"用户协议\";}s:8:\"template\";a:4:{s:8:\"category\";s:12:\"category.php\";s:5:\"lists\";s:9:\"lists.php\";s:4:\"view\";s:8:\"view.php\";s:4:\"page\";s:8:\"page.php\";}}', 0, 'zcxy');
INSERT INTO `tp_category` VALUES (3, 'article', 0, 0, 1, '', 0, 0, '0', '常见问题', '', NULL, '', 'cjwt', '/article/cjwt', 'a:2:{s:3:\"seo\";a:3:{s:5:\"title\";s:0:\"\";s:8:\"keywords\";s:0:\"\";s:11:\"description\";s:0:\"\";}s:8:\"template\";a:4:{s:8:\"category\";s:12:\"category.php\";s:5:\"lists\";s:9:\"lists.php\";s:4:\"view\";s:8:\"view.php\";s:4:\"page\";s:8:\"page.php\";}}', 0, 'cjwt');
COMMIT;

-- ----------------------------
-- Table structure for tp_category_extend
-- ----------------------------
DROP TABLE IF EXISTS `tp_category_extend`;
CREATE TABLE `tp_category_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '字段ID',
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `field` varchar(60) NOT NULL DEFAULT '' COMMENT '字段名',
  `length` int(11) NOT NULL DEFAULT '255' COMMENT '字段长度',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '字段名称',
  `value` varchar(500) NOT NULL DEFAULT '' COMMENT '字段值',
  `type` varchar(60) NOT NULL DEFAULT '' COMMENT '字段类型',
  `tips` varchar(300) NOT NULL DEFAULT '' COMMENT '字段描述',
  `must` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为必选[1是,0否]',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `field` (`field`),
  KEY `type` (`type`),
  KEY `must` (`must`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='扩展这段';

-- ----------------------------
-- Records of tp_category_extend
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_category_priv
-- ----------------------------
DROP TABLE IF EXISTS `tp_category_priv`;
CREATE TABLE `tp_category_priv` (
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目id',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `rule` varchar(500) NOT NULL DEFAULT '' COMMENT '权限规则',
  PRIMARY KEY (`cat_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='栏目权限表';

-- ----------------------------
-- Records of tp_category_priv
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_city
-- ----------------------------
DROP TABLE IF EXISTS `tp_city`;
CREATE TABLE `tp_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地区Id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '地区父节点',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开通状态0未开通，1为开通',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '地区级别（1:省份province,2:市city,3:区县district,4:街道street）',
  `hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否设为热门（0否，1是）',
  `name` varchar(20) NOT NULL COMMENT '地区名',
  `area_name` varchar(255) NOT NULL COMMENT '区域全名',
  `city_code` varchar(50) NOT NULL COMMENT '城市编码',
  `center` varchar(50) NOT NULL COMMENT '城市中心点（即：经纬度坐标）',
  `py` varchar(10) NOT NULL COMMENT '城市名称拼音',
  `first_py` varchar(60) NOT NULL COMMENT '城市首字母',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `level` (`level`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4529 DEFAULT CHARSET=utf8 COMMENT='省市区表';

-- ----------------------------
-- Records of tp_city
-- ----------------------------
BEGIN;
INSERT INTO `tp_city` VALUES (1, 0, 0, 1, 0, '辽宁省', '辽宁省', '', '', 'lns', 'L', 0);
INSERT INTO `tp_city` VALUES (2, 1, 0, 2, 0, '大连市', '辽宁省大连市', '116000', '', 'dls', 'D', 0);
INSERT INTO `tp_city` VALUES (3, 2, 0, 3, 0, '西岗区', '辽宁省大连市西岗区', '116011', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (4, 2, 0, 3, 0, '中山区', '辽宁省大连市中山区', '116001', '', 'zsq', 'Z', 0);
INSERT INTO `tp_city` VALUES (5, 2, 0, 3, 0, '沙河口区', '辽宁省大连市沙河口区', '116021', '', 'shkq', 'S', 0);
INSERT INTO `tp_city` VALUES (6, 2, 0, 3, 0, '甘井子区', '辽宁省大连市甘井子区', '116033', '', 'gjzq', 'G', 0);
INSERT INTO `tp_city` VALUES (7, 2, 0, 3, 0, '旅顺口区', '辽宁省大连市旅顺口区', '116041', '', 'lskq', 'L', 0);
INSERT INTO `tp_city` VALUES (8, 2, 0, 3, 0, '金州区', '辽宁省大连市金州区', '116100', '', 'jzq', 'J', 0);
INSERT INTO `tp_city` VALUES (9, 2, 0, 3, 0, '长海县', '辽宁省大连市长海县', '116500', '', 'chx', 'C', 0);
INSERT INTO `tp_city` VALUES (10, 2, 0, 3, 0, '开发区', '辽宁省大连市开发区', '', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (11, 2, 0, 3, 0, '瓦房店市', '辽宁省大连市瓦房店市', '116300', '', 'wfds', 'W', 0);
INSERT INTO `tp_city` VALUES (12, 2, 0, 3, 0, '普兰店市', '辽宁省大连市普兰店市', '116200', '', 'plds', 'P', 0);
INSERT INTO `tp_city` VALUES (13, 2, 0, 3, 0, '庄河市', '辽宁省大连市庄河市', '116400', '', 'zhs', 'Z', 0);
INSERT INTO `tp_city` VALUES (14, 2, 0, 3, 0, '岭前区', '辽宁省大连市岭前区', '', '', 'lqq', 'L', 0);
INSERT INTO `tp_city` VALUES (15, 2, 0, 3, 0, '其它区', '辽宁省大连市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (16, 1, 0, 2, 0, '鞍山市', '辽宁省鞍山市', '114000', '', 'ass', 'A', 0);
INSERT INTO `tp_city` VALUES (17, 16, 0, 3, 0, '铁西区', '辽宁省鞍山市铁西区', '110023', '', 'txq', 'T', 0);
INSERT INTO `tp_city` VALUES (18, 16, 0, 3, 0, '铁东区', '辽宁省鞍山市铁东区', '114001', '', 'tdq', 'T', 0);
INSERT INTO `tp_city` VALUES (19, 16, 0, 3, 0, '立山区', '辽宁省鞍山市立山区', '114031', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (20, 16, 0, 3, 0, '千山区', '辽宁省鞍山市千山区', '114041', '', 'qsq', 'Q', 0);
INSERT INTO `tp_city` VALUES (21, 16, 0, 3, 0, '岫岩满族自治县', '辽宁省鞍山市岫岩满族自治县', '114300', '', 'ymzzzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (22, 16, 0, 3, 0, '台安县', '辽宁省鞍山市台安县', '114100', '', 'tax', 'T', 0);
INSERT INTO `tp_city` VALUES (23, 16, 0, 3, 0, '高新区', '辽宁省鞍山市高新区', '', '', 'gxq', 'G', 0);
INSERT INTO `tp_city` VALUES (24, 16, 0, 3, 0, '其它区', '辽宁省鞍山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (25, 16, 0, 3, 0, '海城市', '辽宁省鞍山市海城市', '114200', '', 'hcs', 'H', 0);
INSERT INTO `tp_city` VALUES (26, 1, 0, 2, 0, '抚顺市', '辽宁省抚顺市', '113000', '', 'fss', 'F', 0);
INSERT INTO `tp_city` VALUES (27, 26, 0, 3, 0, '望花区', '辽宁省抚顺市望花区', '113001', '', 'whq', 'W', 0);
INSERT INTO `tp_city` VALUES (28, 26, 0, 3, 0, '东洲区', '辽宁省抚顺市东洲区', '113003', '', 'dzq', 'D', 0);
INSERT INTO `tp_city` VALUES (29, 26, 0, 3, 0, '新抚区', '辽宁省抚顺市新抚区', '113006', '', 'xfq', 'X', 0);
INSERT INTO `tp_city` VALUES (30, 26, 0, 3, 0, '顺城区', '辽宁省抚顺市顺城区', '113006', '', 'scq', 'S', 0);
INSERT INTO `tp_city` VALUES (31, 26, 0, 3, 0, '抚顺县', '辽宁省抚顺市抚顺县', '113100', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (32, 26, 0, 3, 0, '新宾满族自治县', '辽宁省抚顺市新宾满族自治县', '113200', '', 'xbmzzzx', 'X', 0);
INSERT INTO `tp_city` VALUES (33, 26, 0, 3, 0, '清原满族自治县', '辽宁省抚顺市清原满族自治县', '113300', '', 'qymzzzx', 'Q', 0);
INSERT INTO `tp_city` VALUES (34, 26, 0, 3, 0, '其它区', '辽宁省抚顺市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (35, 1, 0, 2, 0, '沈阳市', '辽宁省沈阳市', '110000', '', 'sys', 'S', 0);
INSERT INTO `tp_city` VALUES (36, 35, 0, 3, 0, '沈北新区', '辽宁省沈阳市沈北新区', '', '', 'sbxq', 'S', 0);
INSERT INTO `tp_city` VALUES (37, 35, 0, 3, 0, '其它区', '辽宁省沈阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (38, 35, 0, 3, 0, '浑南新区', '辽宁省沈阳市浑南新区', '', '', 'hnxq', 'H', 0);
INSERT INTO `tp_city` VALUES (39, 35, 0, 3, 0, '张士开发区', '辽宁省沈阳市张士开发区', '', '', 'zskfq', 'Z', 0);
INSERT INTO `tp_city` VALUES (40, 35, 0, 3, 0, '新民市', '辽宁省沈阳市新民市', '110300', '', 'xms', 'X', 0);
INSERT INTO `tp_city` VALUES (41, 35, 0, 3, 0, '和平区', '辽宁省沈阳市和平区', '110002', '', 'hpq', 'H', 0);
INSERT INTO `tp_city` VALUES (42, 35, 0, 3, 0, '沈河区', '辽宁省沈阳市沈河区', '110013', '', 'shq', 'S', 0);
INSERT INTO `tp_city` VALUES (43, 35, 0, 3, 0, '铁西区', '辽宁省沈阳市铁西区', '110023', '', 'txq', 'T', 0);
INSERT INTO `tp_city` VALUES (44, 35, 0, 3, 0, '大东区', '辽宁省沈阳市大东区', '110044', '', 'ddq', 'D', 0);
INSERT INTO `tp_city` VALUES (45, 35, 0, 3, 0, '皇姑区', '辽宁省沈阳市皇姑区', '110031', '', 'hgq', 'H', 0);
INSERT INTO `tp_city` VALUES (46, 35, 0, 3, 0, '苏家屯区', '辽宁省沈阳市苏家屯区', '110102', '', 'sjtq', 'S', 0);
INSERT INTO `tp_city` VALUES (47, 35, 0, 3, 0, '新城子区', '辽宁省沈阳市新城子区', '110121', '', 'xczq', 'X', 0);
INSERT INTO `tp_city` VALUES (48, 35, 0, 3, 0, '东陵区', '辽宁省沈阳市东陵区', '110015', '', 'dlq', 'D', 0);
INSERT INTO `tp_city` VALUES (49, 35, 0, 3, 0, '于洪区', '辽宁省沈阳市于洪区', '110024', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (50, 35, 0, 3, 0, '法库县', '辽宁省沈阳市法库县', '110400', '', 'fkx', 'F', 0);
INSERT INTO `tp_city` VALUES (51, 35, 0, 3, 0, '康平县', '辽宁省沈阳市康平县', '110500', '', 'kpx', 'K', 0);
INSERT INTO `tp_city` VALUES (52, 35, 0, 3, 0, '辽中县', '辽宁省沈阳市辽中县', '110200', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (53, 1, 0, 2, 0, '锦州市', '辽宁省锦州市', '121000', '', 'jzs', 'J', 0);
INSERT INTO `tp_city` VALUES (54, 53, 0, 3, 0, '黑山县', '辽宁省锦州市黑山县', '121400', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (55, 53, 0, 3, 0, '义县', '辽宁省锦州市义县', '121100', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (56, 53, 0, 3, 0, '古塔区', '辽宁省锦州市古塔区', '121001', '', 'gtq', 'G', 0);
INSERT INTO `tp_city` VALUES (57, 53, 0, 3, 0, '凌河区', '辽宁省锦州市凌河区', '121000', '', 'lhq', 'L', 0);
INSERT INTO `tp_city` VALUES (58, 53, 0, 3, 0, '太和区', '辽宁省锦州市太和区', '121011', '', 'thq', 'T', 0);
INSERT INTO `tp_city` VALUES (59, 53, 0, 3, 0, '其它区', '辽宁省锦州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (60, 53, 0, 3, 0, '北镇市', '辽宁省锦州市北镇市', '121300', '', 'bzs', 'B', 0);
INSERT INTO `tp_city` VALUES (61, 53, 0, 3, 0, '凌海市', '辽宁省锦州市凌海市', '121200', '', 'lhs', 'L', 0);
INSERT INTO `tp_city` VALUES (62, 1, 0, 2, 0, '营口市', '辽宁省营口市', '115000', '', 'yks', 'Y', 0);
INSERT INTO `tp_city` VALUES (63, 62, 0, 3, 0, '老边区', '辽宁省营口市老边区', '115005', '', 'lbq', 'L', 0);
INSERT INTO `tp_city` VALUES (64, 62, 0, 3, 0, '西市区', '辽宁省营口市西市区', '115004', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (65, 62, 0, 3, 0, '站前区', '辽宁省营口市站前区', '115002', '', 'zqq', 'Z', 0);
INSERT INTO `tp_city` VALUES (66, 62, 0, 3, 0, '鲅鱼圈区', '辽宁省营口市鲅鱼圈区', '115007', '', 'yqq', 'Z', 0);
INSERT INTO `tp_city` VALUES (67, 62, 0, 3, 0, '其它区', '辽宁省营口市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (68, 62, 0, 3, 0, '大石桥市', '辽宁省营口市大石桥市', '115100', '', 'dsqs', 'D', 0);
INSERT INTO `tp_city` VALUES (69, 62, 0, 3, 0, '盖州市', '辽宁省营口市盖州市', '115200', '', 'gzs', 'G', 0);
INSERT INTO `tp_city` VALUES (70, 1, 0, 2, 0, '阜新市', '辽宁省阜新市', '123000', '', 'fxs', 'F', 0);
INSERT INTO `tp_city` VALUES (71, 70, 0, 3, 0, '阜新蒙古族自治县', '辽宁省阜新市阜新蒙古族自治县', '123100', '', 'fxmgzzzx', 'F', 0);
INSERT INTO `tp_city` VALUES (72, 70, 0, 3, 0, '其它区', '辽宁省阜新市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (73, 70, 0, 3, 0, '彰武县', '辽宁省阜新市彰武县', '123200', '', 'zwx', 'Z', 0);
INSERT INTO `tp_city` VALUES (74, 70, 0, 3, 0, '海州区', '辽宁省阜新市海州区', '123000', '', 'hzq', 'H', 0);
INSERT INTO `tp_city` VALUES (75, 70, 0, 3, 0, '新邱区', '辽宁省阜新市新邱区', '123005', '', 'xqq', 'X', 0);
INSERT INTO `tp_city` VALUES (76, 70, 0, 3, 0, '太平区', '辽宁省阜新市太平区', '123003', '', 'tpq', 'T', 0);
INSERT INTO `tp_city` VALUES (77, 70, 0, 3, 0, '清河门区', '辽宁省阜新市清河门区', '123006', '', 'qhmq', 'Q', 0);
INSERT INTO `tp_city` VALUES (78, 70, 0, 3, 0, '细河区', '辽宁省阜新市细河区', '123000', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (79, 1, 0, 2, 0, '本溪市', '辽宁省本溪市', '117000', '', 'bxs', 'B', 0);
INSERT INTO `tp_city` VALUES (80, 79, 0, 3, 0, '本溪满族自治县', '辽宁省本溪市本溪满族自治县', '117100', '', 'bxmzzzx', 'B', 0);
INSERT INTO `tp_city` VALUES (81, 79, 0, 3, 0, '其它区', '辽宁省本溪市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (82, 79, 0, 3, 0, '桓仁满族自治县', '辽宁省本溪市桓仁满族自治县', '117200', '', 'hrmzzzx', 'H', 0);
INSERT INTO `tp_city` VALUES (83, 79, 0, 3, 0, '明山区', '辽宁省本溪市明山区', '117021', '', 'msq', 'M', 0);
INSERT INTO `tp_city` VALUES (84, 79, 0, 3, 0, '南芬区', '辽宁省本溪市南芬区', '117014', '', 'nfq', 'N', 0);
INSERT INTO `tp_city` VALUES (85, 79, 0, 3, 0, '平山区', '辽宁省本溪市平山区', '117000', '', 'psq', 'P', 0);
INSERT INTO `tp_city` VALUES (86, 79, 0, 3, 0, '溪湖区', '辽宁省本溪市溪湖区', '117002', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (87, 1, 0, 2, 0, '丹东市', '辽宁省丹东市', '118000', '', 'dds', 'D', 0);
INSERT INTO `tp_city` VALUES (88, 87, 0, 3, 0, '振安区', '辽宁省丹东市振安区', '118001', '', 'zaq', 'Z', 0);
INSERT INTO `tp_city` VALUES (89, 87, 0, 3, 0, '振兴区', '辽宁省丹东市振兴区', '118002', '', 'zxq', 'Z', 0);
INSERT INTO `tp_city` VALUES (90, 87, 0, 3, 0, '元宝区', '辽宁省丹东市元宝区', '118000', '', 'ybq', 'Y', 0);
INSERT INTO `tp_city` VALUES (91, 87, 0, 3, 0, '凤城市', '辽宁省丹东市凤城市', '118100', '', 'fcs', 'F', 0);
INSERT INTO `tp_city` VALUES (92, 87, 0, 3, 0, '其它区', '辽宁省丹东市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (93, 87, 0, 3, 0, '东港市', '辽宁省丹东市东港市', '118300', '', 'dgs', 'D', 0);
INSERT INTO `tp_city` VALUES (94, 87, 0, 3, 0, '宽甸县', '辽宁省丹东市宽甸县', '118200', '', 'kdx', 'K', 0);
INSERT INTO `tp_city` VALUES (95, 1, 0, 2, 0, '葫芦岛市', '辽宁省葫芦岛市', '125000', '', 'hlds', 'H', 0);
INSERT INTO `tp_city` VALUES (96, 95, 0, 3, 0, '建昌县', '辽宁省葫芦岛市建昌县', '125300', '', 'jcx', 'J', 0);
INSERT INTO `tp_city` VALUES (97, 95, 0, 3, 0, '绥中县', '辽宁省葫芦岛市绥中县', '125200', '', 'szx', 'S', 0);
INSERT INTO `tp_city` VALUES (98, 95, 0, 3, 0, '南票区', '辽宁省葫芦岛市南票区', '125027', '', 'npq', 'N', 0);
INSERT INTO `tp_city` VALUES (99, 95, 0, 3, 0, '龙港区', '辽宁省葫芦岛市龙港区', '125004', '', 'lgq', 'L', 0);
INSERT INTO `tp_city` VALUES (100, 95, 0, 3, 0, '连山区', '辽宁省葫芦岛市连山区', '125001', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (101, 95, 0, 3, 0, '兴城市', '辽宁省葫芦岛市兴城市', '125100', '', 'xcs', 'X', 0);
INSERT INTO `tp_city` VALUES (102, 95, 0, 3, 0, '其它区', '辽宁省葫芦岛市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (103, 1, 0, 2, 0, '朝阳市', '辽宁省朝阳市', '122000', '', 'cys', 'C', 0);
INSERT INTO `tp_city` VALUES (104, 103, 0, 3, 0, '北票市', '辽宁省朝阳市北票市', '122100', '', 'bps', 'B', 0);
INSERT INTO `tp_city` VALUES (105, 103, 0, 3, 0, '凌源市', '辽宁省朝阳市凌源市', '122500', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (106, 103, 0, 3, 0, '其它区', '辽宁省朝阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (107, 103, 0, 3, 0, '喀喇沁左翼蒙古族自治县', '辽宁省朝阳市喀喇沁左翼蒙古族自治县', '122300', '', 'klqzymgzzz', 'K', 0);
INSERT INTO `tp_city` VALUES (108, 103, 0, 3, 0, '朝阳县', '辽宁省朝阳市朝阳县', '122000', '', 'cyx', 'C', 0);
INSERT INTO `tp_city` VALUES (109, 103, 0, 3, 0, '建平县', '辽宁省朝阳市建平县', '122400', '', 'jpx', 'J', 0);
INSERT INTO `tp_city` VALUES (110, 103, 0, 3, 0, '双塔区', '辽宁省朝阳市双塔区', '122000', '', 'stq', 'S', 0);
INSERT INTO `tp_city` VALUES (111, 103, 0, 3, 0, '龙城区', '辽宁省朝阳市龙城区', '122000', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (112, 1, 0, 2, 0, '铁岭市', '辽宁省铁岭市', '112000', '', 'tls', 'T', 0);
INSERT INTO `tp_city` VALUES (113, 112, 0, 3, 0, '其它区', '辽宁省铁岭市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (114, 112, 0, 3, 0, '开原市', '辽宁省铁岭市开原市', '112300', '', 'kys', 'K', 0);
INSERT INTO `tp_city` VALUES (115, 112, 0, 3, 0, '调兵山市', '辽宁省铁岭市调兵山市', '112700', '', 'dbss', 'D', 0);
INSERT INTO `tp_city` VALUES (116, 112, 0, 3, 0, '西丰县', '辽宁省铁岭市西丰县', '112400', '', 'xfx', 'X', 0);
INSERT INTO `tp_city` VALUES (117, 112, 0, 3, 0, '铁岭县', '辽宁省铁岭市铁岭县', '112600', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (118, 112, 0, 3, 0, '昌图县', '辽宁省铁岭市昌图县', '112500', '', 'ctx', 'C', 0);
INSERT INTO `tp_city` VALUES (119, 112, 0, 3, 0, '银州区', '辽宁省铁岭市银州区', '112000', '', 'yzq', 'Y', 0);
INSERT INTO `tp_city` VALUES (120, 112, 0, 3, 0, '清河区', '辽宁省铁岭市清河区', '112003', '', 'qhq', 'Q', 0);
INSERT INTO `tp_city` VALUES (121, 1, 0, 2, 0, '盘锦市', '辽宁省盘锦市', '124000', '', 'pjs', 'P', 0);
INSERT INTO `tp_city` VALUES (122, 121, 0, 3, 0, '双台子区', '辽宁省盘锦市双台子区', '124000', '', 'stzq', 'S', 0);
INSERT INTO `tp_city` VALUES (123, 121, 0, 3, 0, '兴隆台区', '辽宁省盘锦市兴隆台区', '124010', '', 'xltq', 'X', 0);
INSERT INTO `tp_city` VALUES (124, 121, 0, 3, 0, '盘山县', '辽宁省盘锦市盘山县', '124100', '', 'psx', 'P', 0);
INSERT INTO `tp_city` VALUES (125, 121, 0, 3, 0, '其它区', '辽宁省盘锦市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (126, 121, 0, 3, 0, '大洼县', '辽宁省盘锦市大洼县', '124000', '', 'dwx', 'D', 0);
INSERT INTO `tp_city` VALUES (127, 1, 0, 2, 0, '辽阳市', '辽宁省辽阳市', '111000', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (128, 127, 0, 3, 0, '灯塔市', '辽宁省辽阳市灯塔市', '111300', '', 'dts', 'D', 0);
INSERT INTO `tp_city` VALUES (129, 127, 0, 3, 0, '其它区', '辽宁省辽阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (130, 127, 0, 3, 0, '太子河区', '辽宁省辽阳市太子河区', '111000', '', 'tzhq', 'T', 0);
INSERT INTO `tp_city` VALUES (131, 127, 0, 3, 0, '辽阳县', '辽宁省辽阳市辽阳县', '111200', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (132, 127, 0, 3, 0, '文圣区', '辽宁省辽阳市文圣区', '111000', '', 'wsq', 'W', 0);
INSERT INTO `tp_city` VALUES (133, 127, 0, 3, 0, '白塔区', '辽宁省辽阳市白塔区', '111000', '', 'btq', 'B', 0);
INSERT INTO `tp_city` VALUES (134, 127, 0, 3, 0, '弓长岭区', '辽宁省辽阳市弓长岭区', '111008', '', 'gclq', 'G', 0);
INSERT INTO `tp_city` VALUES (135, 127, 0, 3, 0, '宏伟区', '辽宁省辽阳市宏伟区', '111003', '', 'hwq', 'H', 0);
INSERT INTO `tp_city` VALUES (136, 0, 0, 1, 0, '湖北省', '湖北省', '', '', 'hbs', 'H', 0);
INSERT INTO `tp_city` VALUES (137, 136, 0, 2, 0, '宜昌市', '湖北省宜昌市', '443000', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (138, 137, 0, 3, 0, '点军区', '湖北省宜昌市点军区', '443006', '', 'djq', 'D', 0);
INSERT INTO `tp_city` VALUES (139, 137, 0, 3, 0, '猇亭区', '湖北省宜昌市猇亭区', '443007', '', 'tq', 'T', 0);
INSERT INTO `tp_city` VALUES (140, 137, 0, 3, 0, '夷陵区', '湖北省宜昌市夷陵区', '443100', '', 'ylq', 'Y', 0);
INSERT INTO `tp_city` VALUES (141, 137, 0, 3, 0, '西陵区', '湖北省宜昌市西陵区', '443000', '', 'xlq', 'X', 0);
INSERT INTO `tp_city` VALUES (142, 137, 0, 3, 0, '伍家岗区', '湖北省宜昌市伍家岗区', '443001', '', 'wjgq', 'W', 0);
INSERT INTO `tp_city` VALUES (143, 137, 0, 3, 0, '长阳县', '湖北省宜昌市长阳县', '443500', '', 'cyx', 'C', 0);
INSERT INTO `tp_city` VALUES (144, 137, 0, 3, 0, '五峰县', '湖北省宜昌市五峰县', '443400', '', 'wfx', 'W', 0);
INSERT INTO `tp_city` VALUES (145, 137, 0, 3, 0, '秭归县', '湖北省宜昌市秭归县', '443600', '', 'gx', 'Z', 0);
INSERT INTO `tp_city` VALUES (146, 137, 0, 3, 0, '兴山县', '湖北省宜昌市兴山县', '443700', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (147, 137, 0, 3, 0, '远安县', '湖北省宜昌市远安县', '444200', '', 'yax', 'Y', 0);
INSERT INTO `tp_city` VALUES (148, 137, 0, 3, 0, '开发区', '湖北省宜昌市开发区', '', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (149, 137, 0, 3, 0, '葛洲坝区', '湖北省宜昌市葛洲坝区', '', '', 'gzbq', 'G', 0);
INSERT INTO `tp_city` VALUES (150, 137, 0, 3, 0, '其它区', '湖北省宜昌市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (151, 137, 0, 3, 0, '枝江市', '湖北省宜昌市枝江市', '443200', '', 'zjs', 'Z', 0);
INSERT INTO `tp_city` VALUES (152, 137, 0, 3, 0, '当阳市', '湖北省宜昌市当阳市', '444100', '', 'dys', 'D', 0);
INSERT INTO `tp_city` VALUES (153, 137, 0, 3, 0, '宜都市', '湖北省宜昌市宜都市', '443300', '', 'yds', 'Y', 0);
INSERT INTO `tp_city` VALUES (154, 136, 0, 2, 0, '襄阳市', '湖北省襄阳市', '441000', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (155, 154, 0, 3, 0, '襄城区', '湖北省襄阳市襄城区', '441021', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (156, 154, 0, 3, 0, '樊城区', '湖北省襄阳市樊城区', '441001', '', 'fcq', 'F', 0);
INSERT INTO `tp_city` VALUES (157, 154, 0, 3, 0, '襄州区', '湖北省襄阳市襄州区', '441100', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (158, 154, 0, 3, 0, '保康县', '湖北省襄阳市保康县', '441600', '', 'bkx', 'B', 0);
INSERT INTO `tp_city` VALUES (159, 154, 0, 3, 0, '谷城县', '湖北省襄阳市谷城县', '441700', '', 'gcx', 'G', 0);
INSERT INTO `tp_city` VALUES (160, 154, 0, 3, 0, '南漳县', '湖北省襄阳市南漳县', '441500', '', 'nzx', 'N', 0);
INSERT INTO `tp_city` VALUES (161, 154, 0, 3, 0, '老河口市', '湖北省襄阳市老河口市', '441800', '', 'lhks', 'L', 0);
INSERT INTO `tp_city` VALUES (162, 154, 0, 3, 0, '枣阳市', '湖北省襄阳市枣阳市', '441200', '', 'zys', 'Z', 0);
INSERT INTO `tp_city` VALUES (163, 154, 0, 3, 0, '宜城市', '湖北省襄阳市宜城市', '441400', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (164, 154, 0, 3, 0, '其它区', '湖北省襄阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (165, 136, 0, 2, 0, '鄂州市', '湖北省鄂州市', '436000', '', 'ezs', 'E', 0);
INSERT INTO `tp_city` VALUES (166, 165, 0, 3, 0, '华容区', '湖北省鄂州市华容区', '436030', '', 'hrq', 'H', 0);
INSERT INTO `tp_city` VALUES (167, 165, 0, 3, 0, '梁子湖区', '湖北省鄂州市梁子湖区', '436064', '', 'lzhq', 'L', 0);
INSERT INTO `tp_city` VALUES (168, 165, 0, 3, 0, '鄂城区', '湖北省鄂州市鄂城区', '436000', '', 'ecq', 'E', 0);
INSERT INTO `tp_city` VALUES (169, 165, 0, 3, 0, '其它区', '湖北省鄂州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (170, 136, 0, 2, 0, '荆门市', '湖北省荆门市', '448000', '', 'jms', 'J', 0);
INSERT INTO `tp_city` VALUES (171, 170, 0, 3, 0, '东宝区', '湖北省荆门市东宝区', '448004', '', 'dbq', 'D', 0);
INSERT INTO `tp_city` VALUES (172, 170, 0, 3, 0, '掇刀区', '湖北省荆门市掇刀区', '448124', '', 'ddq', 'D', 0);
INSERT INTO `tp_city` VALUES (173, 170, 0, 3, 0, '沙洋县', '湖北省荆门市沙洋县', '448200', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (174, 170, 0, 3, 0, '京山县', '湖北省荆门市京山县', '431800', '', 'jsx', 'J', 0);
INSERT INTO `tp_city` VALUES (175, 170, 0, 3, 0, '钟祥市', '湖北省荆门市钟祥市', '431900', '', 'zxs', 'Z', 0);
INSERT INTO `tp_city` VALUES (176, 170, 0, 3, 0, '其它区', '湖北省荆门市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (177, 136, 0, 2, 0, '武汉市', '湖北省武汉市', '430000', '', 'whs', 'W', 0);
INSERT INTO `tp_city` VALUES (178, 177, 0, 3, 0, '江岸区', '湖北省武汉市江岸区', '430014', '', 'jaq', 'J', 0);
INSERT INTO `tp_city` VALUES (179, 177, 0, 3, 0, '江汉区', '湖北省武汉市江汉区', '430015', '', 'jhq', 'J', 0);
INSERT INTO `tp_city` VALUES (180, 177, 0, 3, 0, '武昌区', '湖北省武汉市武昌区', '430061', '', 'wcq', 'W', 0);
INSERT INTO `tp_city` VALUES (181, 177, 0, 3, 0, '青山区', '湖北省武汉市青山区', '430080', '', 'qsq', 'Q', 0);
INSERT INTO `tp_city` VALUES (182, 177, 0, 3, 0, '硚口区', '湖北省武汉市硚口区', '430033', '', 'kq', 'C', 0);
INSERT INTO `tp_city` VALUES (183, 177, 0, 3, 0, '汉阳区', '湖北省武汉市汉阳区', '430050', '', 'hyq', 'H', 0);
INSERT INTO `tp_city` VALUES (184, 177, 0, 3, 0, '洪山区', '湖北省武汉市洪山区', '430070', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (185, 177, 0, 3, 0, '江夏区', '湖北省武汉市江夏区', '430200', '', 'jxq', 'J', 0);
INSERT INTO `tp_city` VALUES (186, 177, 0, 3, 0, '蔡甸区', '湖北省武汉市蔡甸区', '430100', '', 'cdq', 'C', 0);
INSERT INTO `tp_city` VALUES (187, 177, 0, 3, 0, '汉南区', '湖北省武汉市汉南区', '430090', '', 'hnq', 'H', 0);
INSERT INTO `tp_city` VALUES (188, 177, 0, 3, 0, '东西湖区', '湖北省武汉市东西湖区', '430040', '', 'dxhq', 'D', 0);
INSERT INTO `tp_city` VALUES (189, 177, 0, 3, 0, '其它区', '湖北省武汉市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (190, 177, 0, 3, 0, '新洲区', '湖北省武汉市新洲区', '431400', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (191, 177, 0, 3, 0, '黄陂区', '湖北省武汉市黄陂区', '430300', '', 'hq', 'H', 0);
INSERT INTO `tp_city` VALUES (192, 136, 0, 2, 0, '黄石市', '湖北省黄石市', '435000', '', 'hss', 'H', 0);
INSERT INTO `tp_city` VALUES (193, 192, 0, 3, 0, '下陆区', '湖北省黄石市下陆区', '435004', '', 'xlq', 'X', 0);
INSERT INTO `tp_city` VALUES (194, 192, 0, 3, 0, '铁山区', '湖北省黄石市铁山区', '435006', '', 'tsq', 'T', 0);
INSERT INTO `tp_city` VALUES (195, 192, 0, 3, 0, '黄石港区', '湖北省黄石市黄石港区', '435002', '', 'hsgq', 'H', 0);
INSERT INTO `tp_city` VALUES (196, 192, 0, 3, 0, '西塞山区', '湖北省黄石市西塞山区', '435001', '', 'xssq', 'X', 0);
INSERT INTO `tp_city` VALUES (197, 192, 0, 3, 0, '阳新县', '湖北省黄石市阳新县', '435200', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (198, 192, 0, 3, 0, '大冶市', '湖北省黄石市大冶市', '435100', '', 'dys', 'D', 0);
INSERT INTO `tp_city` VALUES (199, 192, 0, 3, 0, '其它区', '湖北省黄石市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (200, 136, 0, 2, 0, '十堰市', '湖北省十堰市', '442000', '', 'sys', 'S', 0);
INSERT INTO `tp_city` VALUES (201, 200, 0, 3, 0, '丹江口市', '湖北省十堰市丹江口市', '441900', '', 'djks', 'D', 0);
INSERT INTO `tp_city` VALUES (202, 200, 0, 3, 0, '其它区', '湖北省十堰市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (203, 200, 0, 3, 0, '城区', '湖北省十堰市城区', '', '', 'cq', 'C', 0);
INSERT INTO `tp_city` VALUES (204, 200, 0, 3, 0, '房县', '湖北省十堰市房县', '442100', '', 'fx', 'F', 0);
INSERT INTO `tp_city` VALUES (205, 200, 0, 3, 0, '竹溪县', '湖北省十堰市竹溪县', '442300', '', 'zxx', 'Z', 0);
INSERT INTO `tp_city` VALUES (206, 200, 0, 3, 0, '郧县', '湖北省十堰市郧县', '442500', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (207, 200, 0, 3, 0, '竹山县', '湖北省十堰市竹山县', '442200', '', 'zsx', 'Z', 0);
INSERT INTO `tp_city` VALUES (208, 200, 0, 3, 0, '郧西县', '湖北省十堰市郧西县', '442600', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (209, 200, 0, 3, 0, '张湾区', '湖北省十堰市张湾区', '442001', '', 'zwq', 'Z', 0);
INSERT INTO `tp_city` VALUES (210, 200, 0, 3, 0, '茅箭区', '湖北省十堰市茅箭区', '442012', '', 'mjq', 'M', 0);
INSERT INTO `tp_city` VALUES (211, 136, 0, 2, 0, '孝感市', '湖北省孝感市', '432000', '', 'xgs', 'X', 0);
INSERT INTO `tp_city` VALUES (212, 211, 0, 3, 0, '其它区', '湖北省孝感市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (213, 211, 0, 3, 0, '汉川市', '湖北省孝感市汉川市', '431600', '', 'hcs', 'H', 0);
INSERT INTO `tp_city` VALUES (214, 211, 0, 3, 0, '安陆市', '湖北省孝感市安陆市', '432600', '', 'als', 'A', 0);
INSERT INTO `tp_city` VALUES (215, 211, 0, 3, 0, '应城市', '湖北省孝感市应城市', '432400', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (216, 211, 0, 3, 0, '云梦县', '湖北省孝感市云梦县', '432500', '', 'ymx', 'Y', 0);
INSERT INTO `tp_city` VALUES (217, 211, 0, 3, 0, '大悟县', '湖北省孝感市大悟县', '432800', '', 'dwx', 'D', 0);
INSERT INTO `tp_city` VALUES (218, 211, 0, 3, 0, '孝昌县', '湖北省孝感市孝昌县', '432900', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (219, 211, 0, 3, 0, '孝南区', '湖北省孝感市孝南区', '432100', '', 'xnq', 'X', 0);
INSERT INTO `tp_city` VALUES (220, 136, 0, 2, 0, '黄冈市', '湖北省黄冈市', '438000', '', 'hgs', 'H', 0);
INSERT INTO `tp_city` VALUES (221, 220, 0, 3, 0, '黄州区', '湖北省黄冈市黄州区', '438000', '', 'hzq', 'H', 0);
INSERT INTO `tp_city` VALUES (222, 220, 0, 3, 0, '麻城市', '湖北省黄冈市麻城市', '438300', '', 'mcs', 'M', 0);
INSERT INTO `tp_city` VALUES (223, 220, 0, 3, 0, '其它区', '湖北省黄冈市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (224, 220, 0, 3, 0, '武穴市', '湖北省黄冈市武穴市', '435400', '', 'wxs', 'W', 0);
INSERT INTO `tp_city` VALUES (225, 220, 0, 3, 0, '红安县', '湖北省黄冈市红安县', '431500', '', 'hax', 'H', 0);
INSERT INTO `tp_city` VALUES (226, 220, 0, 3, 0, '罗田县', '湖北省黄冈市罗田县', '438600', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (227, 220, 0, 3, 0, '团风县', '湖北省黄冈市团风县', '438000', '', 'tfx', 'T', 0);
INSERT INTO `tp_city` VALUES (228, 220, 0, 3, 0, '蕲春县', '湖北省黄冈市蕲春县', '436300', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (229, 220, 0, 3, 0, '黄梅县', '湖北省黄冈市黄梅县', '435500', '', 'hmx', 'H', 0);
INSERT INTO `tp_city` VALUES (230, 220, 0, 3, 0, '英山县', '湖北省黄冈市英山县', '438700', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (231, 220, 0, 3, 0, '浠水县', '湖北省黄冈市浠水县', '438200', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (232, 136, 0, 2, 0, '荆州市', '湖北省荆州市', '434000', '', 'jzs', 'J', 0);
INSERT INTO `tp_city` VALUES (233, 232, 0, 3, 0, '其它区', '湖北省荆州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (234, 232, 0, 3, 0, '松滋市', '湖北省荆州市松滋市', '434200', '', 'szs', 'S', 0);
INSERT INTO `tp_city` VALUES (235, 232, 0, 3, 0, '石首市', '湖北省荆州市石首市', '434400', '', 'sss', 'S', 0);
INSERT INTO `tp_city` VALUES (236, 232, 0, 3, 0, '洪湖市', '湖北省荆州市洪湖市', '433200', '', 'hhs', 'H', 0);
INSERT INTO `tp_city` VALUES (237, 232, 0, 3, 0, '江陵县', '湖北省荆州市江陵县', '434100', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (238, 232, 0, 3, 0, '公安县', '湖北省荆州市公安县', '434300', '', 'gax', 'G', 0);
INSERT INTO `tp_city` VALUES (239, 232, 0, 3, 0, '监利县', '湖北省荆州市监利县', '433300', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (240, 232, 0, 3, 0, '荆州区', '湖北省荆州市荆州区', '434020', '', 'jzq', 'J', 0);
INSERT INTO `tp_city` VALUES (241, 232, 0, 3, 0, '沙市区', '湖北省荆州市沙市区', '434000', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (242, 136, 0, 2, 0, '咸宁市', '湖北省咸宁市', '437100', '', 'xns', 'X', 0);
INSERT INTO `tp_city` VALUES (243, 242, 0, 3, 0, '通山县', '湖北省咸宁市通山县', '437600', '', 'tsx', 'T', 0);
INSERT INTO `tp_city` VALUES (244, 242, 0, 3, 0, '嘉鱼县', '湖北省咸宁市嘉鱼县', '437200', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (245, 242, 0, 3, 0, '通城县', '湖北省咸宁市通城县', '437400', '', 'tcx', 'T', 0);
INSERT INTO `tp_city` VALUES (246, 242, 0, 3, 0, '崇阳县', '湖北省咸宁市崇阳县', '437500', '', 'cyx', 'C', 0);
INSERT INTO `tp_city` VALUES (247, 242, 0, 3, 0, '咸安区', '湖北省咸宁市咸安区', '437000', '', 'xaq', 'X', 0);
INSERT INTO `tp_city` VALUES (248, 242, 0, 3, 0, '赤壁市', '湖北省咸宁市赤壁市', '437300', '', 'cbs', 'C', 0);
INSERT INTO `tp_city` VALUES (249, 242, 0, 3, 0, '其它区', '湖北省咸宁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (250, 242, 0, 3, 0, '温泉城区', '湖北省咸宁市温泉城区', '', '', 'wqcq', 'W', 0);
INSERT INTO `tp_city` VALUES (251, 136, 0, 2, 0, '随州市', '湖北省随州市', '441300', '', 'szs', 'S', 0);
INSERT INTO `tp_city` VALUES (252, 251, 0, 3, 0, '广水市', '湖北省随州市广水市', '432700', '', 'gss', 'G', 0);
INSERT INTO `tp_city` VALUES (253, 251, 0, 3, 0, '其它区', '湖北省随州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (254, 251, 0, 3, 0, '随县', '湖北省随州市随县', '441300', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (255, 251, 0, 3, 0, '曾都区', '湖北省随州市曾都区', '441300', '', 'zdq', 'Z', 0);
INSERT INTO `tp_city` VALUES (256, 136, 0, 2, 0, '恩施土家族苗族自治州', '湖北省恩施土家族苗族自治州', '', '', 'estjzmzzzz', 'E', 0);
INSERT INTO `tp_city` VALUES (257, 256, 0, 3, 0, '鹤峰县', '湖北省恩施土家族苗族自治州鹤峰县', '445800', '', 'hfx', 'H', 0);
INSERT INTO `tp_city` VALUES (258, 256, 0, 3, 0, '其它区', '湖北省恩施土家族苗族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (259, 256, 0, 3, 0, '宣恩县', '湖北省恩施土家族苗族自治州宣恩县', '445500', '', 'xex', 'X', 0);
INSERT INTO `tp_city` VALUES (260, 256, 0, 3, 0, '咸丰县', '湖北省恩施土家族苗族自治州咸丰县', '445600', '', 'xfx', 'X', 0);
INSERT INTO `tp_city` VALUES (261, 256, 0, 3, 0, '来凤县', '湖北省恩施土家族苗族自治州来凤县', '445700', '', 'lfx', 'L', 0);
INSERT INTO `tp_city` VALUES (262, 256, 0, 3, 0, '建始县', '湖北省恩施土家族苗族自治州建始县', '445300', '', 'jsx', 'J', 0);
INSERT INTO `tp_city` VALUES (263, 256, 0, 3, 0, '巴东县', '湖北省恩施土家族苗族自治州巴东县', '444300', '', 'bdx', 'B', 0);
INSERT INTO `tp_city` VALUES (264, 256, 0, 3, 0, '利川市', '湖北省恩施土家族苗族自治州利川市', '445400', '', 'lcs', 'L', 0);
INSERT INTO `tp_city` VALUES (265, 256, 0, 3, 0, '恩施市', '湖北省恩施土家族苗族自治州恩施市', '445000', '', 'ess', 'E', 0);
INSERT INTO `tp_city` VALUES (266, 136, 0, 2, 0, '潜江市', '湖北省潜江市', '433100', '', 'qjs', 'Q', 0);
INSERT INTO `tp_city` VALUES (267, 266, 0, 3, 0, '园林办事处', '湖北省潜江市园林办事处', '', '', 'ylbsc', 'Y', 0);
INSERT INTO `tp_city` VALUES (268, 266, 0, 3, 0, '杨市办事处', '湖北省潜江市杨市办事处', '', '', 'ysbsc', 'Y', 0);
INSERT INTO `tp_city` VALUES (269, 266, 0, 3, 0, '周矶办事处', '湖北省潜江市周矶办事处', '', '', 'zbsc', 'Z', 0);
INSERT INTO `tp_city` VALUES (270, 266, 0, 3, 0, '广华办事处', '湖北省潜江市广华办事处', '', '', 'ghbsc', 'G', 0);
INSERT INTO `tp_city` VALUES (271, 266, 0, 3, 0, '泰丰办事处', '湖北省潜江市泰丰办事处', '', '', 'tfbsc', 'T', 0);
INSERT INTO `tp_city` VALUES (272, 266, 0, 3, 0, '高场办事处', '湖北省潜江市高场办事处', '', '', 'gcbsc', 'G', 0);
INSERT INTO `tp_city` VALUES (273, 266, 0, 3, 0, '竹根滩镇', '湖北省潜江市竹根滩镇', '', '', 'zgtz', 'Z', 0);
INSERT INTO `tp_city` VALUES (274, 266, 0, 3, 0, '渔洋镇', '湖北省潜江市渔洋镇', '', '', 'yyz', 'Y', 0);
INSERT INTO `tp_city` VALUES (275, 266, 0, 3, 0, '王场镇', '湖北省潜江市王场镇', '', '', 'wcz', 'W', 0);
INSERT INTO `tp_city` VALUES (276, 266, 0, 3, 0, '高石碑镇', '湖北省潜江市高石碑镇', '', '', 'gsbz', 'G', 0);
INSERT INTO `tp_city` VALUES (277, 266, 0, 3, 0, '熊口镇', '湖北省潜江市熊口镇', '', '', 'xkz', 'X', 0);
INSERT INTO `tp_city` VALUES (278, 266, 0, 3, 0, '老新镇', '湖北省潜江市老新镇', '', '', 'lxz', 'L', 0);
INSERT INTO `tp_city` VALUES (279, 266, 0, 3, 0, '浩口镇', '湖北省潜江市浩口镇', '', '', 'hkz', 'H', 0);
INSERT INTO `tp_city` VALUES (280, 266, 0, 3, 0, '积玉口镇', '湖北省潜江市积玉口镇', '', '', 'jykz', 'J', 0);
INSERT INTO `tp_city` VALUES (281, 266, 0, 3, 0, '张金镇', '湖北省潜江市张金镇', '', '', 'zjz', 'Z', 0);
INSERT INTO `tp_city` VALUES (282, 266, 0, 3, 0, '龙湾镇', '湖北省潜江市龙湾镇', '', '', 'lwz', 'L', 0);
INSERT INTO `tp_city` VALUES (283, 266, 0, 3, 0, '江汉石油管理局', '湖北省潜江市江汉石油管理局', '', '', 'jhsyglj', 'J', 0);
INSERT INTO `tp_city` VALUES (284, 266, 0, 3, 0, '潜江经济开发区', '湖北省潜江市潜江经济开发区', '', '', 'qjjjkfq', 'Q', 0);
INSERT INTO `tp_city` VALUES (285, 266, 0, 3, 0, '周矶管理区', '湖北省潜江市周矶管理区', '', '', 'zglq', 'Z', 0);
INSERT INTO `tp_city` VALUES (286, 266, 0, 3, 0, '后湖管理区', '湖北省潜江市后湖管理区', '', '', 'hhglq', 'H', 0);
INSERT INTO `tp_city` VALUES (287, 266, 0, 3, 0, '熊口管理区', '湖北省潜江市熊口管理区', '', '', 'xkglq', 'X', 0);
INSERT INTO `tp_city` VALUES (288, 266, 0, 3, 0, '总口管理区', '湖北省潜江市总口管理区', '', '', 'zkglq', 'Z', 0);
INSERT INTO `tp_city` VALUES (289, 266, 0, 3, 0, '白鹭湖管理区', '湖北省潜江市白鹭湖管理区', '', '', 'bhglq', 'B', 0);
INSERT INTO `tp_city` VALUES (290, 266, 0, 3, 0, '运粮湖管理区', '湖北省潜江市运粮湖管理区', '', '', 'ylhglq', 'Y', 0);
INSERT INTO `tp_city` VALUES (291, 266, 0, 3, 0, '浩口原种场', '湖北省潜江市浩口原种场', '', '', 'hkyzc', 'H', 0);
INSERT INTO `tp_city` VALUES (292, 136, 0, 2, 0, '仙桃市', '湖北省仙桃市', '433000', '', 'xts', 'X', 0);
INSERT INTO `tp_city` VALUES (293, 292, 0, 3, 0, '沙嘴街道办事处', '湖北省仙桃市沙嘴街道办事处', '', '', 'szjdbsc', 'S', 0);
INSERT INTO `tp_city` VALUES (294, 292, 0, 3, 0, '干河街道办事处', '湖北省仙桃市干河街道办事处', '', '', 'ghjdbsc', 'G', 0);
INSERT INTO `tp_city` VALUES (295, 292, 0, 3, 0, '龙华山办事处', '湖北省仙桃市龙华山办事处', '', '', 'lhsbsc', 'L', 0);
INSERT INTO `tp_city` VALUES (296, 292, 0, 3, 0, '郑场镇', '湖北省仙桃市郑场镇', '', '', 'zcz', 'Z', 0);
INSERT INTO `tp_city` VALUES (297, 292, 0, 3, 0, '毛嘴镇', '湖北省仙桃市毛嘴镇', '', '', 'mzz', 'M', 0);
INSERT INTO `tp_city` VALUES (298, 292, 0, 3, 0, '豆河镇', '湖北省仙桃市豆河镇', '', '', 'dhz', 'D', 0);
INSERT INTO `tp_city` VALUES (299, 292, 0, 3, 0, '三伏潭镇', '湖北省仙桃市三伏潭镇', '', '', 'sftz', 'S', 0);
INSERT INTO `tp_city` VALUES (300, 292, 0, 3, 0, '胡场镇', '湖北省仙桃市胡场镇', '', '', 'hcz', 'H', 0);
INSERT INTO `tp_city` VALUES (301, 292, 0, 3, 0, '长倘口镇', '湖北省仙桃市长倘口镇', '', '', 'ctkz', 'C', 0);
INSERT INTO `tp_city` VALUES (302, 292, 0, 3, 0, '西流河镇', '湖北省仙桃市西流河镇', '', '', 'xlhz', 'X', 0);
INSERT INTO `tp_city` VALUES (303, 292, 0, 3, 0, '沙湖镇', '湖北省仙桃市沙湖镇', '', '', 'shz', 'S', 0);
INSERT INTO `tp_city` VALUES (304, 292, 0, 3, 0, '杨林尾镇', '湖北省仙桃市杨林尾镇', '', '', 'ylwz', 'Y', 0);
INSERT INTO `tp_city` VALUES (305, 292, 0, 3, 0, '彭场镇', '湖北省仙桃市彭场镇', '', '', 'pcz', 'P', 0);
INSERT INTO `tp_city` VALUES (306, 292, 0, 3, 0, '张沟镇', '湖北省仙桃市张沟镇', '', '', 'zgz', 'Z', 0);
INSERT INTO `tp_city` VALUES (307, 292, 0, 3, 0, '郭河镇', '湖北省仙桃市郭河镇', '', '', 'ghz', 'G', 0);
INSERT INTO `tp_city` VALUES (308, 292, 0, 3, 0, '沔城回族镇', '湖北省仙桃市沔城回族镇', '', '', 'chzz', 'Z', 0);
INSERT INTO `tp_city` VALUES (309, 292, 0, 3, 0, '通海口镇', '湖北省仙桃市通海口镇', '', '', 'thkz', 'T', 0);
INSERT INTO `tp_city` VALUES (310, 292, 0, 3, 0, '陈场镇', '湖北省仙桃市陈场镇', '', '', 'ccz', 'C', 0);
INSERT INTO `tp_city` VALUES (311, 292, 0, 3, 0, '工业园区', '湖北省仙桃市工业园区', '', '', 'gyyq', 'G', 0);
INSERT INTO `tp_city` VALUES (312, 292, 0, 3, 0, '九合垸原种场', '湖北省仙桃市九合垸原种场', '', '', 'jhyzc', 'J', 0);
INSERT INTO `tp_city` VALUES (313, 292, 0, 3, 0, '沙湖原种场', '湖北省仙桃市沙湖原种场', '', '', 'shyzc', 'S', 0);
INSERT INTO `tp_city` VALUES (314, 292, 0, 3, 0, '五湖渔场', '湖北省仙桃市五湖渔场', '', '', 'whyc', 'W', 0);
INSERT INTO `tp_city` VALUES (315, 292, 0, 3, 0, '赵西垸林场', '湖北省仙桃市赵西垸林场', '', '', 'zxlc', 'Z', 0);
INSERT INTO `tp_city` VALUES (316, 292, 0, 3, 0, '畜禽良种场', '湖北省仙桃市畜禽良种场', '', '', 'xqlzc', 'X', 0);
INSERT INTO `tp_city` VALUES (317, 292, 0, 3, 0, '排湖风景区', '湖北省仙桃市排湖风景区', '', '', 'phfjq', 'P', 0);
INSERT INTO `tp_city` VALUES (318, 136, 0, 2, 0, '天门市', '湖北省天门市', '431700', '', 'tms', 'T', 0);
INSERT INTO `tp_city` VALUES (319, 318, 0, 3, 0, '竟陵街道办事处', '湖北省天门市竟陵街道办事处', '', '', 'jljdbsc', 'J', 0);
INSERT INTO `tp_city` VALUES (320, 318, 0, 3, 0, '侨乡街道开发区', '湖北省天门市侨乡街道开发区', '', '', 'qxjdkfq', 'Q', 0);
INSERT INTO `tp_city` VALUES (321, 318, 0, 3, 0, '杨林街道办事处', '湖北省天门市杨林街道办事处', '', '', 'yljdbsc', 'Y', 0);
INSERT INTO `tp_city` VALUES (322, 318, 0, 3, 0, '多宝镇', '湖北省天门市多宝镇', '', '', 'dbz', 'D', 0);
INSERT INTO `tp_city` VALUES (323, 318, 0, 3, 0, '拖市镇', '湖北省天门市拖市镇', '', '', 'tsz', 'T', 0);
INSERT INTO `tp_city` VALUES (324, 318, 0, 3, 0, '张港镇', '湖北省天门市张港镇', '', '', 'zgz', 'Z', 0);
INSERT INTO `tp_city` VALUES (325, 318, 0, 3, 0, '蒋场镇', '湖北省天门市蒋场镇', '', '', 'jcz', 'J', 0);
INSERT INTO `tp_city` VALUES (326, 318, 0, 3, 0, '汪场镇', '湖北省天门市汪场镇', '', '', 'wcz', 'W', 0);
INSERT INTO `tp_city` VALUES (327, 318, 0, 3, 0, '渔薪镇', '湖北省天门市渔薪镇', '', '', 'yxz', 'Y', 0);
INSERT INTO `tp_city` VALUES (328, 318, 0, 3, 0, '黄潭镇', '湖北省天门市黄潭镇', '', '', 'htz', 'H', 0);
INSERT INTO `tp_city` VALUES (329, 318, 0, 3, 0, '岳口镇', '湖北省天门市岳口镇', '', '', 'ykz', 'Y', 0);
INSERT INTO `tp_city` VALUES (330, 318, 0, 3, 0, '横林镇', '湖北省天门市横林镇', '', '', 'hlz', 'H', 0);
INSERT INTO `tp_city` VALUES (331, 318, 0, 3, 0, '彭市镇', '湖北省天门市彭市镇', '', '', 'psz', 'P', 0);
INSERT INTO `tp_city` VALUES (332, 318, 0, 3, 0, '麻洋镇', '湖北省天门市麻洋镇', '', '', 'myz', 'M', 0);
INSERT INTO `tp_city` VALUES (333, 318, 0, 3, 0, '多祥镇', '湖北省天门市多祥镇', '', '', 'dxz', 'D', 0);
INSERT INTO `tp_city` VALUES (334, 318, 0, 3, 0, '干驿镇', '湖北省天门市干驿镇', '', '', 'gz', 'G', 0);
INSERT INTO `tp_city` VALUES (335, 318, 0, 3, 0, '马湾镇', '湖北省天门市马湾镇', '', '', 'mwz', 'M', 0);
INSERT INTO `tp_city` VALUES (336, 318, 0, 3, 0, '卢市镇', '湖北省天门市卢市镇', '', '', 'lsz', 'L', 0);
INSERT INTO `tp_city` VALUES (337, 318, 0, 3, 0, '小板镇', '湖北省天门市小板镇', '', '', 'xbz', 'X', 0);
INSERT INTO `tp_city` VALUES (338, 318, 0, 3, 0, '九真镇', '湖北省天门市九真镇', '', '', 'jzz', 'J', 0);
INSERT INTO `tp_city` VALUES (339, 318, 0, 3, 0, '皂市镇', '湖北省天门市皂市镇', '', '', 'zsz', 'Z', 0);
INSERT INTO `tp_city` VALUES (340, 318, 0, 3, 0, '胡市镇', '湖北省天门市胡市镇', '', '', 'hsz', 'H', 0);
INSERT INTO `tp_city` VALUES (341, 318, 0, 3, 0, '石河镇', '湖北省天门市石河镇', '', '', 'shz', 'S', 0);
INSERT INTO `tp_city` VALUES (342, 318, 0, 3, 0, '佛子山镇', '湖北省天门市佛子山镇', '', '', 'fzsz', 'F', 0);
INSERT INTO `tp_city` VALUES (343, 318, 0, 3, 0, '净潭乡', '湖北省天门市净潭乡', '', '', 'jtx', 'J', 0);
INSERT INTO `tp_city` VALUES (344, 318, 0, 3, 0, '蒋湖农场', '湖北省天门市蒋湖农场', '', '', 'jhnc', 'J', 0);
INSERT INTO `tp_city` VALUES (345, 318, 0, 3, 0, '白茅湖农场', '湖北省天门市白茅湖农场', '', '', 'bmhnc', 'B', 0);
INSERT INTO `tp_city` VALUES (346, 318, 0, 3, 0, '沉湖管委会', '湖北省天门市沉湖管委会', '', '', 'chgwh', 'C', 0);
INSERT INTO `tp_city` VALUES (347, 136, 0, 2, 0, '神农架林区', '湖北省神农架林区', '442400', '', 'snjlq', 'S', 0);
INSERT INTO `tp_city` VALUES (348, 347, 0, 3, 0, '松柏镇', '湖北省神农架林区松柏镇', '', '', 'sbz', 'S', 0);
INSERT INTO `tp_city` VALUES (349, 347, 0, 3, 0, '阳日镇', '湖北省神农架林区阳日镇', '', '', 'yrz', 'Y', 0);
INSERT INTO `tp_city` VALUES (350, 347, 0, 3, 0, '木鱼镇', '湖北省神农架林区木鱼镇', '', '', 'myz', 'M', 0);
INSERT INTO `tp_city` VALUES (351, 347, 0, 3, 0, '红坪镇', '湖北省神农架林区红坪镇', '', '', 'hpz', 'H', 0);
INSERT INTO `tp_city` VALUES (352, 347, 0, 3, 0, '新华镇', '湖北省神农架林区新华镇', '', '', 'xhz', 'X', 0);
INSERT INTO `tp_city` VALUES (353, 347, 0, 3, 0, '九湖镇', '湖北省神农架林区九湖镇', '', '', 'jhz', 'J', 0);
INSERT INTO `tp_city` VALUES (354, 347, 0, 3, 0, '宋洛乡', '湖北省神农架林区宋洛乡', '', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (355, 347, 0, 3, 0, '下谷坪土家族乡', '湖北省神农架林区下谷坪土家族乡', '', '', 'xgptjzx', 'X', 0);
INSERT INTO `tp_city` VALUES (356, 0, 0, 1, 0, '山西省', '山西省', '', '', 'sxs', 'S', 0);
INSERT INTO `tp_city` VALUES (357, 356, 0, 2, 0, '运城市', '山西省运城市', '044000', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (358, 357, 0, 3, 0, '盐湖区', '山西省运城市盐湖区', '044300', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (359, 357, 0, 3, 0, '平陆县', '山西省运城市平陆县', '044300', '', 'plx', 'P', 0);
INSERT INTO `tp_city` VALUES (360, 357, 0, 3, 0, '夏县', '山西省运城市夏县', '044400', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (361, 357, 0, 3, 0, '芮城县', '山西省运城市芮城县', '044600', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (362, 357, 0, 3, 0, '新绛县', '山西省运城市新绛县', '043100', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (363, 357, 0, 3, 0, '稷山县', '山西省运城市稷山县', '043200', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (364, 357, 0, 3, 0, '垣曲县', '山西省运城市垣曲县', '043700', '', 'yqx', 'Y', 0);
INSERT INTO `tp_city` VALUES (365, 357, 0, 3, 0, '绛县', '山西省运城市绛县', '043600', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (366, 357, 0, 3, 0, '临猗县', '山西省运城市临猗县', '044100', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (367, 357, 0, 3, 0, '闻喜县', '山西省运城市闻喜县', '043800', '', 'wxx', 'W', 0);
INSERT INTO `tp_city` VALUES (368, 357, 0, 3, 0, '万荣县', '山西省运城市万荣县', '044200', '', 'wrx', 'W', 0);
INSERT INTO `tp_city` VALUES (369, 357, 0, 3, 0, '永济市', '山西省运城市永济市', '044500', '', 'yjs', 'Y', 0);
INSERT INTO `tp_city` VALUES (370, 357, 0, 3, 0, '其它区', '山西省运城市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (371, 357, 0, 3, 0, '河津市', '山西省运城市河津市', '043300', '', 'hjs', 'H', 0);
INSERT INTO `tp_city` VALUES (372, 356, 0, 2, 0, '忻州市', '山西省忻州市', '034000', '', 'xzs', 'X', 0);
INSERT INTO `tp_city` VALUES (373, 372, 0, 3, 0, '忻府区', '山西省忻州市忻府区', '034000', '', 'xfq', 'X', 0);
INSERT INTO `tp_city` VALUES (374, 372, 0, 3, 0, '代县', '山西省忻州市代县', '034200', '', 'dx', 'D', 0);
INSERT INTO `tp_city` VALUES (375, 372, 0, 3, 0, '五台县', '山西省忻州市五台县', '035500', '', 'wtx', 'W', 0);
INSERT INTO `tp_city` VALUES (376, 372, 0, 3, 0, '定襄县', '山西省忻州市定襄县', '035400', '', 'dxx', 'D', 0);
INSERT INTO `tp_city` VALUES (377, 372, 0, 3, 0, '神池县', '山西省忻州市神池县', '036100', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (378, 372, 0, 3, 0, '静乐县', '山西省忻州市静乐县', '035100', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (379, 372, 0, 3, 0, '宁武县', '山西省忻州市宁武县', '036700', '', 'nwx', 'N', 0);
INSERT INTO `tp_city` VALUES (380, 372, 0, 3, 0, '繁峙县', '山西省忻州市繁峙县', '034300', '', 'fzx', 'F', 0);
INSERT INTO `tp_city` VALUES (381, 372, 0, 3, 0, '偏关县', '山西省忻州市偏关县', '036400', '', 'pgx', 'P', 0);
INSERT INTO `tp_city` VALUES (382, 372, 0, 3, 0, '岢岚县', '山西省忻州市岢岚县', '036300', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (383, 372, 0, 3, 0, '五寨县', '山西省忻州市五寨县', '036100', '', 'wzx', 'W', 0);
INSERT INTO `tp_city` VALUES (384, 372, 0, 3, 0, '保德县', '山西省忻州市保德县', '036600', '', 'bdx', 'B', 0);
INSERT INTO `tp_city` VALUES (385, 372, 0, 3, 0, '河曲县', '山西省忻州市河曲县', '036500', '', 'hqx', 'H', 0);
INSERT INTO `tp_city` VALUES (386, 372, 0, 3, 0, '其它区', '山西省忻州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (387, 372, 0, 3, 0, '原平市', '山西省忻州市原平市', '034100', '', 'yps', 'Y', 0);
INSERT INTO `tp_city` VALUES (388, 356, 0, 2, 0, '临汾市', '山西省临汾市', '041000', '', 'lfs', 'L', 0);
INSERT INTO `tp_city` VALUES (389, 388, 0, 3, 0, '尧都区', '山西省临汾市尧都区', '041000', '', 'ydq', 'Y', 0);
INSERT INTO `tp_city` VALUES (390, 388, 0, 3, 0, '曲沃县', '山西省临汾市曲沃县', '043400', '', 'qwx', 'Q', 0);
INSERT INTO `tp_city` VALUES (391, 388, 0, 3, 0, '翼城县', '山西省临汾市翼城县', '043500', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (392, 388, 0, 3, 0, '襄汾县', '山西省临汾市襄汾县', '041500', '', 'xfx', 'X', 0);
INSERT INTO `tp_city` VALUES (393, 388, 0, 3, 0, '浮山县', '山西省临汾市浮山县', '042600', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (394, 388, 0, 3, 0, '安泽县', '山西省临汾市安泽县', '042500', '', 'azx', 'A', 0);
INSERT INTO `tp_city` VALUES (395, 388, 0, 3, 0, '古县', '山西省临汾市古县', '042400', '', 'gx', 'G', 0);
INSERT INTO `tp_city` VALUES (396, 388, 0, 3, 0, '洪洞县', '山西省临汾市洪洞县', '041600', '', 'hdx', 'H', 0);
INSERT INTO `tp_city` VALUES (397, 388, 0, 3, 0, '隰县', '山西省临汾市隰县', '041300', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (398, 388, 0, 3, 0, '大宁县', '山西省临汾市大宁县', '042300', '', 'dnx', 'D', 0);
INSERT INTO `tp_city` VALUES (399, 388, 0, 3, 0, '乡宁县', '山西省临汾市乡宁县', '042100', '', 'xnx', 'X', 0);
INSERT INTO `tp_city` VALUES (400, 388, 0, 3, 0, '吉县', '山西省临汾市吉县', '042200', '', 'jx', 'J', 0);
INSERT INTO `tp_city` VALUES (401, 388, 0, 3, 0, '汾西县', '山西省临汾市汾西县', '031500', '', 'fxx', 'F', 0);
INSERT INTO `tp_city` VALUES (402, 388, 0, 3, 0, '蒲县', '山西省临汾市蒲县', '041200', '', 'px', 'P', 0);
INSERT INTO `tp_city` VALUES (403, 388, 0, 3, 0, '永和县', '山西省临汾市永和县', '041400', '', 'yhx', 'Y', 0);
INSERT INTO `tp_city` VALUES (404, 388, 0, 3, 0, '其它区', '山西省临汾市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (405, 388, 0, 3, 0, '霍州市', '山西省临汾市霍州市', '031400', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (406, 388, 0, 3, 0, '侯马市', '山西省临汾市侯马市', '043000', '', 'hms', 'H', 0);
INSERT INTO `tp_city` VALUES (407, 356, 0, 2, 0, '吕梁市', '山西省吕梁市', '033000', '', 'lls', 'L', 0);
INSERT INTO `tp_city` VALUES (408, 407, 0, 3, 0, '离石区', '山西省吕梁市离石区', '033000', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (409, 407, 0, 3, 0, '交口县', '山西省吕梁市交口县', '032400', '', 'jkx', 'J', 0);
INSERT INTO `tp_city` VALUES (410, 407, 0, 3, 0, '方山县', '山西省吕梁市方山县', '033100', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (411, 407, 0, 3, 0, '中阳县', '山西省吕梁市中阳县', '033400', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (412, 407, 0, 3, 0, '交城县', '山西省吕梁市交城县', '030500', '', 'jcx', 'J', 0);
INSERT INTO `tp_city` VALUES (413, 407, 0, 3, 0, '兴县', '山西省吕梁市兴县', '033601', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (414, 407, 0, 3, 0, '文水县', '山西省吕梁市文水县', '032100', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (415, 407, 0, 3, 0, '石楼县', '山西省吕梁市石楼县', '032500', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (416, 407, 0, 3, 0, '岚县', '山西省吕梁市岚县', '033500', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (417, 407, 0, 3, 0, '临县', '山西省吕梁市临县', '033200', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (418, 407, 0, 3, 0, '柳林县', '山西省吕梁市柳林县', '033300', '', 'llx', 'L', 0);
INSERT INTO `tp_city` VALUES (419, 407, 0, 3, 0, '孝义市', '山西省吕梁市孝义市', '032208', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (420, 407, 0, 3, 0, '其它区', '山西省吕梁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (421, 407, 0, 3, 0, '汾阳市', '山西省吕梁市汾阳市', '032200', '', 'fys', 'F', 0);
INSERT INTO `tp_city` VALUES (422, 356, 0, 2, 0, '阳泉市', '山西省阳泉市', '045000', '', 'yqs', 'Y', 0);
INSERT INTO `tp_city` VALUES (423, 422, 0, 3, 0, '盂县', '山西省阳泉市盂县', '045100', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (424, 422, 0, 3, 0, '其它区', '山西省阳泉市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (425, 422, 0, 3, 0, '平定县', '山西省阳泉市平定县', '045200', '', 'pdx', 'P', 0);
INSERT INTO `tp_city` VALUES (426, 422, 0, 3, 0, '城区', '山西省阳泉市城区', '045000', '', 'cq', 'C', 0);
INSERT INTO `tp_city` VALUES (427, 422, 0, 3, 0, '矿区', '山西省阳泉市矿区', '045000', '', 'kq', 'K', 0);
INSERT INTO `tp_city` VALUES (428, 422, 0, 3, 0, '郊区', '山西省阳泉市郊区', '045011', '', 'jq', 'J', 0);
INSERT INTO `tp_city` VALUES (429, 356, 0, 2, 0, '长治市', '山西省长治市', '046000', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (430, 429, 0, 3, 0, '长治县', '山西省长治市长治县', '047100', '', 'czx', 'C', 0);
INSERT INTO `tp_city` VALUES (431, 429, 0, 3, 0, '襄垣县', '山西省长治市襄垣县', '046200', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (432, 429, 0, 3, 0, '平顺县', '山西省长治市平顺县', '047400', '', 'psx', 'P', 0);
INSERT INTO `tp_city` VALUES (433, 429, 0, 3, 0, '屯留县', '山西省长治市屯留县', '046100', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (434, 429, 0, 3, 0, '壶关县', '山西省长治市壶关县', '047300', '', 'hgx', 'H', 0);
INSERT INTO `tp_city` VALUES (435, 429, 0, 3, 0, '黎城县', '山西省长治市黎城县', '047600', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (436, 429, 0, 3, 0, '武乡县', '山西省长治市武乡县', '046300', '', 'wxx', 'W', 0);
INSERT INTO `tp_city` VALUES (437, 429, 0, 3, 0, '长子县', '山西省长治市长子县', '046600', '', 'czx', 'C', 0);
INSERT INTO `tp_city` VALUES (438, 429, 0, 3, 0, '沁源县', '山西省长治市沁源县', '046500', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (439, 429, 0, 3, 0, '沁县', '山西省长治市沁县', '046400', '', 'qx', 'Q', 0);
INSERT INTO `tp_city` VALUES (440, 429, 0, 3, 0, '其它区', '山西省长治市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (441, 429, 0, 3, 0, '高新区', '山西省长治市高新区', '', '', 'gxq', 'G', 0);
INSERT INTO `tp_city` VALUES (442, 429, 0, 3, 0, '潞城市', '山西省长治市潞城市', '047500', '', 'lcs', 'L', 0);
INSERT INTO `tp_city` VALUES (443, 429, 0, 3, 0, '郊区', '山西省长治市郊区', '046011', '', 'jq', 'J', 0);
INSERT INTO `tp_city` VALUES (444, 429, 0, 3, 0, '城区', '山西省长治市城区', '046011', '', 'cq', 'C', 0);
INSERT INTO `tp_city` VALUES (445, 356, 0, 2, 0, '晋城市', '山西省晋城市', '048000', '', 'jcs', 'J', 0);
INSERT INTO `tp_city` VALUES (446, 445, 0, 3, 0, '泽州县', '山西省晋城市泽州县', '048012', '', 'zzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (447, 445, 0, 3, 0, '陵川县', '山西省晋城市陵川县', '048300', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (448, 445, 0, 3, 0, '阳城县', '山西省晋城市阳城县', '048100', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (449, 445, 0, 3, 0, '沁水县', '山西省晋城市沁水县', '048200', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (450, 445, 0, 3, 0, '城区', '山西省晋城市城区', '048000', '', 'cq', 'C', 0);
INSERT INTO `tp_city` VALUES (451, 445, 0, 3, 0, '高平市', '山西省晋城市高平市', '048400', '', 'gps', 'G', 0);
INSERT INTO `tp_city` VALUES (452, 445, 0, 3, 0, '其它区', '山西省晋城市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (453, 356, 0, 2, 0, '朔州市', '山西省朔州市', '036000', '', 'szs', 'S', 0);
INSERT INTO `tp_city` VALUES (454, 453, 0, 3, 0, '平鲁区', '山西省朔州市平鲁区', '038600', '', 'plq', 'P', 0);
INSERT INTO `tp_city` VALUES (455, 453, 0, 3, 0, '朔城区', '山西省朔州市朔城区', '038500', '', 'scq', 'S', 0);
INSERT INTO `tp_city` VALUES (456, 453, 0, 3, 0, '其它区', '山西省朔州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (457, 453, 0, 3, 0, '怀仁县', '山西省朔州市怀仁县', '038300', '', 'hrx', 'H', 0);
INSERT INTO `tp_city` VALUES (458, 453, 0, 3, 0, '应县', '山西省朔州市应县', '037600', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (459, 453, 0, 3, 0, '右玉县', '山西省朔州市右玉县', '037200', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (460, 453, 0, 3, 0, '山阴县', '山西省朔州市山阴县', '036900', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (461, 356, 0, 2, 0, '晋中市', '山西省晋中市', '030600', '', 'jzs', 'J', 0);
INSERT INTO `tp_city` VALUES (462, 461, 0, 3, 0, '榆社县', '山西省晋中市榆社县', '031800', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (463, 461, 0, 3, 0, '左权县', '山西省晋中市左权县', '032600', '', 'zqx', 'Z', 0);
INSERT INTO `tp_city` VALUES (464, 461, 0, 3, 0, '和顺县', '山西省晋中市和顺县', '032700', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (465, 461, 0, 3, 0, '昔阳县', '山西省晋中市昔阳县', '045300', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (466, 461, 0, 3, 0, '寿阳县', '山西省晋中市寿阳县', '045400', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (467, 461, 0, 3, 0, '太谷县', '山西省晋中市太谷县', '030800', '', 'tgx', 'T', 0);
INSERT INTO `tp_city` VALUES (468, 461, 0, 3, 0, '祁县', '山西省晋中市祁县', '030900', '', 'qx', 'Q', 0);
INSERT INTO `tp_city` VALUES (469, 461, 0, 3, 0, '平遥县', '山西省晋中市平遥县', '031100', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (470, 461, 0, 3, 0, '灵石县', '山西省晋中市灵石县', '031300', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (471, 461, 0, 3, 0, '榆次区', '山西省晋中市榆次区', '030600', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (472, 461, 0, 3, 0, '介休市', '山西省晋中市介休市', '032000', '', 'jxs', 'J', 0);
INSERT INTO `tp_city` VALUES (473, 461, 0, 3, 0, '其它区', '山西省晋中市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (474, 356, 0, 2, 0, '太原市', '山西省太原市', '030000', '', 'tys', 'T', 0);
INSERT INTO `tp_city` VALUES (475, 474, 0, 3, 0, '娄烦县', '山西省太原市娄烦县', '030300', '', 'lfx', 'L', 0);
INSERT INTO `tp_city` VALUES (476, 474, 0, 3, 0, '阳曲县', '山西省太原市阳曲县', '030100', '', 'yqx', 'Y', 0);
INSERT INTO `tp_city` VALUES (477, 474, 0, 3, 0, '清徐县', '山西省太原市清徐县', '030400', '', 'qxx', 'Q', 0);
INSERT INTO `tp_city` VALUES (478, 474, 0, 3, 0, '迎泽区', '山西省太原市迎泽区', '030024', '', 'yzq', 'Y', 0);
INSERT INTO `tp_city` VALUES (479, 474, 0, 3, 0, '杏花岭区', '山西省太原市杏花岭区', '030001', '', 'xhlq', 'X', 0);
INSERT INTO `tp_city` VALUES (480, 474, 0, 3, 0, '小店区', '山西省太原市小店区', '030032', '', 'xdq', 'X', 0);
INSERT INTO `tp_city` VALUES (481, 474, 0, 3, 0, '晋源区', '山西省太原市晋源区', '030025', '', 'jyq', 'J', 0);
INSERT INTO `tp_city` VALUES (482, 474, 0, 3, 0, '尖草坪区', '山西省太原市尖草坪区', '030003', '', 'jcpq', 'J', 0);
INSERT INTO `tp_city` VALUES (483, 474, 0, 3, 0, '万柏林区', '山西省太原市万柏林区', '030027', '', 'wblq', 'W', 0);
INSERT INTO `tp_city` VALUES (484, 474, 0, 3, 0, '其它区', '山西省太原市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (485, 474, 0, 3, 0, '古交市', '山西省太原市古交市', '030200', '', 'gjs', 'G', 0);
INSERT INTO `tp_city` VALUES (486, 356, 0, 2, 0, '大同市', '山西省大同市', '037000', '', 'dts', 'D', 0);
INSERT INTO `tp_city` VALUES (487, 486, 0, 3, 0, '大同县', '山西省大同市大同县', '037300', '', 'dtx', 'D', 0);
INSERT INTO `tp_city` VALUES (488, 486, 0, 3, 0, '左云县', '山西省大同市左云县', '037100', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (489, 486, 0, 3, 0, '浑源县', '山西省大同市浑源县', '037400', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (490, 486, 0, 3, 0, '灵丘县', '山西省大同市灵丘县', '034400', '', 'lqx', 'L', 0);
INSERT INTO `tp_city` VALUES (491, 486, 0, 3, 0, '其它区', '山西省大同市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (492, 486, 0, 3, 0, '阳高县', '山西省大同市阳高县', '038100', '', 'ygx', 'Y', 0);
INSERT INTO `tp_city` VALUES (493, 486, 0, 3, 0, '天镇县', '山西省大同市天镇县', '038200', '', 'tzx', 'T', 0);
INSERT INTO `tp_city` VALUES (494, 486, 0, 3, 0, '广灵县', '山西省大同市广灵县', '037500', '', 'glx', 'G', 0);
INSERT INTO `tp_city` VALUES (495, 486, 0, 3, 0, '新荣区', '山西省大同市新荣区', '037002', '', 'xrq', 'X', 0);
INSERT INTO `tp_city` VALUES (496, 486, 0, 3, 0, '南郊区', '山西省大同市南郊区', '037001', '', 'njq', 'N', 0);
INSERT INTO `tp_city` VALUES (497, 486, 0, 3, 0, '矿区', '山西省大同市矿区', '037001', '', 'kq', 'K', 0);
INSERT INTO `tp_city` VALUES (498, 486, 0, 3, 0, '城区', '山西省大同市城区', '037008', '', 'cq', 'C', 0);
INSERT INTO `tp_city` VALUES (499, 0, 0, 1, 0, '福建省', '福建省', '', '', 'fjs', 'F', 0);
INSERT INTO `tp_city` VALUES (500, 499, 0, 2, 0, '龙岩市', '福建省龙岩市', '364000', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (501, 500, 0, 3, 0, '新罗区', '福建省龙岩市新罗区', '364000', '', 'xlq', 'X', 0);
INSERT INTO `tp_city` VALUES (502, 500, 0, 3, 0, '永定县', '福建省龙岩市永定县', '364100', '', 'ydx', 'Y', 0);
INSERT INTO `tp_city` VALUES (503, 500, 0, 3, 0, '上杭县', '福建省龙岩市上杭县', '364200', '', 'shx', 'S', 0);
INSERT INTO `tp_city` VALUES (504, 500, 0, 3, 0, '长汀县', '福建省龙岩市长汀县', '366300', '', 'ctx', 'C', 0);
INSERT INTO `tp_city` VALUES (505, 500, 0, 3, 0, '武平县', '福建省龙岩市武平县', '364300', '', 'wpx', 'W', 0);
INSERT INTO `tp_city` VALUES (506, 500, 0, 3, 0, '连城县', '福建省龙岩市连城县', '366200', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (507, 500, 0, 3, 0, '其它区', '福建省龙岩市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (508, 500, 0, 3, 0, '漳平市', '福建省龙岩市漳平市', '364400', '', 'zps', 'Z', 0);
INSERT INTO `tp_city` VALUES (509, 499, 0, 2, 0, '宁德市', '福建省宁德市', '352100', '', 'nds', 'N', 0);
INSERT INTO `tp_city` VALUES (510, 509, 0, 3, 0, '福鼎市', '福建省宁德市福鼎市', '355200', '', 'fds', 'F', 0);
INSERT INTO `tp_city` VALUES (511, 509, 0, 3, 0, '其它区', '福建省宁德市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (512, 509, 0, 3, 0, '福安市', '福建省宁德市福安市', '355000', '', 'fas', 'F', 0);
INSERT INTO `tp_city` VALUES (513, 509, 0, 3, 0, '霞浦县', '福建省宁德市霞浦县', '355100', '', 'xpx', 'X', 0);
INSERT INTO `tp_city` VALUES (514, 509, 0, 3, 0, '屏南县', '福建省宁德市屏南县', '352300', '', 'pnx', 'P', 0);
INSERT INTO `tp_city` VALUES (515, 509, 0, 3, 0, '古田县', '福建省宁德市古田县', '352200', '', 'gtx', 'G', 0);
INSERT INTO `tp_city` VALUES (516, 509, 0, 3, 0, '周宁县', '福建省宁德市周宁县', '355400', '', 'znx', 'Z', 0);
INSERT INTO `tp_city` VALUES (517, 509, 0, 3, 0, '寿宁县', '福建省宁德市寿宁县', '355500', '', 'snx', 'S', 0);
INSERT INTO `tp_city` VALUES (518, 509, 0, 3, 0, '柘荣县', '福建省宁德市柘荣县', '355300', '', 'rx', 'Z', 0);
INSERT INTO `tp_city` VALUES (519, 509, 0, 3, 0, '蕉城区', '福建省宁德市蕉城区', '352100', '', 'jcq', 'J', 0);
INSERT INTO `tp_city` VALUES (520, 499, 0, 2, 0, '泉州市', '福建省泉州市', '362000', '', 'qzs', 'Q', 0);
INSERT INTO `tp_city` VALUES (521, 520, 0, 3, 0, '石狮市', '福建省泉州市石狮市', '362700', '', 'sss', 'S', 0);
INSERT INTO `tp_city` VALUES (522, 520, 0, 3, 0, '南安市', '福建省泉州市南安市', '362300', '', 'nas', 'N', 0);
INSERT INTO `tp_city` VALUES (523, 520, 0, 3, 0, '晋江市', '福建省泉州市晋江市', '362200', '', 'jjs', 'J', 0);
INSERT INTO `tp_city` VALUES (524, 520, 0, 3, 0, '其它区', '福建省泉州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (525, 520, 0, 3, 0, '惠安县', '福建省泉州市惠安县', '362100', '', 'hax', 'H', 0);
INSERT INTO `tp_city` VALUES (526, 520, 0, 3, 0, '永春县', '福建省泉州市永春县', '362600', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (527, 520, 0, 3, 0, '安溪县', '福建省泉州市安溪县', '362400', '', 'axx', 'A', 0);
INSERT INTO `tp_city` VALUES (528, 520, 0, 3, 0, '金门县', '福建省泉州市金门县', '362000', '', 'jmx', 'J', 0);
INSERT INTO `tp_city` VALUES (529, 520, 0, 3, 0, '德化县', '福建省泉州市德化县', '362500', '', 'dhx', 'D', 0);
INSERT INTO `tp_city` VALUES (530, 520, 0, 3, 0, '鲤城区', '福建省泉州市鲤城区', '362000', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (531, 520, 0, 3, 0, '丰泽区', '福建省泉州市丰泽区', '362000', '', 'fzq', 'F', 0);
INSERT INTO `tp_city` VALUES (532, 520, 0, 3, 0, '洛江区', '福建省泉州市洛江区', '362011', '', 'ljq', 'L', 0);
INSERT INTO `tp_city` VALUES (533, 520, 0, 3, 0, '泉港区', '福建省泉州市泉港区', '362801', '', 'qgq', 'Q', 0);
INSERT INTO `tp_city` VALUES (534, 499, 0, 2, 0, '南平市', '福建省南平市', '353000', '', 'nps', 'N', 0);
INSERT INTO `tp_city` VALUES (535, 534, 0, 3, 0, '建阳市', '福建省南平市建阳市', '354200', '', 'jys', 'J', 0);
INSERT INTO `tp_city` VALUES (536, 534, 0, 3, 0, '其它区', '福建省南平市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (537, 534, 0, 3, 0, '松溪县', '福建省南平市松溪县', '353500', '', 'sxx', 'S', 0);
INSERT INTO `tp_city` VALUES (538, 534, 0, 3, 0, '政和县', '福建省南平市政和县', '353600', '', 'zhx', 'Z', 0);
INSERT INTO `tp_city` VALUES (539, 534, 0, 3, 0, '顺昌县', '福建省南平市顺昌县', '353200', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (540, 534, 0, 3, 0, '浦城县', '福建省南平市浦城县', '353400', '', 'pcx', 'P', 0);
INSERT INTO `tp_city` VALUES (541, 534, 0, 3, 0, '光泽县', '福建省南平市光泽县', '354100', '', 'gzx', 'G', 0);
INSERT INTO `tp_city` VALUES (542, 534, 0, 3, 0, '建瓯市', '福建省南平市建瓯市', '353100', '', 'js', 'J', 0);
INSERT INTO `tp_city` VALUES (543, 534, 0, 3, 0, '武夷山市', '福建省南平市武夷山市', '354300', '', 'wyss', 'W', 0);
INSERT INTO `tp_city` VALUES (544, 534, 0, 3, 0, '邵武市', '福建省南平市邵武市', '354000', '', 'sws', 'S', 0);
INSERT INTO `tp_city` VALUES (545, 534, 0, 3, 0, '延平区', '福建省南平市延平区', '353000', '', 'ypq', 'Y', 0);
INSERT INTO `tp_city` VALUES (546, 499, 0, 2, 0, '漳州市', '福建省漳州市', '363000', '', 'zzs', 'Z', 0);
INSERT INTO `tp_city` VALUES (547, 546, 0, 3, 0, '其它区', '福建省漳州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (548, 546, 0, 3, 0, '龙海市', '福建省漳州市龙海市', '363100', '', 'lhs', 'L', 0);
INSERT INTO `tp_city` VALUES (549, 546, 0, 3, 0, '长泰县', '福建省漳州市长泰县', '363900', '', 'ctx', 'C', 0);
INSERT INTO `tp_city` VALUES (550, 546, 0, 3, 0, '诏安县', '福建省漳州市诏安县', '363500', '', 'ax', 'Z', 0);
INSERT INTO `tp_city` VALUES (551, 546, 0, 3, 0, '南靖县', '福建省漳州市南靖县', '363600', '', 'njx', 'N', 0);
INSERT INTO `tp_city` VALUES (552, 546, 0, 3, 0, '东山县', '福建省漳州市东山县', '363400', '', 'dsx', 'D', 0);
INSERT INTO `tp_city` VALUES (553, 546, 0, 3, 0, '华安县', '福建省漳州市华安县', '363800', '', 'hax', 'H', 0);
INSERT INTO `tp_city` VALUES (554, 546, 0, 3, 0, '平和县', '福建省漳州市平和县', '363700', '', 'phx', 'P', 0);
INSERT INTO `tp_city` VALUES (555, 546, 0, 3, 0, '云霄县', '福建省漳州市云霄县', '363300', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (556, 546, 0, 3, 0, '漳浦县', '福建省漳州市漳浦县', '363200', '', 'zpx', 'Z', 0);
INSERT INTO `tp_city` VALUES (557, 546, 0, 3, 0, '龙文区', '福建省漳州市龙文区', '363005', '', 'lwq', 'L', 0);
INSERT INTO `tp_city` VALUES (558, 546, 0, 3, 0, '芗城区', '福建省漳州市芗城区', '363000', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (559, 499, 0, 2, 0, '莆田市', '福建省莆田市', '351100', '', 'pts', 'P', 0);
INSERT INTO `tp_city` VALUES (560, 559, 0, 3, 0, '荔城区', '福建省莆田市荔城区', '351100', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (561, 559, 0, 3, 0, '秀屿区', '福建省莆田市秀屿区', '351152', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (562, 559, 0, 3, 0, '其它区', '福建省莆田市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (563, 559, 0, 3, 0, '仙游县', '福建省莆田市仙游县', '351200', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (564, 559, 0, 3, 0, '涵江区', '福建省莆田市涵江区', '351111', '', 'hjq', 'H', 0);
INSERT INTO `tp_city` VALUES (565, 559, 0, 3, 0, '城厢区', '福建省莆田市城厢区', '351100', '', 'cxq', 'C', 0);
INSERT INTO `tp_city` VALUES (566, 499, 0, 2, 0, '三明市', '福建省三明市', '365000', '', 'sms', 'S', 0);
INSERT INTO `tp_city` VALUES (567, 566, 0, 3, 0, '其它区', '福建省三明市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (568, 566, 0, 3, 0, '永安市', '福建省三明市永安市', '366000', '', 'yas', 'Y', 0);
INSERT INTO `tp_city` VALUES (569, 566, 0, 3, 0, '三元区', '福建省三明市三元区', '365001', '', 'syq', 'S', 0);
INSERT INTO `tp_city` VALUES (570, 566, 0, 3, 0, '梅列区', '福建省三明市梅列区', '365000', '', 'mlq', 'M', 0);
INSERT INTO `tp_city` VALUES (571, 566, 0, 3, 0, '将乐县', '福建省三明市将乐县', '353300', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (572, 566, 0, 3, 0, '泰宁县', '福建省三明市泰宁县', '354400', '', 'tnx', 'T', 0);
INSERT INTO `tp_city` VALUES (573, 566, 0, 3, 0, '建宁县', '福建省三明市建宁县', '354500', '', 'jnx', 'J', 0);
INSERT INTO `tp_city` VALUES (574, 566, 0, 3, 0, '宁化县', '福建省三明市宁化县', '365400', '', 'nhx', 'N', 0);
INSERT INTO `tp_city` VALUES (575, 566, 0, 3, 0, '大田县', '福建省三明市大田县', '366100', '', 'dtx', 'D', 0);
INSERT INTO `tp_city` VALUES (576, 566, 0, 3, 0, '尤溪县', '福建省三明市尤溪县', '365100', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (577, 566, 0, 3, 0, '沙县', '福建省三明市沙县', '365500', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (578, 566, 0, 3, 0, '明溪县', '福建省三明市明溪县', '365200', '', 'mxx', 'M', 0);
INSERT INTO `tp_city` VALUES (579, 566, 0, 3, 0, '清流县', '福建省三明市清流县', '365300', '', 'qlx', 'Q', 0);
INSERT INTO `tp_city` VALUES (580, 499, 0, 2, 0, '福州市', '福建省福州市', '350000', '', 'fzs', 'F', 0);
INSERT INTO `tp_city` VALUES (581, 580, 0, 3, 0, '鼓楼区', '福建省福州市鼓楼区', '350001', '', 'glq', 'G', 0);
INSERT INTO `tp_city` VALUES (582, 580, 0, 3, 0, '台江区', '福建省福州市台江区', '350004', '', 'tjq', 'T', 0);
INSERT INTO `tp_city` VALUES (583, 580, 0, 3, 0, '晋安区', '福建省福州市晋安区', '350011', '', 'jaq', 'J', 0);
INSERT INTO `tp_city` VALUES (584, 580, 0, 3, 0, '仓山区', '福建省福州市仓山区', '350007', '', 'csq', 'C', 0);
INSERT INTO `tp_city` VALUES (585, 580, 0, 3, 0, '马尾区', '福建省福州市马尾区', '350015', '', 'mwq', 'M', 0);
INSERT INTO `tp_city` VALUES (586, 580, 0, 3, 0, '永泰县', '福建省福州市永泰县', '350700', '', 'ytx', 'Y', 0);
INSERT INTO `tp_city` VALUES (587, 580, 0, 3, 0, '闽清县', '福建省福州市闽清县', '350800', '', 'mqx', 'M', 0);
INSERT INTO `tp_city` VALUES (588, 580, 0, 3, 0, '闽侯县', '福建省福州市闽侯县', '350100', '', 'mhx', 'M', 0);
INSERT INTO `tp_city` VALUES (589, 580, 0, 3, 0, '罗源县', '福建省福州市罗源县', '350600', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (590, 580, 0, 3, 0, '连江县', '福建省福州市连江县', '350500', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (591, 580, 0, 3, 0, '平潭县', '福建省福州市平潭县', '350400', '', 'ptx', 'P', 0);
INSERT INTO `tp_city` VALUES (592, 580, 0, 3, 0, '福清市', '福建省福州市福清市', '350300', '', 'fqs', 'F', 0);
INSERT INTO `tp_city` VALUES (593, 580, 0, 3, 0, '其它区', '福建省福州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (594, 580, 0, 3, 0, '长乐市', '福建省福州市长乐市', '350200', '', 'cls', 'C', 0);
INSERT INTO `tp_city` VALUES (595, 499, 0, 2, 0, '厦门市', '福建省厦门市', '361000', '', 'xms', 'X', 0);
INSERT INTO `tp_city` VALUES (596, 595, 0, 3, 0, '集美区', '福建省厦门市集美区', '361021', '', 'jmq', 'J', 0);
INSERT INTO `tp_city` VALUES (597, 595, 0, 3, 0, '同安区', '福建省厦门市同安区', '361100', '', 'taq', 'T', 0);
INSERT INTO `tp_city` VALUES (598, 595, 0, 3, 0, '翔安区', '福建省厦门市翔安区', '361101', '', 'xaq', 'X', 0);
INSERT INTO `tp_city` VALUES (599, 595, 0, 3, 0, '其它区', '福建省厦门市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (600, 595, 0, 3, 0, '思明区', '福建省厦门市思明区', '361001', '', 'smq', 'S', 0);
INSERT INTO `tp_city` VALUES (601, 595, 0, 3, 0, '海沧区', '福建省厦门市海沧区', '361026', '', 'hcq', 'H', 0);
INSERT INTO `tp_city` VALUES (602, 595, 0, 3, 0, '湖里区', '福建省厦门市湖里区', '361006', '', 'hlq', 'H', 0);
INSERT INTO `tp_city` VALUES (603, 0, 0, 1, 0, '青海省', '青海省', '', '', 'qhs', 'Q', 0);
INSERT INTO `tp_city` VALUES (604, 603, 0, 2, 0, '西宁市', '青海省西宁市', '810000', '', 'xns', 'X', 0);
INSERT INTO `tp_city` VALUES (605, 604, 0, 3, 0, '其它区', '青海省西宁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (606, 604, 0, 3, 0, '大通回族土族自治县', '青海省西宁市大通回族土族自治县', '810100', '', 'dthztzzzx', 'D', 0);
INSERT INTO `tp_city` VALUES (607, 604, 0, 3, 0, '湟源县', '青海省西宁市湟源县', '812100', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (608, 604, 0, 3, 0, '湟中县', '青海省西宁市湟中县', '811600', '', 'zx', 'Z', 0);
INSERT INTO `tp_city` VALUES (609, 604, 0, 3, 0, '城西区', '青海省西宁市城西区', '810001', '', 'cxq', 'C', 0);
INSERT INTO `tp_city` VALUES (610, 604, 0, 3, 0, '城北区', '青海省西宁市城北区', '810001', '', 'cbq', 'C', 0);
INSERT INTO `tp_city` VALUES (611, 604, 0, 3, 0, '城东区', '青海省西宁市城东区', '810000', '', 'cdq', 'C', 0);
INSERT INTO `tp_city` VALUES (612, 604, 0, 3, 0, '城中区', '青海省西宁市城中区', '810000', '', 'czq', 'C', 0);
INSERT INTO `tp_city` VALUES (613, 603, 0, 2, 0, '海北藏族自治州', '青海省海北藏族自治州', '', '', 'hbczzzz', 'H', 0);
INSERT INTO `tp_city` VALUES (614, 613, 0, 3, 0, '门源回族自治县', '青海省海北藏族自治州门源回族自治县', '810300', '', 'myhzzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (615, 613, 0, 3, 0, '祁连县', '青海省海北藏族自治州祁连县', '810400', '', 'qlx', 'Q', 0);
INSERT INTO `tp_city` VALUES (616, 613, 0, 3, 0, '海晏县', '青海省海北藏族自治州海晏县', '812200', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (617, 613, 0, 3, 0, '其它区', '青海省海北藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (618, 613, 0, 3, 0, '刚察县', '青海省海北藏族自治州刚察县', '812300', '', 'gcx', 'G', 0);
INSERT INTO `tp_city` VALUES (619, 603, 0, 2, 0, '黄南藏族自治州', '青海省黄南藏族自治州', '', '', 'hnczzzz', 'H', 0);
INSERT INTO `tp_city` VALUES (620, 619, 0, 3, 0, '河南蒙古族自治县', '青海省黄南藏族自治州河南蒙古族自治县', '811500', '', 'hnmgzzzx', 'H', 0);
INSERT INTO `tp_city` VALUES (621, 619, 0, 3, 0, '其它区', '青海省黄南藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (622, 619, 0, 3, 0, '尖扎县', '青海省黄南藏族自治州尖扎县', '811200', '', 'jzx', 'J', 0);
INSERT INTO `tp_city` VALUES (623, 619, 0, 3, 0, '泽库县', '青海省黄南藏族自治州泽库县', '811400', '', 'zkx', 'Z', 0);
INSERT INTO `tp_city` VALUES (624, 619, 0, 3, 0, '同仁县', '青海省黄南藏族自治州同仁县', '811300', '', 'trx', 'T', 0);
INSERT INTO `tp_city` VALUES (625, 603, 0, 2, 0, '海东市', '青海省海东市', '', '', 'hds', 'H', 0);
INSERT INTO `tp_city` VALUES (626, 625, 0, 3, 0, '乐都区', '青海省海东市乐都区', '810700', '', 'ldq', 'L', 0);
INSERT INTO `tp_city` VALUES (627, 625, 0, 3, 0, '民和回族土族自治县', '青海省海东市民和回族土族自治县', '810800', '', 'mhhztzzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (628, 625, 0, 3, 0, '平安县', '青海省海东市平安县', '810600', '', 'pax', 'P', 0);
INSERT INTO `tp_city` VALUES (629, 625, 0, 3, 0, '化隆回族自治县', '青海省海东市化隆回族自治县', '810900', '', 'hlhzzzx', 'H', 0);
INSERT INTO `tp_city` VALUES (630, 625, 0, 3, 0, '互助土族自治县', '青海省海东市互助土族自治县', '810500', '', 'hztzzzx', 'H', 0);
INSERT INTO `tp_city` VALUES (631, 625, 0, 3, 0, '循化撒拉族自治县', '青海省海东市循化撒拉族自治县', '811100', '', 'xhslzzzx', 'X', 0);
INSERT INTO `tp_city` VALUES (632, 625, 0, 3, 0, '其它区', '青海省海东市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (633, 603, 0, 2, 0, '海西蒙古族藏族自治州', '青海省海西蒙古族藏族自治州', '', '', 'hxmgzczzzz', 'H', 0);
INSERT INTO `tp_city` VALUES (634, 633, 0, 3, 0, '德令哈市', '青海省海西蒙古族藏族自治州德令哈市', '817000', '', 'dlhs', 'D', 0);
INSERT INTO `tp_city` VALUES (635, 633, 0, 3, 0, '格尔木市', '青海省海西蒙古族藏族自治州格尔木市', '816000', '', 'gems', 'G', 0);
INSERT INTO `tp_city` VALUES (636, 633, 0, 3, 0, '都兰县', '青海省海西蒙古族藏族自治州都兰县', '816100', '', 'dlx', 'D', 0);
INSERT INTO `tp_city` VALUES (637, 633, 0, 3, 0, '天峻县', '青海省海西蒙古族藏族自治州天峻县', '817200', '', 'tjx', 'T', 0);
INSERT INTO `tp_city` VALUES (638, 633, 0, 3, 0, '乌兰县', '青海省海西蒙古族藏族自治州乌兰县', '817100', '', 'wlx', 'W', 0);
INSERT INTO `tp_city` VALUES (639, 633, 0, 3, 0, '其它区', '青海省海西蒙古族藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (640, 603, 0, 2, 0, '果洛藏族自治州', '青海省果洛藏族自治州', '', '', 'glczzzz', 'G', 0);
INSERT INTO `tp_city` VALUES (641, 640, 0, 3, 0, '班玛县', '青海省果洛藏族自治州班玛县', '814300', '', 'bmx', 'B', 0);
INSERT INTO `tp_city` VALUES (642, 640, 0, 3, 0, '甘德县', '青海省果洛藏族自治州甘德县', '814100', '', 'gdx', 'G', 0);
INSERT INTO `tp_city` VALUES (643, 640, 0, 3, 0, '玛沁县', '青海省果洛藏族自治州玛沁县', '814000', '', 'mqx', 'M', 0);
INSERT INTO `tp_city` VALUES (644, 640, 0, 3, 0, '其它区', '青海省果洛藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (645, 640, 0, 3, 0, '玛多县', '青海省果洛藏族自治州玛多县', '813500', '', 'mdx', 'M', 0);
INSERT INTO `tp_city` VALUES (646, 640, 0, 3, 0, '久治县', '青海省果洛藏族自治州久治县', '624700', '', 'jzx', 'J', 0);
INSERT INTO `tp_city` VALUES (647, 640, 0, 3, 0, '达日县', '青海省果洛藏族自治州达日县', '814200', '', 'drx', 'D', 0);
INSERT INTO `tp_city` VALUES (648, 603, 0, 2, 0, '玉树藏族自治州', '青海省玉树藏族自治州', '', '', 'ysczzzz', 'Y', 0);
INSERT INTO `tp_city` VALUES (649, 648, 0, 3, 0, '治多县', '青海省玉树藏族自治州治多县', '815400', '', 'zdx', 'Z', 0);
INSERT INTO `tp_city` VALUES (650, 648, 0, 3, 0, '囊谦县', '青海省玉树藏族自治州囊谦县', '815200', '', 'nqx', 'N', 0);
INSERT INTO `tp_city` VALUES (651, 648, 0, 3, 0, '曲麻莱县', '青海省玉树藏族自治州曲麻莱县', '815500', '', 'qmlx', 'Q', 0);
INSERT INTO `tp_city` VALUES (652, 648, 0, 3, 0, '其它区', '青海省玉树藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (653, 648, 0, 3, 0, '玉树市', '青海省玉树藏族自治州玉树市', '815000', '', 'yss', 'Y', 0);
INSERT INTO `tp_city` VALUES (654, 648, 0, 3, 0, '杂多县', '青海省玉树藏族自治州杂多县', '815300', '', 'zdx', 'Z', 0);
INSERT INTO `tp_city` VALUES (655, 648, 0, 3, 0, '称多县', '青海省玉树藏族自治州称多县', '815100', '', 'cdx', 'C', 0);
INSERT INTO `tp_city` VALUES (656, 603, 0, 2, 0, '海南藏族自治州', '青海省海南藏族自治州', '', '', 'hnczzzz', 'H', 0);
INSERT INTO `tp_city` VALUES (657, 656, 0, 3, 0, '贵德县', '青海省海南藏族自治州贵德县', '811700', '', 'gdx', 'G', 0);
INSERT INTO `tp_city` VALUES (658, 656, 0, 3, 0, '同德县', '青海省海南藏族自治州同德县', '813200', '', 'tdx', 'T', 0);
INSERT INTO `tp_city` VALUES (659, 656, 0, 3, 0, '共和县', '青海省海南藏族自治州共和县', '813000', '', 'ghx', 'G', 0);
INSERT INTO `tp_city` VALUES (660, 656, 0, 3, 0, '其它区', '青海省海南藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (661, 656, 0, 3, 0, '贵南县', '青海省海南藏族自治州贵南县', '813100', '', 'gnx', 'G', 0);
INSERT INTO `tp_city` VALUES (662, 656, 0, 3, 0, '兴海县', '青海省海南藏族自治州兴海县', '813300', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (663, 0, 0, 1, 0, '江西省', '江西省', '', '', 'jxs', 'J', 0);
INSERT INTO `tp_city` VALUES (664, 663, 0, 2, 0, '萍乡市', '江西省萍乡市', '337000', '', 'pxs', 'P', 0);
INSERT INTO `tp_city` VALUES (665, 664, 0, 3, 0, '湘东区', '江西省萍乡市湘东区', '337032', '', 'xdq', 'X', 0);
INSERT INTO `tp_city` VALUES (666, 664, 0, 3, 0, '安源区', '江西省萍乡市安源区', '337000', '', 'ayq', 'A', 0);
INSERT INTO `tp_city` VALUES (667, 664, 0, 3, 0, '其它区', '江西省萍乡市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (668, 664, 0, 3, 0, '莲花县', '江西省萍乡市莲花县', '337100', '', 'lhx', 'L', 0);
INSERT INTO `tp_city` VALUES (669, 664, 0, 3, 0, '芦溪县', '江西省萍乡市芦溪县', '337200', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (670, 664, 0, 3, 0, '上栗县', '江西省萍乡市上栗县', '337009', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (671, 663, 0, 2, 0, '景德镇市', '江西省景德镇市', '333000', '', 'jdzs', 'J', 0);
INSERT INTO `tp_city` VALUES (672, 671, 0, 3, 0, '乐平市', '江西省景德镇市乐平市', '333300', '', 'lps', 'L', 0);
INSERT INTO `tp_city` VALUES (673, 671, 0, 3, 0, '其它区', '江西省景德镇市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (674, 671, 0, 3, 0, '浮梁县', '江西省景德镇市浮梁县', '333400', '', 'flx', 'F', 0);
INSERT INTO `tp_city` VALUES (675, 671, 0, 3, 0, '昌江区', '江西省景德镇市昌江区', '333000', '', 'cjq', 'C', 0);
INSERT INTO `tp_city` VALUES (676, 671, 0, 3, 0, '珠山区', '江西省景德镇市珠山区', '333000', '', 'zsq', 'Z', 0);
INSERT INTO `tp_city` VALUES (677, 663, 0, 2, 0, '九江市', '江西省九江市', '332000', '', 'jjs', 'J', 0);
INSERT INTO `tp_city` VALUES (678, 677, 0, 3, 0, '庐山区', '江西省九江市庐山区', '332005', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (679, 677, 0, 3, 0, '浔阳区', '江西省九江市浔阳区', '332000', '', 'yq', 'Z', 0);
INSERT INTO `tp_city` VALUES (680, 677, 0, 3, 0, '武宁县', '江西省九江市武宁县', '332300', '', 'wnx', 'W', 0);
INSERT INTO `tp_city` VALUES (681, 677, 0, 3, 0, '九江县', '江西省九江市九江县', '332100', '', 'jjx', 'J', 0);
INSERT INTO `tp_city` VALUES (682, 677, 0, 3, 0, '星子县', '江西省九江市星子县', '332800', '', 'xzx', 'X', 0);
INSERT INTO `tp_city` VALUES (683, 677, 0, 3, 0, '德安县', '江西省九江市德安县', '330400', '', 'dax', 'D', 0);
INSERT INTO `tp_city` VALUES (684, 677, 0, 3, 0, '永修县', '江西省九江市永修县', '330300', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (685, 677, 0, 3, 0, '修水县', '江西省九江市修水县', '332400', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (686, 677, 0, 3, 0, '彭泽县', '江西省九江市彭泽县', '332700', '', 'pzx', 'P', 0);
INSERT INTO `tp_city` VALUES (687, 677, 0, 3, 0, '湖口县', '江西省九江市湖口县', '332500', '', 'hkx', 'H', 0);
INSERT INTO `tp_city` VALUES (688, 677, 0, 3, 0, '都昌县', '江西省九江市都昌县', '332600', '', 'dcx', 'D', 0);
INSERT INTO `tp_city` VALUES (689, 677, 0, 3, 0, '共青城市', '江西省九江市共青城市', '', '', 'gqcs', 'G', 0);
INSERT INTO `tp_city` VALUES (690, 677, 0, 3, 0, '其它区', '江西省九江市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (691, 677, 0, 3, 0, '瑞昌市', '江西省九江市瑞昌市', '332200', '', 'rcs', 'R', 0);
INSERT INTO `tp_city` VALUES (692, 663, 0, 2, 0, '南昌市', '江西省南昌市', '330000', '', 'ncs', 'N', 0);
INSERT INTO `tp_city` VALUES (693, 692, 0, 3, 0, '其它区', '江西省南昌市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (694, 692, 0, 3, 0, '西湖区', '江西省南昌市西湖区', '330009', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (695, 692, 0, 3, 0, '东湖区', '江西省南昌市东湖区', '330006', '', 'dhq', 'D', 0);
INSERT INTO `tp_city` VALUES (696, 692, 0, 3, 0, '青山湖区', '江西省南昌市青山湖区', '330006', '', 'qshq', 'Q', 0);
INSERT INTO `tp_city` VALUES (697, 692, 0, 3, 0, '湾里区', '江西省南昌市湾里区', '330004', '', 'wlq', 'W', 0);
INSERT INTO `tp_city` VALUES (698, 692, 0, 3, 0, '青云谱区', '江西省南昌市青云谱区', '330001', '', 'qypq', 'Q', 0);
INSERT INTO `tp_city` VALUES (699, 692, 0, 3, 0, '进贤县', '江西省南昌市进贤县', '331700', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (700, 692, 0, 3, 0, '红谷滩新区', '江西省南昌市红谷滩新区', '', '', 'hgtxq', 'H', 0);
INSERT INTO `tp_city` VALUES (701, 692, 0, 3, 0, '经济技术开发区', '江西省南昌市经济技术开发区', '', '', 'jjjskfq', 'J', 0);
INSERT INTO `tp_city` VALUES (702, 692, 0, 3, 0, '昌北区', '江西省南昌市昌北区', '', '', 'cbq', 'C', 0);
INSERT INTO `tp_city` VALUES (703, 692, 0, 3, 0, '南昌县', '江西省南昌市南昌县', '330200', '', 'ncx', 'N', 0);
INSERT INTO `tp_city` VALUES (704, 692, 0, 3, 0, '新建县', '江西省南昌市新建县', '330100', '', 'xjx', 'X', 0);
INSERT INTO `tp_city` VALUES (705, 692, 0, 3, 0, '安义县', '江西省南昌市安义县', '330500', '', 'ayx', 'A', 0);
INSERT INTO `tp_city` VALUES (706, 663, 0, 2, 0, '抚州市', '江西省抚州市', '344000', '', 'fzs', 'F', 0);
INSERT INTO `tp_city` VALUES (707, 706, 0, 3, 0, '东乡县', '江西省抚州市东乡县', '331800', '', 'dxx', 'D', 0);
INSERT INTO `tp_city` VALUES (708, 706, 0, 3, 0, '资溪县', '江西省抚州市资溪县', '335300', '', 'zxx', 'Z', 0);
INSERT INTO `tp_city` VALUES (709, 706, 0, 3, 0, '其它区', '江西省抚州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (710, 706, 0, 3, 0, '广昌县', '江西省抚州市广昌县', '344900', '', 'gcx', 'G', 0);
INSERT INTO `tp_city` VALUES (711, 706, 0, 3, 0, '乐安县', '江西省抚州市乐安县', '344300', '', 'lax', 'L', 0);
INSERT INTO `tp_city` VALUES (712, 706, 0, 3, 0, '崇仁县', '江西省抚州市崇仁县', '344200', '', 'crx', 'C', 0);
INSERT INTO `tp_city` VALUES (713, 706, 0, 3, 0, '金溪县', '江西省抚州市金溪县', '344800', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (714, 706, 0, 3, 0, '宜黄县', '江西省抚州市宜黄县', '344400', '', 'yhx', 'Y', 0);
INSERT INTO `tp_city` VALUES (715, 706, 0, 3, 0, '黎川县', '江西省抚州市黎川县', '344600', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (716, 706, 0, 3, 0, '南丰县', '江西省抚州市南丰县', '344500', '', 'nfx', 'N', 0);
INSERT INTO `tp_city` VALUES (717, 706, 0, 3, 0, '南城县', '江西省抚州市南城县', '344700', '', 'ncx', 'N', 0);
INSERT INTO `tp_city` VALUES (718, 706, 0, 3, 0, '临川区', '江西省抚州市临川区', '344100', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (719, 663, 0, 2, 0, '上饶市', '江西省上饶市', '334000', '', 'srs', 'S', 0);
INSERT INTO `tp_city` VALUES (720, 719, 0, 3, 0, '德兴市', '江西省上饶市德兴市', '334200', '', 'dxs', 'D', 0);
INSERT INTO `tp_city` VALUES (721, 719, 0, 3, 0, '其它区', '江西省上饶市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (722, 719, 0, 3, 0, '广丰县', '江西省上饶市广丰县', '334600', '', 'gfx', 'G', 0);
INSERT INTO `tp_city` VALUES (723, 719, 0, 3, 0, '玉山县', '江西省上饶市玉山县', '334700', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (724, 719, 0, 3, 0, '上饶县', '江西省上饶市上饶县', '334100', '', 'srx', 'S', 0);
INSERT INTO `tp_city` VALUES (725, 719, 0, 3, 0, '弋阳县', '江西省上饶市弋阳县', '334400', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (726, 719, 0, 3, 0, '余干县', '江西省上饶市余干县', '335100', '', 'ygx', 'Y', 0);
INSERT INTO `tp_city` VALUES (727, 719, 0, 3, 0, '铅山县', '江西省上饶市铅山县', '334500', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (728, 719, 0, 3, 0, '横峰县', '江西省上饶市横峰县', '334300', '', 'hfx', 'H', 0);
INSERT INTO `tp_city` VALUES (729, 719, 0, 3, 0, '婺源县', '江西省上饶市婺源县', '333200', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (730, 719, 0, 3, 0, '鄱阳县', '江西省上饶市鄱阳县', '333100', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (731, 719, 0, 3, 0, '万年县', '江西省上饶市万年县', '335500', '', 'wnx', 'W', 0);
INSERT INTO `tp_city` VALUES (732, 719, 0, 3, 0, '信州区', '江西省上饶市信州区', '334000', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (733, 663, 0, 2, 0, '吉安市', '江西省吉安市', '343000', '', 'jas', 'J', 0);
INSERT INTO `tp_city` VALUES (734, 733, 0, 3, 0, '青原区', '江西省吉安市青原区', '343009', '', 'qyq', 'Q', 0);
INSERT INTO `tp_city` VALUES (735, 733, 0, 3, 0, '吉州区', '江西省吉安市吉州区', '343000', '', 'jzq', 'J', 0);
INSERT INTO `tp_city` VALUES (736, 733, 0, 3, 0, '新干县', '江西省吉安市新干县', '331300', '', 'xgx', 'X', 0);
INSERT INTO `tp_city` VALUES (737, 733, 0, 3, 0, '永丰县', '江西省吉安市永丰县', '331500', '', 'yfx', 'Y', 0);
INSERT INTO `tp_city` VALUES (738, 733, 0, 3, 0, '泰和县', '江西省吉安市泰和县', '343700', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (739, 733, 0, 3, 0, '遂川县', '江西省吉安市遂川县', '343900', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (740, 733, 0, 3, 0, '万安县', '江西省吉安市万安县', '343800', '', 'wax', 'W', 0);
INSERT INTO `tp_city` VALUES (741, 733, 0, 3, 0, '安福县', '江西省吉安市安福县', '343200', '', 'afx', 'A', 0);
INSERT INTO `tp_city` VALUES (742, 733, 0, 3, 0, '永新县', '江西省吉安市永新县', '343400', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (743, 733, 0, 3, 0, '吉安县', '江西省吉安市吉安县', '343100', '', 'jax', 'J', 0);
INSERT INTO `tp_city` VALUES (744, 733, 0, 3, 0, '吉水县', '江西省吉安市吉水县', '331600', '', 'jsx', 'J', 0);
INSERT INTO `tp_city` VALUES (745, 733, 0, 3, 0, '峡江县', '江西省吉安市峡江县', '331400', '', 'xjx', 'X', 0);
INSERT INTO `tp_city` VALUES (746, 733, 0, 3, 0, '井冈山市', '江西省吉安市井冈山市', '343600', '', 'jgss', 'J', 0);
INSERT INTO `tp_city` VALUES (747, 733, 0, 3, 0, '其它区', '江西省吉安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (748, 663, 0, 2, 0, '宜春市', '江西省宜春市', '336000', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (749, 748, 0, 3, 0, '其它区', '江西省宜春市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (750, 748, 0, 3, 0, '丰城市', '江西省宜春市丰城市', '331100', '', 'fcs', 'F', 0);
INSERT INTO `tp_city` VALUES (751, 748, 0, 3, 0, '樟树市', '江西省宜春市樟树市', '331200', '', 'zss', 'Z', 0);
INSERT INTO `tp_city` VALUES (752, 748, 0, 3, 0, '高安市', '江西省宜春市高安市', '330800', '', 'gas', 'G', 0);
INSERT INTO `tp_city` VALUES (753, 748, 0, 3, 0, '袁州区', '江西省宜春市袁州区', '336000', '', 'yzq', 'Y', 0);
INSERT INTO `tp_city` VALUES (754, 748, 0, 3, 0, '上高县', '江西省宜春市上高县', '336400', '', 'sgx', 'S', 0);
INSERT INTO `tp_city` VALUES (755, 748, 0, 3, 0, '万载县', '江西省宜春市万载县', '336100', '', 'wzx', 'W', 0);
INSERT INTO `tp_city` VALUES (756, 748, 0, 3, 0, '奉新县', '江西省宜春市奉新县', '330700', '', 'fxx', 'F', 0);
INSERT INTO `tp_city` VALUES (757, 748, 0, 3, 0, '铜鼓县', '江西省宜春市铜鼓县', '336200', '', 'tgx', 'T', 0);
INSERT INTO `tp_city` VALUES (758, 748, 0, 3, 0, '靖安县', '江西省宜春市靖安县', '330600', '', 'jax', 'J', 0);
INSERT INTO `tp_city` VALUES (759, 748, 0, 3, 0, '宜丰县', '江西省宜春市宜丰县', '336300', '', 'yfx', 'Y', 0);
INSERT INTO `tp_city` VALUES (760, 663, 0, 2, 0, '新余市', '江西省新余市', '338000', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (761, 760, 0, 3, 0, '分宜县', '江西省新余市分宜县', '336600', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (762, 760, 0, 3, 0, '其它区', '江西省新余市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (763, 760, 0, 3, 0, '渝水区', '江西省新余市渝水区', '338025', '', 'ysq', 'Y', 0);
INSERT INTO `tp_city` VALUES (764, 663, 0, 2, 0, '赣州市', '江西省赣州市', '341000', '', 'gzs', 'G', 0);
INSERT INTO `tp_city` VALUES (765, 764, 0, 3, 0, '其它区', '江西省赣州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (766, 764, 0, 3, 0, '南康市', '江西省赣州市南康市', '341400', '', 'nks', 'N', 0);
INSERT INTO `tp_city` VALUES (767, 764, 0, 3, 0, '瑞金市', '江西省赣州市瑞金市', '342500', '', 'rjs', 'R', 0);
INSERT INTO `tp_city` VALUES (768, 764, 0, 3, 0, '寻乌县', '江西省赣州市寻乌县', '342200', '', 'xwx', 'X', 0);
INSERT INTO `tp_city` VALUES (769, 764, 0, 3, 0, '石城县', '江西省赣州市石城县', '342700', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (770, 764, 0, 3, 0, '兴国县', '江西省赣州市兴国县', '342400', '', 'xgx', 'X', 0);
INSERT INTO `tp_city` VALUES (771, 764, 0, 3, 0, '会昌县', '江西省赣州市会昌县', '342600', '', 'hcx', 'H', 0);
INSERT INTO `tp_city` VALUES (772, 764, 0, 3, 0, '宁都县', '江西省赣州市宁都县', '342800', '', 'ndx', 'N', 0);
INSERT INTO `tp_city` VALUES (773, 764, 0, 3, 0, '于都县', '江西省赣州市于都县', '342300', '', 'ydx', 'Y', 0);
INSERT INTO `tp_city` VALUES (774, 764, 0, 3, 0, '定南县', '江西省赣州市定南县', '341900', '', 'dnx', 'D', 0);
INSERT INTO `tp_city` VALUES (775, 764, 0, 3, 0, '全南县', '江西省赣州市全南县', '341800', '', 'qnx', 'Q', 0);
INSERT INTO `tp_city` VALUES (776, 764, 0, 3, 0, '安远县', '江西省赣州市安远县', '342100', '', 'ayx', 'A', 0);
INSERT INTO `tp_city` VALUES (777, 764, 0, 3, 0, '龙南县', '江西省赣州市龙南县', '341700', '', 'lnx', 'L', 0);
INSERT INTO `tp_city` VALUES (778, 764, 0, 3, 0, '上犹县', '江西省赣州市上犹县', '341200', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (779, 764, 0, 3, 0, '崇义县', '江西省赣州市崇义县', '341300', '', 'cyx', 'C', 0);
INSERT INTO `tp_city` VALUES (780, 764, 0, 3, 0, '信丰县', '江西省赣州市信丰县', '341600', '', 'xfx', 'X', 0);
INSERT INTO `tp_city` VALUES (781, 764, 0, 3, 0, '大余县', '江西省赣州市大余县', '341500', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (782, 764, 0, 3, 0, '赣县', '江西省赣州市赣县', '341100', '', 'gx', 'G', 0);
INSERT INTO `tp_city` VALUES (783, 764, 0, 3, 0, '黄金区', '江西省赣州市黄金区', '', '', 'hjq', 'H', 0);
INSERT INTO `tp_city` VALUES (784, 764, 0, 3, 0, '章贡区', '江西省赣州市章贡区', '', '', 'zgq', 'Z', 0);
INSERT INTO `tp_city` VALUES (785, 663, 0, 2, 0, '鹰潭市', '江西省鹰潭市', '335000', '', 'yts', 'Y', 0);
INSERT INTO `tp_city` VALUES (786, 785, 0, 3, 0, '其它区', '江西省鹰潭市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (787, 785, 0, 3, 0, '贵溪市', '江西省鹰潭市贵溪市', '335400', '', 'gxs', 'G', 0);
INSERT INTO `tp_city` VALUES (788, 785, 0, 3, 0, '月湖区', '江西省鹰潭市月湖区', '335000', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (789, 785, 0, 3, 0, '余江县', '江西省鹰潭市余江县', '335200', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (790, 0, 0, 1, 0, '河南省', '河南省', '', '', 'hns', 'H', 0);
INSERT INTO `tp_city` VALUES (791, 790, 0, 2, 0, '驻马店市', '河南省驻马店市', '463000', '', 'zmds', 'Z', 0);
INSERT INTO `tp_city` VALUES (792, 791, 0, 3, 0, '其它区', '河南省驻马店市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (793, 791, 0, 3, 0, '新蔡县', '河南省驻马店市新蔡县', '463500', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (794, 791, 0, 3, 0, '遂平县', '河南省驻马店市遂平县', '463100', '', 'spx', 'S', 0);
INSERT INTO `tp_city` VALUES (795, 791, 0, 3, 0, '泌阳县', '河南省驻马店市泌阳县', '463700', '', 'myx', 'M', 0);
INSERT INTO `tp_city` VALUES (796, 791, 0, 3, 0, '汝南县', '河南省驻马店市汝南县', '463300', '', 'rnx', 'R', 0);
INSERT INTO `tp_city` VALUES (797, 791, 0, 3, 0, '正阳县', '河南省驻马店市正阳县', '463600', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (798, 791, 0, 3, 0, '确山县', '河南省驻马店市确山县', '463200', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (799, 791, 0, 3, 0, '上蔡县', '河南省驻马店市上蔡县', '463800', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (800, 791, 0, 3, 0, '平舆县', '河南省驻马店市平舆县', '463400', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (801, 791, 0, 3, 0, '西平县', '河南省驻马店市西平县', '463900', '', 'xpx', 'X', 0);
INSERT INTO `tp_city` VALUES (802, 791, 0, 3, 0, '驿城区', '河南省驻马店市驿城区', '463000', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (803, 790, 0, 2, 0, '郑州市', '河南省郑州市', '450000', '', 'zzs', 'Z', 0);
INSERT INTO `tp_city` VALUES (804, 803, 0, 3, 0, '惠济区', '河南省郑州市惠济区', '450053', '', 'hjq', 'H', 0);
INSERT INTO `tp_city` VALUES (805, 803, 0, 3, 0, '上街区', '河南省郑州市上街区', '450041', '', 'sjq', 'S', 0);
INSERT INTO `tp_city` VALUES (806, 803, 0, 3, 0, '管城回族区', '河南省郑州市管城回族区', '450000', '', 'gchzq', 'G', 0);
INSERT INTO `tp_city` VALUES (807, 803, 0, 3, 0, '金水区', '河南省郑州市金水区', '450003', '', 'jsq', 'J', 0);
INSERT INTO `tp_city` VALUES (808, 803, 0, 3, 0, '中原区', '河南省郑州市中原区', '450007', '', 'zyq', 'Z', 0);
INSERT INTO `tp_city` VALUES (809, 803, 0, 3, 0, '二七区', '河南省郑州市二七区', '450000', '', 'eqq', 'E', 0);
INSERT INTO `tp_city` VALUES (810, 803, 0, 3, 0, '荥阳市', '河南省郑州市荥阳市', '450100', '', 'ys', 'Z', 0);
INSERT INTO `tp_city` VALUES (811, 803, 0, 3, 0, '新密市', '河南省郑州市新密市', '452300', '', 'xms', 'X', 0);
INSERT INTO `tp_city` VALUES (812, 803, 0, 3, 0, '巩义市', '河南省郑州市巩义市', '451200', '', 'gys', 'G', 0);
INSERT INTO `tp_city` VALUES (813, 803, 0, 3, 0, '郑东新区', '河南省郑州市郑东新区', '', '', 'zdxq', 'Z', 0);
INSERT INTO `tp_city` VALUES (814, 803, 0, 3, 0, '高新区', '河南省郑州市高新区', '', '', 'gxq', 'G', 0);
INSERT INTO `tp_city` VALUES (815, 803, 0, 3, 0, '新郑市', '河南省郑州市新郑市', '451150', '', 'xzs', 'X', 0);
INSERT INTO `tp_city` VALUES (816, 803, 0, 3, 0, '登封市', '河南省郑州市登封市', '452470', '', 'dfs', 'D', 0);
INSERT INTO `tp_city` VALUES (817, 803, 0, 3, 0, '其它区', '河南省郑州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (818, 803, 0, 3, 0, '中牟县', '河南省郑州市中牟县', '451450', '', 'zmx', 'Z', 0);
INSERT INTO `tp_city` VALUES (819, 790, 0, 2, 0, '洛阳市', '河南省洛阳市', '471000', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (820, 819, 0, 3, 0, '洛龙区', '河南省洛阳市洛龙区', '471000', '', 'llq', 'L', 0);
INSERT INTO `tp_city` VALUES (821, 819, 0, 3, 0, '吉利区', '河南省洛阳市吉利区', '471012', '', 'jlq', 'J', 0);
INSERT INTO `tp_city` VALUES (822, 819, 0, 3, 0, '涧西区', '河南省洛阳市涧西区', '471003', '', 'jxq', 'J', 0);
INSERT INTO `tp_city` VALUES (823, 819, 0, 3, 0, '瀍河回族区', '河南省洛阳市瀍河回族区', '471002', '', 'hhzq', 'H', 0);
INSERT INTO `tp_city` VALUES (824, 819, 0, 3, 0, '洛宁县', '河南省洛阳市洛宁县', '471700', '', 'lnx', 'L', 0);
INSERT INTO `tp_city` VALUES (825, 819, 0, 3, 0, '伊川县', '河南省洛阳市伊川县', '471300', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (826, 819, 0, 3, 0, '孟津县', '河南省洛阳市孟津县', '471100', '', 'mjx', 'M', 0);
INSERT INTO `tp_city` VALUES (827, 819, 0, 3, 0, '新安县', '河南省洛阳市新安县', '471800', '', 'xax', 'X', 0);
INSERT INTO `tp_city` VALUES (828, 819, 0, 3, 0, '汝阳县', '河南省洛阳市汝阳县', '471200', '', 'ryx', 'R', 0);
INSERT INTO `tp_city` VALUES (829, 819, 0, 3, 0, '宜阳县', '河南省洛阳市宜阳县', '471600', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (830, 819, 0, 3, 0, '栾川县', '河南省洛阳市栾川县', '471500', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (831, 819, 0, 3, 0, '嵩县', '河南省洛阳市嵩县', '471400', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (832, 819, 0, 3, 0, '老城区', '河南省洛阳市老城区', '471002', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (833, 819, 0, 3, 0, '西工区', '河南省洛阳市西工区', '471000', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (834, 819, 0, 3, 0, '偃师市', '河南省洛阳市偃师市', '471900', '', 'ss', 'Z', 0);
INSERT INTO `tp_city` VALUES (835, 819, 0, 3, 0, '其它区', '河南省洛阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (836, 819, 0, 3, 0, '高新区', '河南省洛阳市高新区', '', '', 'gxq', 'G', 0);
INSERT INTO `tp_city` VALUES (837, 790, 0, 2, 0, '开封市', '河南省开封市', '475000', '', 'kfs', 'K', 0);
INSERT INTO `tp_city` VALUES (838, 837, 0, 3, 0, '顺河回族区', '河南省开封市顺河回族区', '475000', '', 'shhzq', 'S', 0);
INSERT INTO `tp_city` VALUES (839, 837, 0, 3, 0, '龙亭区', '河南省开封市龙亭区', '475100', '', 'ltq', 'L', 0);
INSERT INTO `tp_city` VALUES (840, 837, 0, 3, 0, '禹王台区', '河南省开封市禹王台区', '475003', '', 'ywtq', 'Y', 0);
INSERT INTO `tp_city` VALUES (841, 837, 0, 3, 0, '鼓楼区', '河南省开封市鼓楼区', '475000', '', 'glq', 'G', 0);
INSERT INTO `tp_city` VALUES (842, 837, 0, 3, 0, '金明区', '河南省开封市金明区', '475002', '', 'jmq', 'J', 0);
INSERT INTO `tp_city` VALUES (843, 837, 0, 3, 0, '杞县', '河南省开封市杞县', '475200', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (844, 837, 0, 3, 0, '通许县', '河南省开封市通许县', '475400', '', 'txx', 'T', 0);
INSERT INTO `tp_city` VALUES (845, 837, 0, 3, 0, '尉氏县', '河南省开封市尉氏县', '475500', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (846, 837, 0, 3, 0, '兰考县', '河南省开封市兰考县', '475300', '', 'lkx', 'L', 0);
INSERT INTO `tp_city` VALUES (847, 837, 0, 3, 0, '开封县', '河南省开封市开封县', '475100', '', 'kfx', 'K', 0);
INSERT INTO `tp_city` VALUES (848, 837, 0, 3, 0, '其它区', '河南省开封市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (849, 790, 0, 2, 0, '鹤壁市', '河南省鹤壁市', '458000', '', 'hbs', 'H', 0);
INSERT INTO `tp_city` VALUES (850, 849, 0, 3, 0, '淇县', '河南省鹤壁市淇县', '456750', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (851, 849, 0, 3, 0, '其它区', '河南省鹤壁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (852, 849, 0, 3, 0, '浚县', '河南省鹤壁市浚县', '456250', '', 'jx', 'J', 0);
INSERT INTO `tp_city` VALUES (853, 849, 0, 3, 0, '淇滨区', '河南省鹤壁市淇滨区', '458030', '', 'bq', 'Z', 0);
INSERT INTO `tp_city` VALUES (854, 849, 0, 3, 0, '山城区', '河南省鹤壁市山城区', '458000', '', 'scq', 'S', 0);
INSERT INTO `tp_city` VALUES (855, 849, 0, 3, 0, '鹤山区', '河南省鹤壁市鹤山区', '458010', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (856, 790, 0, 2, 0, '安阳市', '河南省安阳市', '455000', '', 'ays', 'A', 0);
INSERT INTO `tp_city` VALUES (857, 856, 0, 3, 0, '林州市', '河南省安阳市林州市', '456500', '', 'lzs', 'L', 0);
INSERT INTO `tp_city` VALUES (858, 856, 0, 3, 0, '其它区', '河南省安阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (859, 856, 0, 3, 0, '滑县', '河南省安阳市滑县', '456400', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (860, 856, 0, 3, 0, '内黄县', '河南省安阳市内黄县', '456300', '', 'nhx', 'N', 0);
INSERT INTO `tp_city` VALUES (861, 856, 0, 3, 0, '安阳县', '河南省安阳市安阳县', '455100', '', 'ayx', 'A', 0);
INSERT INTO `tp_city` VALUES (862, 856, 0, 3, 0, '汤阴县', '河南省安阳市汤阴县', '456150', '', 'tyx', 'T', 0);
INSERT INTO `tp_city` VALUES (863, 856, 0, 3, 0, '殷都区', '河南省安阳市殷都区', '455004', '', 'ydq', 'Y', 0);
INSERT INTO `tp_city` VALUES (864, 856, 0, 3, 0, '龙安区', '河南省安阳市龙安区', '455001', '', 'laq', 'L', 0);
INSERT INTO `tp_city` VALUES (865, 856, 0, 3, 0, '北关区', '河南省安阳市北关区', '455001', '', 'bgq', 'B', 0);
INSERT INTO `tp_city` VALUES (866, 856, 0, 3, 0, '文峰区', '河南省安阳市文峰区', '455000', '', 'wfq', 'W', 0);
INSERT INTO `tp_city` VALUES (867, 790, 0, 2, 0, '平顶山市', '河南省平顶山市', '467000', '', 'pdss', 'P', 0);
INSERT INTO `tp_city` VALUES (868, 867, 0, 3, 0, '其它区', '河南省平顶山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (869, 867, 0, 3, 0, '汝州市', '河南省平顶山市汝州市', '467500', '', 'rzs', 'R', 0);
INSERT INTO `tp_city` VALUES (870, 867, 0, 3, 0, '舞钢市', '河南省平顶山市舞钢市', '462500', '', 'wgs', 'W', 0);
INSERT INTO `tp_city` VALUES (871, 867, 0, 3, 0, '鲁山县', '河南省平顶山市鲁山县', '467300', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (872, 867, 0, 3, 0, '叶县', '河南省平顶山市叶县', '467200', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (873, 867, 0, 3, 0, '宝丰县', '河南省平顶山市宝丰县', '467400', '', 'bfx', 'B', 0);
INSERT INTO `tp_city` VALUES (874, 867, 0, 3, 0, '郏县', '河南省平顶山市郏县', '467100', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (875, 867, 0, 3, 0, '石龙区', '河南省平顶山市石龙区', '467045', '', 'slq', 'S', 0);
INSERT INTO `tp_city` VALUES (876, 867, 0, 3, 0, '新华区', '河南省平顶山市新华区', '467002', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (877, 867, 0, 3, 0, '卫东区', '河南省平顶山市卫东区', '467021', '', 'wdq', 'W', 0);
INSERT INTO `tp_city` VALUES (878, 867, 0, 3, 0, '湛河区', '河南省平顶山市湛河区', '467000', '', 'zhq', 'Z', 0);
INSERT INTO `tp_city` VALUES (879, 790, 0, 2, 0, '焦作市', '河南省焦作市', '454000', '', 'jzs', 'J', 0);
INSERT INTO `tp_city` VALUES (880, 879, 0, 3, 0, '解放区', '河南省焦作市解放区', '454000', '', 'jfq', 'J', 0);
INSERT INTO `tp_city` VALUES (881, 879, 0, 3, 0, '中站区', '河南省焦作市中站区', '454191', '', 'zzq', 'Z', 0);
INSERT INTO `tp_city` VALUES (882, 879, 0, 3, 0, '马村区', '河南省焦作市马村区', '454171', '', 'mcq', 'M', 0);
INSERT INTO `tp_city` VALUES (883, 879, 0, 3, 0, '山阳区', '河南省焦作市山阳区', '454002', '', 'syq', 'S', 0);
INSERT INTO `tp_city` VALUES (884, 879, 0, 3, 0, '武陟县', '河南省焦作市武陟县', '454950', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (885, 879, 0, 3, 0, '博爱县', '河南省焦作市博爱县', '454450', '', 'bax', 'B', 0);
INSERT INTO `tp_city` VALUES (886, 879, 0, 3, 0, '修武县', '河南省焦作市修武县', '454350', '', 'xwx', 'X', 0);
INSERT INTO `tp_city` VALUES (887, 879, 0, 3, 0, '温县', '河南省焦作市温县', '454850', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (888, 879, 0, 3, 0, '沁阳市', '河南省焦作市沁阳市', '454550', '', 'qys', 'Q', 0);
INSERT INTO `tp_city` VALUES (889, 879, 0, 3, 0, '孟州市', '河南省焦作市孟州市', '454750', '', 'mzs', 'M', 0);
INSERT INTO `tp_city` VALUES (890, 879, 0, 3, 0, '其它区', '河南省焦作市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (891, 790, 0, 2, 0, '新乡市', '河南省新乡市', '453000', '', 'xxs', 'X', 0);
INSERT INTO `tp_city` VALUES (892, 891, 0, 3, 0, '辉县市', '河南省新乡市辉县市', '453600', '', 'hxs', 'H', 0);
INSERT INTO `tp_city` VALUES (893, 891, 0, 3, 0, '其它区', '河南省新乡市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (894, 891, 0, 3, 0, '卫辉市', '河南省新乡市卫辉市', '453100', '', 'whs', 'W', 0);
INSERT INTO `tp_city` VALUES (895, 891, 0, 3, 0, '长垣县', '河南省新乡市长垣县', '453400', '', 'cyx', 'C', 0);
INSERT INTO `tp_city` VALUES (896, 891, 0, 3, 0, '获嘉县', '河南省新乡市获嘉县', '453800', '', 'hjx', 'H', 0);
INSERT INTO `tp_city` VALUES (897, 891, 0, 3, 0, '原阳县', '河南省新乡市原阳县', '453500', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (898, 891, 0, 3, 0, '延津县', '河南省新乡市延津县', '453200', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (899, 891, 0, 3, 0, '封丘县', '河南省新乡市封丘县', '453300', '', 'fqx', 'F', 0);
INSERT INTO `tp_city` VALUES (900, 891, 0, 3, 0, '新乡县', '河南省新乡市新乡县', '453700', '', 'xxx', 'X', 0);
INSERT INTO `tp_city` VALUES (901, 891, 0, 3, 0, '红旗区', '河南省新乡市红旗区', '453000', '', 'hqq', 'H', 0);
INSERT INTO `tp_city` VALUES (902, 891, 0, 3, 0, '卫滨区', '河南省新乡市卫滨区', '453000', '', 'wbq', 'W', 0);
INSERT INTO `tp_city` VALUES (903, 891, 0, 3, 0, '牧野区', '河南省新乡市牧野区', '453002', '', 'myq', 'M', 0);
INSERT INTO `tp_city` VALUES (904, 891, 0, 3, 0, '凤泉区', '河南省新乡市凤泉区', '453011', '', 'fqq', 'F', 0);
INSERT INTO `tp_city` VALUES (905, 790, 0, 2, 0, '漯河市', '河南省漯河市', '462000', '', 'hs', 'Z', 0);
INSERT INTO `tp_city` VALUES (906, 905, 0, 3, 0, '临颍县', '河南省漯河市临颍县', '462600', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (907, 905, 0, 3, 0, '其它区', '河南省漯河市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (908, 905, 0, 3, 0, '舞阳县', '河南省漯河市舞阳县', '462400', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (909, 905, 0, 3, 0, '召陵区', '河南省漯河市召陵区', '462300', '', 'zlq', 'Z', 0);
INSERT INTO `tp_city` VALUES (910, 905, 0, 3, 0, '源汇区', '河南省漯河市源汇区', '462000', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (911, 905, 0, 3, 0, '郾城区', '河南省漯河市郾城区', '462300', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (912, 790, 0, 2, 0, '濮阳市', '河南省濮阳市', '457000', '', 'ys', 'Z', 0);
INSERT INTO `tp_city` VALUES (913, 912, 0, 3, 0, '其它区', '河南省濮阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (914, 912, 0, 3, 0, '濮阳县', '河南省濮阳市濮阳县', '457100', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (915, 912, 0, 3, 0, '清丰县', '河南省濮阳市清丰县', '457300', '', 'qfx', 'Q', 0);
INSERT INTO `tp_city` VALUES (916, 912, 0, 3, 0, '南乐县', '河南省濮阳市南乐县', '457400', '', 'nlx', 'N', 0);
INSERT INTO `tp_city` VALUES (917, 912, 0, 3, 0, '范县', '河南省濮阳市范县', '457500', '', 'fx', 'F', 0);
INSERT INTO `tp_city` VALUES (918, 912, 0, 3, 0, '台前县', '河南省濮阳市台前县', '457600', '', 'tqx', 'T', 0);
INSERT INTO `tp_city` VALUES (919, 912, 0, 3, 0, '华龙区', '河南省濮阳市华龙区', '457001', '', 'hlq', 'H', 0);
INSERT INTO `tp_city` VALUES (920, 790, 0, 2, 0, '济源市', '河南省济源市', '454650', '', 'jys', 'J', 0);
INSERT INTO `tp_city` VALUES (921, 920, 0, 3, 0, '沁园街道办事处', '河南省济源市沁园街道办事处', '', '', 'qyjdbsc', 'Q', 0);
INSERT INTO `tp_city` VALUES (922, 920, 0, 3, 0, '济水街道办事处', '河南省济源市济水街道办事处', '', '', 'jsjdbsc', 'J', 0);
INSERT INTO `tp_city` VALUES (923, 920, 0, 3, 0, '北海街道办事处', '河南省济源市北海街道办事处', '', '', 'bhjdbsc', 'B', 0);
INSERT INTO `tp_city` VALUES (924, 920, 0, 3, 0, '天坛街道办事处', '河南省济源市天坛街道办事处', '', '', 'ttjdbsc', 'T', 0);
INSERT INTO `tp_city` VALUES (925, 920, 0, 3, 0, '玉泉街道办事处', '河南省济源市玉泉街道办事处', '', '', 'yqjdbsc', 'Y', 0);
INSERT INTO `tp_city` VALUES (926, 920, 0, 3, 0, '克井镇', '河南省济源市克井镇', '', '', 'kjz', 'K', 0);
INSERT INTO `tp_city` VALUES (927, 920, 0, 3, 0, '五龙口镇', '河南省济源市五龙口镇', '', '', 'wlkz', 'W', 0);
INSERT INTO `tp_city` VALUES (928, 920, 0, 3, 0, '轵城镇', '河南省济源市轵城镇', '', '', 'cz', 'Z', 0);
INSERT INTO `tp_city` VALUES (929, 920, 0, 3, 0, '承留镇', '河南省济源市承留镇', '', '', 'clz', 'C', 0);
INSERT INTO `tp_city` VALUES (930, 920, 0, 3, 0, '邵原镇', '河南省济源市邵原镇', '', '', 'syz', 'S', 0);
INSERT INTO `tp_city` VALUES (931, 920, 0, 3, 0, '坡头镇', '河南省济源市坡头镇', '', '', 'ptz', 'P', 0);
INSERT INTO `tp_city` VALUES (932, 920, 0, 3, 0, '梨林镇', '河南省济源市梨林镇', '', '', 'llz', 'L', 0);
INSERT INTO `tp_city` VALUES (933, 920, 0, 3, 0, '大峪镇', '河南省济源市大峪镇', '', '', 'dyz', 'D', 0);
INSERT INTO `tp_city` VALUES (934, 920, 0, 3, 0, '思礼镇', '河南省济源市思礼镇', '', '', 'slz', 'S', 0);
INSERT INTO `tp_city` VALUES (935, 920, 0, 3, 0, '王屋镇', '河南省济源市王屋镇', '', '', 'wwz', 'W', 0);
INSERT INTO `tp_city` VALUES (936, 920, 0, 3, 0, '下冶镇', '河南省济源市下冶镇', '', '', 'xyz', 'X', 0);
INSERT INTO `tp_city` VALUES (937, 790, 0, 2, 0, '许昌市', '河南省许昌市', '461000', '', 'xcs', 'X', 0);
INSERT INTO `tp_city` VALUES (938, 937, 0, 3, 0, '鄢陵县', '河南省许昌市鄢陵县', '461200', '', 'lx', 'Z', 0);
INSERT INTO `tp_city` VALUES (939, 937, 0, 3, 0, '襄城县', '河南省许昌市襄城县', '461700', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (940, 937, 0, 3, 0, '许昌县', '河南省许昌市许昌县', '461100', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (941, 937, 0, 3, 0, '禹州市', '河南省许昌市禹州市', '461670', '', 'yzs', 'Y', 0);
INSERT INTO `tp_city` VALUES (942, 937, 0, 3, 0, '其它区', '河南省许昌市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (943, 937, 0, 3, 0, '长葛市', '河南省许昌市长葛市', '461500', '', 'cgs', 'C', 0);
INSERT INTO `tp_city` VALUES (944, 937, 0, 3, 0, '魏都区', '河南省许昌市魏都区', '461000', '', 'wdq', 'W', 0);
INSERT INTO `tp_city` VALUES (945, 790, 0, 2, 0, '南阳市', '河南省南阳市', '473000', '', 'nys', 'N', 0);
INSERT INTO `tp_city` VALUES (946, 945, 0, 3, 0, '卧龙区', '河南省南阳市卧龙区', '473003', '', 'wlq', 'W', 0);
INSERT INTO `tp_city` VALUES (947, 945, 0, 3, 0, '宛城区', '河南省南阳市宛城区', '473001', '', 'wcq', 'W', 0);
INSERT INTO `tp_city` VALUES (948, 945, 0, 3, 0, '镇平县', '河南省南阳市镇平县', '474250', '', 'zpx', 'Z', 0);
INSERT INTO `tp_city` VALUES (949, 945, 0, 3, 0, '内乡县', '河南省南阳市内乡县', '474350', '', 'nxx', 'N', 0);
INSERT INTO `tp_city` VALUES (950, 945, 0, 3, 0, '淅川县', '河南省南阳市淅川县', '474450', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (951, 945, 0, 3, 0, '社旗县', '河南省南阳市社旗县', '473300', '', 'sqx', 'S', 0);
INSERT INTO `tp_city` VALUES (952, 945, 0, 3, 0, '南召县', '河南省南阳市南召县', '474650', '', 'nzx', 'N', 0);
INSERT INTO `tp_city` VALUES (953, 945, 0, 3, 0, '方城县', '河南省南阳市方城县', '473200', '', 'fcx', 'F', 0);
INSERT INTO `tp_city` VALUES (954, 945, 0, 3, 0, '西峡县', '河南省南阳市西峡县', '474550', '', 'xxx', 'X', 0);
INSERT INTO `tp_city` VALUES (955, 945, 0, 3, 0, '桐柏县', '河南省南阳市桐柏县', '474750', '', 'tbx', 'T', 0);
INSERT INTO `tp_city` VALUES (956, 945, 0, 3, 0, '新野县', '河南省南阳市新野县', '473500', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (957, 945, 0, 3, 0, '唐河县', '河南省南阳市唐河县', '473400', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (958, 945, 0, 3, 0, '邓州市', '河南省南阳市邓州市', '474150', '', 'dzs', 'D', 0);
INSERT INTO `tp_city` VALUES (959, 945, 0, 3, 0, '其它区', '河南省南阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (960, 790, 0, 2, 0, '三门峡市', '河南省三门峡市', '472000', '', 'smxs', 'S', 0);
INSERT INTO `tp_city` VALUES (961, 960, 0, 3, 0, '灵宝市', '河南省三门峡市灵宝市', '472500', '', 'lbs', 'L', 0);
INSERT INTO `tp_city` VALUES (962, 960, 0, 3, 0, '其它区', '河南省三门峡市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (963, 960, 0, 3, 0, '义马市', '河南省三门峡市义马市', '472300', '', 'yms', 'Y', 0);
INSERT INTO `tp_city` VALUES (964, 960, 0, 3, 0, '湖滨区', '河南省三门峡市湖滨区', '472000', '', 'hbq', 'H', 0);
INSERT INTO `tp_city` VALUES (965, 960, 0, 3, 0, '卢氏县', '河南省三门峡市卢氏县', '472200', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (966, 960, 0, 3, 0, '陕县', '河南省三门峡市陕县', '472100', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (967, 960, 0, 3, 0, '渑池县', '河南省三门峡市渑池县', '472400', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (968, 790, 0, 2, 0, '周口市', '河南省周口市', '466000', '', 'zks', 'Z', 0);
INSERT INTO `tp_city` VALUES (969, 968, 0, 3, 0, '项城市', '河南省周口市项城市', '466200', '', 'xcs', 'X', 0);
INSERT INTO `tp_city` VALUES (970, 968, 0, 3, 0, '其它区', '河南省周口市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (971, 968, 0, 3, 0, '川汇区', '河南省周口市川汇区', '466000', '', 'chq', 'C', 0);
INSERT INTO `tp_city` VALUES (972, 968, 0, 3, 0, '商水县', '河南省周口市商水县', '466100', '', 'ssx', 'S', 0);
INSERT INTO `tp_city` VALUES (973, 968, 0, 3, 0, '西华县', '河南省周口市西华县', '466600', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (974, 968, 0, 3, 0, '扶沟县', '河南省周口市扶沟县', '461300', '', 'fgx', 'F', 0);
INSERT INTO `tp_city` VALUES (975, 968, 0, 3, 0, '太康县', '河南省周口市太康县', '475400', '', 'tkx', 'T', 0);
INSERT INTO `tp_city` VALUES (976, 968, 0, 3, 0, '淮阳县', '河南省周口市淮阳县', '466700', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (977, 968, 0, 3, 0, '郸城县', '河南省周口市郸城县', '477150', '', 'dcx', 'D', 0);
INSERT INTO `tp_city` VALUES (978, 968, 0, 3, 0, '沈丘县', '河南省周口市沈丘县', '466300', '', 'sqx', 'S', 0);
INSERT INTO `tp_city` VALUES (979, 968, 0, 3, 0, '鹿邑县', '河南省周口市鹿邑县', '477200', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (980, 790, 0, 2, 0, '商丘市', '河南省商丘市', '476000', '', 'sqs', 'S', 0);
INSERT INTO `tp_city` VALUES (981, 980, 0, 3, 0, '民权县', '河南省商丘市民权县', '476800', '', 'mqx', 'M', 0);
INSERT INTO `tp_city` VALUES (982, 980, 0, 3, 0, '宁陵县', '河南省商丘市宁陵县', '476700', '', 'nlx', 'N', 0);
INSERT INTO `tp_city` VALUES (983, 980, 0, 3, 0, '睢县', '河南省商丘市睢县', '476900', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (984, 980, 0, 3, 0, '梁园区', '河南省商丘市梁园区', '476000', '', 'lyq', 'L', 0);
INSERT INTO `tp_city` VALUES (985, 980, 0, 3, 0, '睢阳区', '河南省商丘市睢阳区', '476100', '', 'yq', 'Z', 0);
INSERT INTO `tp_city` VALUES (986, 980, 0, 3, 0, '夏邑县', '河南省商丘市夏邑县', '476400', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (987, 980, 0, 3, 0, '柘城县', '河南省商丘市柘城县', '476200', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (988, 980, 0, 3, 0, '虞城县', '河南省商丘市虞城县', '476300', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (989, 980, 0, 3, 0, '永城市', '河南省商丘市永城市', '476600', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (990, 980, 0, 3, 0, '其它区', '河南省商丘市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (991, 790, 0, 2, 0, '信阳市', '河南省信阳市', '464000', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (992, 991, 0, 3, 0, '固始县', '河南省信阳市固始县', '465200', '', 'gsx', 'G', 0);
INSERT INTO `tp_city` VALUES (993, 991, 0, 3, 0, '商城县', '河南省信阳市商城县', '465350', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (994, 991, 0, 3, 0, '淮滨县', '河南省信阳市淮滨县', '464400', '', 'hbx', 'H', 0);
INSERT INTO `tp_city` VALUES (995, 991, 0, 3, 0, '潢川县', '河南省信阳市潢川县', '465150', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (996, 991, 0, 3, 0, '罗山县', '河南省信阳市罗山县', '464200', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (997, 991, 0, 3, 0, '新县', '河南省信阳市新县', '465550', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (998, 991, 0, 3, 0, '光山县', '河南省信阳市光山县', '465450', '', 'gsx', 'G', 0);
INSERT INTO `tp_city` VALUES (999, 991, 0, 3, 0, '其它区', '河南省信阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1000, 991, 0, 3, 0, '息县', '河南省信阳市息县', '464300', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (1001, 991, 0, 3, 0, '浉河区', '河南省信阳市浉河区', '464000', '', 'hq', 'H', 0);
INSERT INTO `tp_city` VALUES (1002, 991, 0, 3, 0, '平桥区', '河南省信阳市平桥区', '464100', '', 'pqq', 'P', 0);
INSERT INTO `tp_city` VALUES (1003, 0, 0, 1, 0, '宁夏回族自治区', '宁夏回族自治区', '', '', 'nxhzzzq', 'N', 0);
INSERT INTO `tp_city` VALUES (1004, 1003, 0, 2, 0, '吴忠市', '宁夏回族自治区吴忠市', '751100', '', 'wzs', 'W', 0);
INSERT INTO `tp_city` VALUES (1005, 1004, 0, 3, 0, '盐池县', '宁夏回族自治区吴忠市盐池县', '751500', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1006, 1004, 0, 3, 0, '同心县', '宁夏回族自治区吴忠市同心县', '751300', '', 'txx', 'T', 0);
INSERT INTO `tp_city` VALUES (1007, 1004, 0, 3, 0, '青铜峡市', '宁夏回族自治区吴忠市青铜峡市', '751600', '', 'qtxs', 'Q', 0);
INSERT INTO `tp_city` VALUES (1008, 1004, 0, 3, 0, '其它区', '宁夏回族自治区吴忠市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1009, 1004, 0, 3, 0, '利通区', '宁夏回族自治区吴忠市利通区', '751100', '', 'ltq', 'L', 0);
INSERT INTO `tp_city` VALUES (1010, 1004, 0, 3, 0, '红寺堡区', '宁夏回族自治区吴忠市红寺堡区', '751900', '', 'hsbq', 'H', 0);
INSERT INTO `tp_city` VALUES (1011, 1003, 0, 2, 0, '中卫市', '宁夏回族自治区中卫市', '', '', 'zws', 'Z', 0);
INSERT INTO `tp_city` VALUES (1012, 1011, 0, 3, 0, '中宁县', '宁夏回族自治区中卫市中宁县', '751200', '', 'znx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1013, 1011, 0, 3, 0, '海原县', '宁夏回族自治区中卫市海原县', '756100', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (1014, 1011, 0, 3, 0, '其它区', '宁夏回族自治区中卫市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1015, 1011, 0, 3, 0, '沙坡头区', '宁夏回族自治区中卫市沙坡头区', '751700', '', 'sptq', 'S', 0);
INSERT INTO `tp_city` VALUES (1016, 1003, 0, 2, 0, '固原市', '宁夏回族自治区固原市', '756000', '', 'gys', 'G', 0);
INSERT INTO `tp_city` VALUES (1017, 1016, 0, 3, 0, '原州区', '宁夏回族自治区固原市原州区', '756000', '', 'yzq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1018, 1016, 0, 3, 0, '隆德县', '宁夏回族自治区固原市隆德县', '756300', '', 'ldx', 'L', 0);
INSERT INTO `tp_city` VALUES (1019, 1016, 0, 3, 0, '西吉县', '宁夏回族自治区固原市西吉县', '756200', '', 'xjx', 'X', 0);
INSERT INTO `tp_city` VALUES (1020, 1016, 0, 3, 0, '彭阳县', '宁夏回族自治区固原市彭阳县', '756500', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (1021, 1016, 0, 3, 0, '泾源县', '宁夏回族自治区固原市泾源县', '756400', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1022, 1016, 0, 3, 0, '其它区', '宁夏回族自治区固原市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1023, 1003, 0, 2, 0, '银川市', '宁夏回族自治区银川市', '750000', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (1024, 1023, 0, 3, 0, '贺兰县', '宁夏回族自治区银川市贺兰县', '750200', '', 'hlx', 'H', 0);
INSERT INTO `tp_city` VALUES (1025, 1023, 0, 3, 0, '永宁县', '宁夏回族自治区银川市永宁县', '750100', '', 'ynx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1026, 1023, 0, 3, 0, '金凤区', '宁夏回族自治区银川市金凤区', '750011', '', 'jfq', 'J', 0);
INSERT INTO `tp_city` VALUES (1027, 1023, 0, 3, 0, '兴庆区', '宁夏回族自治区银川市兴庆区', '750001', '', 'xqq', 'X', 0);
INSERT INTO `tp_city` VALUES (1028, 1023, 0, 3, 0, '西夏区', '宁夏回族自治区银川市西夏区', '750027', '', 'xxq', 'X', 0);
INSERT INTO `tp_city` VALUES (1029, 1023, 0, 3, 0, '其它区', '宁夏回族自治区银川市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1030, 1023, 0, 3, 0, '灵武市', '宁夏回族自治区银川市灵武市', '751400', '', 'lws', 'L', 0);
INSERT INTO `tp_city` VALUES (1031, 1003, 0, 2, 0, '石嘴山市', '宁夏回族自治区石嘴山市', '', '', 'szss', 'S', 0);
INSERT INTO `tp_city` VALUES (1032, 1031, 0, 3, 0, '平罗县', '宁夏回族自治区石嘴山市平罗县', '753400', '', 'plx', 'P', 0);
INSERT INTO `tp_city` VALUES (1033, 1031, 0, 3, 0, '其它区', '宁夏回族自治区石嘴山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1034, 1031, 0, 3, 0, '大武口区', '宁夏回族自治区石嘴山市大武口区', '753000', '', 'dwkq', 'D', 0);
INSERT INTO `tp_city` VALUES (1035, 1031, 0, 3, 0, '惠农区', '宁夏回族自治区石嘴山市惠农区', '753200', '', 'hnq', 'H', 0);
INSERT INTO `tp_city` VALUES (1036, 0, 0, 1, 0, '澳门特别行政区', '澳门特别行政区', '', '', 'amtbxzq', 'A', 0);
INSERT INTO `tp_city` VALUES (1037, 1036, 0, 2, 0, '离岛', '澳门特别行政区离岛', '', '', 'ld', 'L', 0);
INSERT INTO `tp_city` VALUES (1038, 1037, 0, 3, 0, '圣方济各堂区', '澳门特别行政区离岛离岛', '', '', 'sfjgtq', 'S', 0);
INSERT INTO `tp_city` VALUES (1039, 1037, 0, 3, 0, '嘉模堂区', '澳门特别行政区离岛澳门半岛', '', '', 'jmtq', 'J', 0);
INSERT INTO `tp_city` VALUES (1040, 1036, 0, 2, 0, '澳门半岛', '澳门特别行政区澳门半岛', '', '', 'ambd', 'A', 0);
INSERT INTO `tp_city` VALUES (1041, 0, 0, 1, 0, '浙江省', '浙江省', '', '', 'zjs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1042, 1041, 0, 2, 0, '嘉兴市', '浙江省嘉兴市', '314000', '', 'jxs', 'J', 0);
INSERT INTO `tp_city` VALUES (1043, 1042, 0, 3, 0, '其它区', '浙江省嘉兴市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1044, 1042, 0, 3, 0, '桐乡市', '浙江省嘉兴市桐乡市', '314500', '', 'txs', 'T', 0);
INSERT INTO `tp_city` VALUES (1045, 1042, 0, 3, 0, '平湖市', '浙江省嘉兴市平湖市', '314200', '', 'phs', 'P', 0);
INSERT INTO `tp_city` VALUES (1046, 1042, 0, 3, 0, '海宁市', '浙江省嘉兴市海宁市', '314400', '', 'hns', 'H', 0);
INSERT INTO `tp_city` VALUES (1047, 1042, 0, 3, 0, '秀洲区', '浙江省嘉兴市秀洲区', '314001', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (1048, 1042, 0, 3, 0, '南湖区', '浙江省嘉兴市南湖区', '314000', '', 'nhq', 'N', 0);
INSERT INTO `tp_city` VALUES (1049, 1042, 0, 3, 0, '海盐县', '浙江省嘉兴市海盐县', '314300', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (1050, 1042, 0, 3, 0, '嘉善县', '浙江省嘉兴市嘉善县', '314100', '', 'jsx', 'J', 0);
INSERT INTO `tp_city` VALUES (1051, 1041, 0, 2, 0, '温州市', '浙江省温州市', '325000', '', 'wzs', 'W', 0);
INSERT INTO `tp_city` VALUES (1052, 1051, 0, 3, 0, '瑞安市', '浙江省温州市瑞安市', '325200', '', 'ras', 'R', 0);
INSERT INTO `tp_city` VALUES (1053, 1051, 0, 3, 0, '乐清市', '浙江省温州市乐清市', '325600', '', 'lqs', 'L', 0);
INSERT INTO `tp_city` VALUES (1054, 1051, 0, 3, 0, '其它区', '浙江省温州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1055, 1051, 0, 3, 0, '瓯海区', '浙江省温州市瓯海区', '325005', '', 'hq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1056, 1051, 0, 3, 0, '永嘉县', '浙江省温州市永嘉县', '325100', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1057, 1051, 0, 3, 0, '平阳县', '浙江省温州市平阳县', '325400', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (1058, 1051, 0, 3, 0, '苍南县', '浙江省温州市苍南县', '325800', '', 'cnx', 'C', 0);
INSERT INTO `tp_city` VALUES (1059, 1051, 0, 3, 0, '洞头县', '浙江省温州市洞头县', '325700', '', 'dtx', 'D', 0);
INSERT INTO `tp_city` VALUES (1060, 1051, 0, 3, 0, '文成县', '浙江省温州市文成县', '325300', '', 'wcx', 'W', 0);
INSERT INTO `tp_city` VALUES (1061, 1051, 0, 3, 0, '泰顺县', '浙江省温州市泰顺县', '325500', '', 'tsx', 'T', 0);
INSERT INTO `tp_city` VALUES (1062, 1051, 0, 3, 0, '鹿城区', '浙江省温州市鹿城区', '325000', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (1063, 1051, 0, 3, 0, '龙湾区', '浙江省温州市龙湾区', '325024', '', 'lwq', 'L', 0);
INSERT INTO `tp_city` VALUES (1064, 1041, 0, 2, 0, '金华市', '浙江省金华市', '321000', '', 'jhs', 'J', 0);
INSERT INTO `tp_city` VALUES (1065, 1064, 0, 3, 0, '浦江县', '浙江省金华市浦江县', '322200', '', 'pjx', 'P', 0);
INSERT INTO `tp_city` VALUES (1066, 1064, 0, 3, 0, '磐安县', '浙江省金华市磐安县', '322300', '', 'pax', 'P', 0);
INSERT INTO `tp_city` VALUES (1067, 1064, 0, 3, 0, '武义县', '浙江省金华市武义县', '321200', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (1068, 1064, 0, 3, 0, '婺城区', '浙江省金华市婺城区', '321051', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1069, 1064, 0, 3, 0, '金东区', '浙江省金华市金东区', '321002', '', 'jdq', 'J', 0);
INSERT INTO `tp_city` VALUES (1070, 1064, 0, 3, 0, '兰溪市', '浙江省金华市兰溪市', '321100', '', 'lxs', 'L', 0);
INSERT INTO `tp_city` VALUES (1071, 1064, 0, 3, 0, '义乌市', '浙江省金华市义乌市', '322000', '', 'yws', 'Y', 0);
INSERT INTO `tp_city` VALUES (1072, 1064, 0, 3, 0, '东阳市', '浙江省金华市东阳市', '322100', '', 'dys', 'D', 0);
INSERT INTO `tp_city` VALUES (1073, 1064, 0, 3, 0, '其它区', '浙江省金华市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1074, 1064, 0, 3, 0, '永康市', '浙江省金华市永康市', '321300', '', 'yks', 'Y', 0);
INSERT INTO `tp_city` VALUES (1075, 1041, 0, 2, 0, '绍兴市', '浙江省绍兴市', '312000', '', 'sxs', 'S', 0);
INSERT INTO `tp_city` VALUES (1076, 1075, 0, 3, 0, '诸暨市', '浙江省绍兴市诸暨市', '311800', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1077, 1075, 0, 3, 0, '嵊州市', '浙江省绍兴市嵊州市', '312400', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1078, 1075, 0, 3, 0, '上虞市', '浙江省绍兴市上虞市', '312300', '', 'sys', 'S', 0);
INSERT INTO `tp_city` VALUES (1079, 1075, 0, 3, 0, '其它区', '浙江省绍兴市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1080, 1075, 0, 3, 0, '新昌县', '浙江省绍兴市新昌县', '312500', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (1081, 1075, 0, 3, 0, '绍兴县', '浙江省绍兴市绍兴县', '312000', '', 'sxx', 'S', 0);
INSERT INTO `tp_city` VALUES (1082, 1075, 0, 3, 0, '越城区', '浙江省绍兴市越城区', '312000', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1083, 1041, 0, 2, 0, '湖州市', '浙江省湖州市', '313000', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (1084, 1083, 0, 3, 0, '长兴县', '浙江省湖州市长兴县', '313100', '', 'cxx', 'C', 0);
INSERT INTO `tp_city` VALUES (1085, 1083, 0, 3, 0, '安吉县', '浙江省湖州市安吉县', '313300', '', 'ajx', 'A', 0);
INSERT INTO `tp_city` VALUES (1086, 1083, 0, 3, 0, '德清县', '浙江省湖州市德清县', '313200', '', 'dqx', 'D', 0);
INSERT INTO `tp_city` VALUES (1087, 1083, 0, 3, 0, '其它区', '浙江省湖州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1088, 1083, 0, 3, 0, '南浔区', '浙江省湖州市南浔区', '313009', '', 'nq', 'N', 0);
INSERT INTO `tp_city` VALUES (1089, 1083, 0, 3, 0, '吴兴区', '浙江省湖州市吴兴区', '313000', '', 'wxq', 'W', 0);
INSERT INTO `tp_city` VALUES (1090, 1041, 0, 2, 0, '宁波市', '浙江省宁波市', '315000', '', 'nbs', 'N', 0);
INSERT INTO `tp_city` VALUES (1091, 1090, 0, 3, 0, '奉化市', '浙江省宁波市奉化市', '315500', '', 'fhs', 'F', 0);
INSERT INTO `tp_city` VALUES (1092, 1090, 0, 3, 0, '慈溪市', '浙江省宁波市慈溪市', '315300', '', 'cxs', 'C', 0);
INSERT INTO `tp_city` VALUES (1093, 1090, 0, 3, 0, '余姚市', '浙江省宁波市余姚市', '315400', '', 'yys', 'Y', 0);
INSERT INTO `tp_city` VALUES (1094, 1090, 0, 3, 0, '其它区', '浙江省宁波市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1095, 1090, 0, 3, 0, '海曙区', '浙江省宁波市海曙区', '315000', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (1096, 1090, 0, 3, 0, '北仑区', '浙江省宁波市北仑区', '315800', '', 'blq', 'B', 0);
INSERT INTO `tp_city` VALUES (1097, 1090, 0, 3, 0, '江北区', '浙江省宁波市江北区', '315020', '', 'jbq', 'J', 0);
INSERT INTO `tp_city` VALUES (1098, 1090, 0, 3, 0, '江东区', '浙江省宁波市江东区', '315040', '', 'jdq', 'J', 0);
INSERT INTO `tp_city` VALUES (1099, 1090, 0, 3, 0, '象山县', '浙江省宁波市象山县', '315700', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (1100, 1090, 0, 3, 0, '宁海县', '浙江省宁波市宁海县', '315600', '', 'nhx', 'N', 0);
INSERT INTO `tp_city` VALUES (1101, 1090, 0, 3, 0, '镇海区', '浙江省宁波市镇海区', '315200', '', 'zhq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1102, 1090, 0, 3, 0, '鄞州区', '浙江省宁波市鄞州区', '315100', '', 'zq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1103, 1041, 0, 2, 0, '杭州市', '浙江省杭州市', '310000', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (1104, 1103, 0, 3, 0, '其它区', '浙江省杭州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1105, 1103, 0, 3, 0, '临安市', '浙江省杭州市临安市', '311300', '', 'las', 'L', 0);
INSERT INTO `tp_city` VALUES (1106, 1103, 0, 3, 0, '建德市', '浙江省杭州市建德市', '311600', '', 'jds', 'J', 0);
INSERT INTO `tp_city` VALUES (1107, 1103, 0, 3, 0, '富阳市', '浙江省杭州市富阳市', '311400', '', 'fys', 'F', 0);
INSERT INTO `tp_city` VALUES (1108, 1103, 0, 3, 0, '淳安县', '浙江省杭州市淳安县', '311700', '', 'cax', 'C', 0);
INSERT INTO `tp_city` VALUES (1109, 1103, 0, 3, 0, '桐庐县', '浙江省杭州市桐庐县', '311500', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (1110, 1103, 0, 3, 0, '上城区', '浙江省杭州市上城区', '311500', '', 'scq', 'S', 0);
INSERT INTO `tp_city` VALUES (1111, 1103, 0, 3, 0, '下城区', '浙江省杭州市下城区', '310006', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (1112, 1103, 0, 3, 0, '江干区', '浙江省杭州市江干区', '310002', '', 'jgq', 'J', 0);
INSERT INTO `tp_city` VALUES (1113, 1103, 0, 3, 0, '拱墅区', '浙江省杭州市拱墅区', '310011', '', 'gsq', 'G', 0);
INSERT INTO `tp_city` VALUES (1114, 1103, 0, 3, 0, '西湖区', '浙江省杭州市西湖区', '310013', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (1115, 1103, 0, 3, 0, '滨江区', '浙江省杭州市滨江区', '310051', '', 'bjq', 'B', 0);
INSERT INTO `tp_city` VALUES (1116, 1103, 0, 3, 0, '萧山区', '浙江省杭州市萧山区', '311200', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (1117, 1103, 0, 3, 0, '余杭区', '浙江省杭州市余杭区', '311100', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1118, 1041, 0, 2, 0, '舟山市', '浙江省舟山市', '316000', '', 'zss', 'Z', 0);
INSERT INTO `tp_city` VALUES (1119, 1118, 0, 3, 0, '普陀区', '浙江省舟山市普陀区', '316100', '', 'ptq', 'P', 0);
INSERT INTO `tp_city` VALUES (1120, 1118, 0, 3, 0, '定海区', '浙江省舟山市定海区', '316000', '', 'dhq', 'D', 0);
INSERT INTO `tp_city` VALUES (1121, 1118, 0, 3, 0, '嵊泗县', '浙江省舟山市嵊泗县', '202400', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (1122, 1118, 0, 3, 0, '其它区', '浙江省舟山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1123, 1118, 0, 3, 0, '岱山县', '浙江省舟山市岱山县', '316200', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1124, 1041, 0, 2, 0, '台州市', '浙江省台州市', '318000', '', 'tzs', 'T', 0);
INSERT INTO `tp_city` VALUES (1125, 1124, 0, 3, 0, '黄岩区', '浙江省台州市黄岩区', '318020', '', 'hyq', 'H', 0);
INSERT INTO `tp_city` VALUES (1126, 1124, 0, 3, 0, '椒江区', '浙江省台州市椒江区', '318000', '', 'jjq', 'J', 0);
INSERT INTO `tp_city` VALUES (1127, 1124, 0, 3, 0, '路桥区', '浙江省台州市路桥区', '318050', '', 'lqq', 'L', 0);
INSERT INTO `tp_city` VALUES (1128, 1124, 0, 3, 0, '仙居县', '浙江省台州市仙居县', '317300', '', 'xjx', 'X', 0);
INSERT INTO `tp_city` VALUES (1129, 1124, 0, 3, 0, '天台县', '浙江省台州市天台县', '317200', '', 'ttx', 'T', 0);
INSERT INTO `tp_city` VALUES (1130, 1124, 0, 3, 0, '三门县', '浙江省台州市三门县', '317100', '', 'smx', 'S', 0);
INSERT INTO `tp_city` VALUES (1131, 1124, 0, 3, 0, '玉环县', '浙江省台州市玉环县', '317600', '', 'yhx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1132, 1124, 0, 3, 0, '其它区', '浙江省台州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1133, 1124, 0, 3, 0, '临海市', '浙江省台州市临海市', '317000', '', 'lhs', 'L', 0);
INSERT INTO `tp_city` VALUES (1134, 1124, 0, 3, 0, '温岭市', '浙江省台州市温岭市', '317500', '', 'wls', 'W', 0);
INSERT INTO `tp_city` VALUES (1135, 1041, 0, 2, 0, '衢州市', '浙江省衢州市', '324000', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1136, 1135, 0, 3, 0, '江山市', '浙江省衢州市江山市', '324100', '', 'jss', 'J', 0);
INSERT INTO `tp_city` VALUES (1137, 1135, 0, 3, 0, '其它区', '浙江省衢州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1138, 1135, 0, 3, 0, '柯城区', '浙江省衢州市柯城区', '324000', '', 'kcq', 'K', 0);
INSERT INTO `tp_city` VALUES (1139, 1135, 0, 3, 0, '衢江区', '浙江省衢州市衢江区', '324000', '', 'jq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1140, 1135, 0, 3, 0, '龙游县', '浙江省衢州市龙游县', '324400', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (1141, 1135, 0, 3, 0, '开化县', '浙江省衢州市开化县', '324300', '', 'khx', 'K', 0);
INSERT INTO `tp_city` VALUES (1142, 1135, 0, 3, 0, '常山县', '浙江省衢州市常山县', '324200', '', 'csx', 'C', 0);
INSERT INTO `tp_city` VALUES (1143, 1041, 0, 2, 0, '丽水市', '浙江省丽水市', '323000', '', 'lss', 'L', 0);
INSERT INTO `tp_city` VALUES (1144, 1143, 0, 3, 0, '龙泉市', '浙江省丽水市龙泉市', '323700', '', 'lqs', 'L', 0);
INSERT INTO `tp_city` VALUES (1145, 1143, 0, 3, 0, '其它区', '浙江省丽水市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1146, 1143, 0, 3, 0, '莲都区', '浙江省丽水市莲都区', '323000', '', 'ldq', 'L', 0);
INSERT INTO `tp_city` VALUES (1147, 1143, 0, 3, 0, '青田县', '浙江省丽水市青田县', '323900', '', 'qtx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1148, 1143, 0, 3, 0, '缙云县', '浙江省丽水市缙云县', '321400', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1149, 1143, 0, 3, 0, '遂昌县', '浙江省丽水市遂昌县', '323300', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (1150, 1143, 0, 3, 0, '松阳县', '浙江省丽水市松阳县', '323400', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (1151, 1143, 0, 3, 0, '云和县', '浙江省丽水市云和县', '323600', '', 'yhx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1152, 1143, 0, 3, 0, '庆元县', '浙江省丽水市庆元县', '323800', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1153, 1143, 0, 3, 0, '景宁畲族自治县', '浙江省丽水市景宁畲族自治县', '323500', '', 'jnzzzx', 'J', 0);
INSERT INTO `tp_city` VALUES (1154, 0, 0, 1, 0, '新疆维吾尔自治区', '新疆维吾尔自治区', '', '', 'xjwwezzq', 'X', 0);
INSERT INTO `tp_city` VALUES (1155, 1154, 0, 2, 0, '克拉玛依市', '新疆维吾尔自治区克拉玛依市', '834000', '', 'klmys', 'K', 0);
INSERT INTO `tp_city` VALUES (1156, 1155, 0, 3, 0, '白碱滩区', '新疆维吾尔自治区克拉玛依市白碱滩区', '834009', '', 'bjtq', 'B', 0);
INSERT INTO `tp_city` VALUES (1157, 1155, 0, 3, 0, '乌尔禾区', '新疆维吾尔自治区克拉玛依市乌尔禾区', '834014', '', 'wehq', 'W', 0);
INSERT INTO `tp_city` VALUES (1158, 1155, 0, 3, 0, '其它区', '新疆维吾尔自治区克拉玛依市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1159, 1155, 0, 3, 0, '独山子区', '新疆维吾尔自治区克拉玛依市独山子区', '838600', '', 'dszq', 'D', 0);
INSERT INTO `tp_city` VALUES (1160, 1155, 0, 3, 0, '克拉玛依区', '新疆维吾尔自治区克拉玛依市克拉玛依区', '834000', '', 'klmyq', 'K', 0);
INSERT INTO `tp_city` VALUES (1161, 1154, 0, 2, 0, '乌鲁木齐市', '新疆维吾尔自治区乌鲁木齐市', '830000', '', 'wlmqs', 'W', 0);
INSERT INTO `tp_city` VALUES (1162, 1161, 0, 3, 0, '乌鲁木齐县', '新疆维吾尔自治区乌鲁木齐市乌鲁木齐县', '830063', '', 'wlmqx', 'W', 0);
INSERT INTO `tp_city` VALUES (1163, 1161, 0, 3, 0, '其它区', '新疆维吾尔自治区乌鲁木齐市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1164, 1161, 0, 3, 0, '沙依巴克区', '新疆维吾尔自治区乌鲁木齐市沙依巴克区', '830000', '', 'sybkq', 'S', 0);
INSERT INTO `tp_city` VALUES (1165, 1161, 0, 3, 0, '天山区', '新疆维吾尔自治区乌鲁木齐市天山区', '830002', '', 'tsq', 'T', 0);
INSERT INTO `tp_city` VALUES (1166, 1161, 0, 3, 0, '米东区', '新疆维吾尔自治区乌鲁木齐市米东区', '831400', '', 'mdq', 'M', 0);
INSERT INTO `tp_city` VALUES (1167, 1161, 0, 3, 0, '东山区', '新疆维吾尔自治区乌鲁木齐市东山区', '830019', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (1168, 1161, 0, 3, 0, '达坂城区', '新疆维吾尔自治区乌鲁木齐市达坂城区', '830039', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (1169, 1161, 0, 3, 0, '头屯河区', '新疆维吾尔自治区乌鲁木齐市头屯河区', '830023', '', 'tthq', 'T', 0);
INSERT INTO `tp_city` VALUES (1170, 1161, 0, 3, 0, '水磨沟区', '新疆维吾尔自治区乌鲁木齐市水磨沟区', '830017', '', 'smgq', 'S', 0);
INSERT INTO `tp_city` VALUES (1171, 1161, 0, 3, 0, '新市区', '新疆维吾尔自治区乌鲁木齐市新市区', '830011', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (1172, 1154, 0, 2, 0, '伊犁哈萨克自治州', '新疆维吾尔自治区伊犁哈萨克自治州', '835000', '', 'ylhskzzz', 'Y', 0);
INSERT INTO `tp_city` VALUES (1173, 1172, 0, 3, 0, '尼勒克县', '新疆维吾尔自治区伊犁哈萨克自治州尼勒克县', '835700', '', 'nlkx', 'N', 0);
INSERT INTO `tp_city` VALUES (1174, 1172, 0, 3, 0, '其它区', '新疆维吾尔自治区伊犁哈萨克自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1175, 1172, 0, 3, 0, '昭苏县', '新疆维吾尔自治区伊犁哈萨克自治州昭苏县', '835600', '', 'zsx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1176, 1172, 0, 3, 0, '特克斯县', '新疆维吾尔自治区伊犁哈萨克自治州特克斯县', '835500', '', 'tksx', 'T', 0);
INSERT INTO `tp_city` VALUES (1177, 1172, 0, 3, 0, '巩留县', '新疆维吾尔自治区伊犁哈萨克自治州巩留县', '835400', '', 'glx', 'G', 0);
INSERT INTO `tp_city` VALUES (1178, 1172, 0, 3, 0, '新源县', '新疆维吾尔自治区伊犁哈萨克自治州新源县', '835800', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (1179, 1172, 0, 3, 0, '察布查尔锡伯自治县', '新疆维吾尔自治区伊犁哈萨克自治州察布查尔锡伯自治县', '835300', '', 'cbcexbzzx', 'C', 0);
INSERT INTO `tp_city` VALUES (1180, 1172, 0, 3, 0, '霍城县', '新疆维吾尔自治区伊犁哈萨克自治州霍城县', '835200', '', 'hcx', 'H', 0);
INSERT INTO `tp_city` VALUES (1181, 1172, 0, 3, 0, '伊宁县', '新疆维吾尔自治区伊犁哈萨克自治州伊宁县', '835100', '', 'ynx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1182, 1172, 0, 3, 0, '奎屯市', '新疆维吾尔自治区伊犁哈萨克自治州奎屯市', '833200', '', 'kts', 'K', 0);
INSERT INTO `tp_city` VALUES (1183, 1172, 0, 3, 0, '伊宁市', '新疆维吾尔自治区伊犁哈萨克自治州伊宁市', '835000', '', 'yns', 'Y', 0);
INSERT INTO `tp_city` VALUES (1184, 1154, 0, 2, 0, '阿勒泰地区', '新疆维吾尔自治区阿勒泰地区', '836500', '', 'altdq', 'A', 0);
INSERT INTO `tp_city` VALUES (1185, 1184, 0, 3, 0, '阿勒泰市', '新疆维吾尔自治区阿勒泰地区阿勒泰市', '836500', '', 'alts', 'A', 0);
INSERT INTO `tp_city` VALUES (1186, 1184, 0, 3, 0, '其它区', '新疆维吾尔自治区阿勒泰地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1187, 1184, 0, 3, 0, '吉木乃县', '新疆维吾尔自治区阿勒泰地区吉木乃县', '836800', '', 'jmnx', 'J', 0);
INSERT INTO `tp_city` VALUES (1188, 1184, 0, 3, 0, '青河县', '新疆维吾尔自治区阿勒泰地区青河县', '836200', '', 'qhx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1189, 1184, 0, 3, 0, '哈巴河县', '新疆维吾尔自治区阿勒泰地区哈巴河县', '836700', '', 'hbhx', 'H', 0);
INSERT INTO `tp_city` VALUES (1190, 1184, 0, 3, 0, '福海县', '新疆维吾尔自治区阿勒泰地区福海县', '836400', '', 'fhx', 'F', 0);
INSERT INTO `tp_city` VALUES (1191, 1184, 0, 3, 0, '富蕴县', '新疆维吾尔自治区阿勒泰地区富蕴县', '836100', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (1192, 1184, 0, 3, 0, '布尔津县', '新疆维吾尔自治区阿勒泰地区布尔津县', '836600', '', 'bejx', 'B', 0);
INSERT INTO `tp_city` VALUES (1193, 1154, 0, 2, 0, '塔城地区', '新疆维吾尔自治区塔城地区', '834700', '', 'tcdq', 'T', 0);
INSERT INTO `tp_city` VALUES (1194, 1193, 0, 3, 0, '裕民县', '新疆维吾尔自治区塔城地区裕民县', '834800', '', 'ymx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1195, 1193, 0, 3, 0, '托里县', '新疆维吾尔自治区塔城地区托里县', '834500', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (1196, 1193, 0, 3, 0, '其它区', '新疆维吾尔自治区塔城地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1197, 1193, 0, 3, 0, '和布克赛尔蒙古自治县', '新疆维吾尔自治区塔城地区和布克赛尔蒙古自治县', '834400', '', 'hbksemgzzx', 'H', 0);
INSERT INTO `tp_city` VALUES (1198, 1193, 0, 3, 0, '额敏县', '新疆维吾尔自治区塔城地区额敏县', '834600', '', 'emx', 'E', 0);
INSERT INTO `tp_city` VALUES (1199, 1193, 0, 3, 0, '沙湾县', '新疆维吾尔自治区塔城地区沙湾县', '832100', '', 'swx', 'S', 0);
INSERT INTO `tp_city` VALUES (1200, 1193, 0, 3, 0, '乌苏市', '新疆维吾尔自治区塔城地区乌苏市', '833000', '', 'wss', 'W', 0);
INSERT INTO `tp_city` VALUES (1201, 1193, 0, 3, 0, '塔城市', '新疆维吾尔自治区塔城地区塔城市', '834700', '', 'tcs', 'T', 0);
INSERT INTO `tp_city` VALUES (1202, 1154, 0, 2, 0, '昌吉回族自治州', '新疆维吾尔自治区昌吉回族自治州', '831100', '', 'cjhzzzz', 'C', 0);
INSERT INTO `tp_city` VALUES (1203, 1202, 0, 3, 0, '其它区', '新疆维吾尔自治区昌吉回族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1204, 1202, 0, 3, 0, '木垒哈萨克自治县', '新疆维吾尔自治区昌吉回族自治州木垒哈萨克自治县', '831900', '', 'mlhskzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (1205, 1202, 0, 3, 0, '奇台县', '新疆维吾尔自治区昌吉回族自治州奇台县', '831800', '', 'qtx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1206, 1202, 0, 3, 0, '玛纳斯县', '新疆维吾尔自治区昌吉回族自治州玛纳斯县', '832200', '', 'mnsx', 'M', 0);
INSERT INTO `tp_city` VALUES (1207, 1202, 0, 3, 0, '吉木萨尔县', '新疆维吾尔自治区昌吉回族自治州吉木萨尔县', '831700', '', 'jmsex', 'J', 0);
INSERT INTO `tp_city` VALUES (1208, 1202, 0, 3, 0, '呼图壁县', '新疆维吾尔自治区昌吉回族自治州呼图壁县', '831200', '', 'htbx', 'H', 0);
INSERT INTO `tp_city` VALUES (1209, 1202, 0, 3, 0, '米泉市', '新疆维吾尔自治区昌吉回族自治州米泉市', '831400', '', 'mqs', 'M', 0);
INSERT INTO `tp_city` VALUES (1210, 1202, 0, 3, 0, '阜康市', '新疆维吾尔自治区昌吉回族自治州阜康市', '831500', '', 'fks', 'F', 0);
INSERT INTO `tp_city` VALUES (1211, 1202, 0, 3, 0, '昌吉市', '新疆维吾尔自治区昌吉回族自治州昌吉市', '831100', '', 'cjs', 'C', 0);
INSERT INTO `tp_city` VALUES (1212, 1154, 0, 2, 0, '博尔塔拉蒙古自治州', '新疆维吾尔自治区博尔塔拉蒙古自治州', '833400', '', 'betlmgzzz', 'B', 0);
INSERT INTO `tp_city` VALUES (1213, 1212, 0, 3, 0, '其它区', '新疆维吾尔自治区博尔塔拉蒙古自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1214, 1212, 0, 3, 0, '温泉县', '新疆维吾尔自治区博尔塔拉蒙古自治州温泉县', '833500', '', 'wqx', 'W', 0);
INSERT INTO `tp_city` VALUES (1215, 1212, 0, 3, 0, '精河县', '新疆维吾尔自治区博尔塔拉蒙古自治州精河县', '833300', '', 'jhx', 'J', 0);
INSERT INTO `tp_city` VALUES (1216, 1212, 0, 3, 0, '博乐市', '新疆维吾尔自治区博尔塔拉蒙古自治州博乐市', '833400', '', 'bls', 'B', 0);
INSERT INTO `tp_city` VALUES (1217, 1212, 0, 3, 0, '阿拉山口市', '新疆维吾尔自治区博尔塔拉蒙古自治州阿拉山口市', '', '', 'alsks', 'A', 0);
INSERT INTO `tp_city` VALUES (1218, 1154, 0, 2, 0, '巴音郭楞蒙古自治州', '新疆维吾尔自治区巴音郭楞蒙古自治州', '841000', '', 'byglmgzzz', 'B', 0);
INSERT INTO `tp_city` VALUES (1219, 1218, 0, 3, 0, '焉耆回族自治县', '新疆维吾尔自治区巴音郭楞蒙古自治州焉耆回族自治县', '841100', '', 'yhzzzx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1220, 1218, 0, 3, 0, '和静县', '新疆维吾尔自治区巴音郭楞蒙古自治州和静县', '841300', '', 'hjx', 'H', 0);
INSERT INTO `tp_city` VALUES (1221, 1218, 0, 3, 0, '若羌县', '新疆维吾尔自治区巴音郭楞蒙古自治州若羌县', '841800', '', 'rqx', 'R', 0);
INSERT INTO `tp_city` VALUES (1222, 1218, 0, 3, 0, '且末县', '新疆维吾尔自治区巴音郭楞蒙古自治州且末县', '841900', '', 'qmx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1223, 1218, 0, 3, 0, '其它区', '新疆维吾尔自治区巴音郭楞蒙古自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1224, 1218, 0, 3, 0, '和硕县', '新疆维吾尔自治区巴音郭楞蒙古自治州和硕县', '841200', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (1225, 1218, 0, 3, 0, '博湖县', '新疆维吾尔自治区巴音郭楞蒙古自治州博湖县', '841400', '', 'bhx', 'B', 0);
INSERT INTO `tp_city` VALUES (1226, 1218, 0, 3, 0, '轮台县', '新疆维吾尔自治区巴音郭楞蒙古自治州轮台县', '841600', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (1227, 1218, 0, 3, 0, '尉犁县', '新疆维吾尔自治区巴音郭楞蒙古自治州尉犁县', '841500', '', 'wlx', 'W', 0);
INSERT INTO `tp_city` VALUES (1228, 1218, 0, 3, 0, '库尔勒市', '新疆维吾尔自治区巴音郭楞蒙古自治州库尔勒市', '841000', '', 'kels', 'K', 0);
INSERT INTO `tp_city` VALUES (1229, 1154, 0, 2, 0, '阿克苏地区', '新疆维吾尔自治区阿克苏地区', '843000', '', 'aksdq', 'A', 0);
INSERT INTO `tp_city` VALUES (1230, 1229, 0, 3, 0, '沙雅县', '新疆维吾尔自治区阿克苏地区沙雅县', '842200', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (1231, 1229, 0, 3, 0, '新和县', '新疆维吾尔自治区阿克苏地区新和县', '842100', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (1232, 1229, 0, 3, 0, '拜城县', '新疆维吾尔自治区阿克苏地区拜城县', '842300', '', 'bcx', 'B', 0);
INSERT INTO `tp_city` VALUES (1233, 1229, 0, 3, 0, '乌什县', '新疆维吾尔自治区阿克苏地区乌什县', '843400', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (1234, 1229, 0, 3, 0, '温宿县', '新疆维吾尔自治区阿克苏地区温宿县', '843100', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (1235, 1229, 0, 3, 0, '库车县', '新疆维吾尔自治区阿克苏地区库车县', '842000', '', 'kcx', 'K', 0);
INSERT INTO `tp_city` VALUES (1236, 1229, 0, 3, 0, '阿克苏市', '新疆维吾尔自治区阿克苏地区阿克苏市', '843000', '', 'akss', 'A', 0);
INSERT INTO `tp_city` VALUES (1237, 1229, 0, 3, 0, '其它区', '新疆维吾尔自治区阿克苏地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1238, 1229, 0, 3, 0, '阿瓦提县', '新疆维吾尔自治区阿克苏地区阿瓦提县', '843200', '', 'awtx', 'A', 0);
INSERT INTO `tp_city` VALUES (1239, 1229, 0, 3, 0, '柯坪县', '新疆维吾尔自治区阿克苏地区柯坪县', '843600', '', 'kpx', 'K', 0);
INSERT INTO `tp_city` VALUES (1240, 1154, 0, 2, 0, '克孜勒苏柯尔克孜自治州', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州', '845350', '', 'kzlskekzzz', 'K', 0);
INSERT INTO `tp_city` VALUES (1241, 1240, 0, 3, 0, '阿合奇县', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州阿合奇县', '843500', '', 'ahqx', 'A', 0);
INSERT INTO `tp_city` VALUES (1242, 1240, 0, 3, 0, '阿克陶县', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州阿克陶县', '845550', '', 'aktx', 'A', 0);
INSERT INTO `tp_city` VALUES (1243, 1240, 0, 3, 0, '阿图什市', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州阿图什市', '845350', '', 'atss', 'A', 0);
INSERT INTO `tp_city` VALUES (1244, 1240, 0, 3, 0, '乌恰县', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州乌恰县', '845450', '', 'wqx', 'W', 0);
INSERT INTO `tp_city` VALUES (1245, 1240, 0, 3, 0, '其它区', '新疆维吾尔自治区克孜勒苏柯尔克孜自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1246, 1154, 0, 2, 0, '喀什地区', '新疆维吾尔自治区喀什地区', '844000', '', 'ksdq', 'K', 0);
INSERT INTO `tp_city` VALUES (1247, 1246, 0, 3, 0, '喀什市', '新疆维吾尔自治区喀什地区喀什市', '844000', '', 'kss', 'K', 0);
INSERT INTO `tp_city` VALUES (1248, 1246, 0, 3, 0, '其它区', '新疆维吾尔自治区喀什地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1249, 1246, 0, 3, 0, '伽师县', '新疆维吾尔自治区喀什地区伽师县', '844300', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1250, 1246, 0, 3, 0, '岳普湖县', '新疆维吾尔自治区喀什地区岳普湖县', '844400', '', 'yphx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1251, 1246, 0, 3, 0, '塔什库尔干塔吉克自治县', '新疆维吾尔自治区喀什地区塔什库尔干塔吉克自治县', '845250', '', 'tskegtjkzz', 'T', 0);
INSERT INTO `tp_city` VALUES (1252, 1246, 0, 3, 0, '巴楚县', '新疆维吾尔自治区喀什地区巴楚县', '843800', '', 'bcx', 'B', 0);
INSERT INTO `tp_city` VALUES (1253, 1246, 0, 3, 0, '莎车县', '新疆维吾尔自治区喀什地区莎车县', '844700', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (1254, 1246, 0, 3, 0, '泽普县', '新疆维吾尔自治区喀什地区泽普县', '844800', '', 'zpx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1255, 1246, 0, 3, 0, '麦盖提县', '新疆维吾尔自治区喀什地区麦盖提县', '844600', '', 'mgtx', 'M', 0);
INSERT INTO `tp_city` VALUES (1256, 1246, 0, 3, 0, '叶城县', '新疆维吾尔自治区喀什地区叶城县', '844900', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1257, 1246, 0, 3, 0, '疏附县', '新疆维吾尔自治区喀什地区疏附县', '844100', '', 'sfx', 'S', 0);
INSERT INTO `tp_city` VALUES (1258, 1246, 0, 3, 0, '英吉沙县', '新疆维吾尔自治区喀什地区英吉沙县', '844500', '', 'yjsx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1259, 1246, 0, 3, 0, '疏勒县', '新疆维吾尔自治区喀什地区疏勒县', '844200', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (1260, 1154, 0, 2, 0, '和田地区', '新疆维吾尔自治区和田地区', '848000', '', 'htdq', 'H', 0);
INSERT INTO `tp_city` VALUES (1261, 1260, 0, 3, 0, '和田市', '新疆维吾尔自治区和田地区和田市', '848000', '', 'hts', 'H', 0);
INSERT INTO `tp_city` VALUES (1262, 1260, 0, 3, 0, '墨玉县', '新疆维吾尔自治区和田地区墨玉县', '848100', '', 'myx', 'M', 0);
INSERT INTO `tp_city` VALUES (1263, 1260, 0, 3, 0, '皮山县', '新疆维吾尔自治区和田地区皮山县', '845150', '', 'psx', 'P', 0);
INSERT INTO `tp_city` VALUES (1264, 1260, 0, 3, 0, '和田县', '新疆维吾尔自治区和田地区和田县', '848000', '', 'htx', 'H', 0);
INSERT INTO `tp_city` VALUES (1265, 1260, 0, 3, 0, '于田县', '新疆维吾尔自治区和田地区于田县', '848400', '', 'ytx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1266, 1260, 0, 3, 0, '民丰县', '新疆维吾尔自治区和田地区民丰县', '848500', '', 'mfx', 'M', 0);
INSERT INTO `tp_city` VALUES (1267, 1260, 0, 3, 0, '洛浦县', '新疆维吾尔自治区和田地区洛浦县', '848200', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (1268, 1260, 0, 3, 0, '策勒县', '新疆维吾尔自治区和田地区策勒县', '848300', '', 'clx', 'C', 0);
INSERT INTO `tp_city` VALUES (1269, 1260, 0, 3, 0, '其它区', '新疆维吾尔自治区和田地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1270, 1154, 0, 2, 0, '吐鲁番地区', '新疆维吾尔自治区吐鲁番地区', '838000', '', 'tlfdq', 'T', 0);
INSERT INTO `tp_city` VALUES (1271, 1270, 0, 3, 0, '吐鲁番市', '新疆维吾尔自治区吐鲁番地区吐鲁番市', '838000', '', 'tlfs', 'T', 0);
INSERT INTO `tp_city` VALUES (1272, 1270, 0, 3, 0, '其它区', '新疆维吾尔自治区吐鲁番地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1273, 1270, 0, 3, 0, '鄯善县', '新疆维吾尔自治区吐鲁番地区鄯善县', '838200', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1274, 1270, 0, 3, 0, '托克逊县', '新疆维吾尔自治区吐鲁番地区托克逊县', '838100', '', 'tkxx', 'T', 0);
INSERT INTO `tp_city` VALUES (1275, 1154, 0, 2, 0, '哈密地区', '新疆维吾尔自治区哈密地区', '839000', '', 'hmdq', 'H', 0);
INSERT INTO `tp_city` VALUES (1276, 1275, 0, 3, 0, '其它区', '新疆维吾尔自治区哈密地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1277, 1275, 0, 3, 0, '哈密市', '新疆维吾尔自治区哈密地区哈密市', '839000', '', 'hms', 'H', 0);
INSERT INTO `tp_city` VALUES (1278, 1275, 0, 3, 0, '伊吾县', '新疆维吾尔自治区哈密地区伊吾县', '839300', '', 'ywx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1279, 1275, 0, 3, 0, '巴里坤哈萨克自治县', '新疆维吾尔自治区哈密地区巴里坤哈萨克自治县', '839200', '', 'blkhskzzx', 'B', 0);
INSERT INTO `tp_city` VALUES (1280, 1154, 0, 2, 0, '五家渠市', '新疆维吾尔自治区五家渠市', '831300', '', 'wjqs', 'W', 0);
INSERT INTO `tp_city` VALUES (1281, 1280, 0, 3, 0, '军垦路街道办事处', '新疆维吾尔自治区五家渠市军垦路街道办事处', '', '', 'jkljdbsc', 'J', 0);
INSERT INTO `tp_city` VALUES (1282, 1280, 0, 3, 0, '青湖路街道办事处', '新疆维吾尔自治区五家渠市青湖路街道办事处', '', '', 'qhljdbsc', 'Q', 0);
INSERT INTO `tp_city` VALUES (1283, 1280, 0, 3, 0, '人民路街道办事处', '新疆维吾尔自治区五家渠市人民路街道办事处', '', '', 'rmljdbsc', 'R', 0);
INSERT INTO `tp_city` VALUES (1284, 1280, 0, 3, 0, '兵团一零一团', '新疆维吾尔自治区五家渠市兵团一零一团', '', '', 'btylyt', 'B', 0);
INSERT INTO `tp_city` VALUES (1285, 1280, 0, 3, 0, '兵团一零二团', '新疆维吾尔自治区五家渠市兵团一零二团', '', '', 'btylet', 'B', 0);
INSERT INTO `tp_city` VALUES (1286, 1280, 0, 3, 0, '兵团一零三团', '新疆维吾尔自治区五家渠市兵团一零三团', '', '', 'btylst', 'B', 0);
INSERT INTO `tp_city` VALUES (1287, 1154, 0, 2, 0, '石河子市', '新疆维吾尔自治区石河子市', '832000', '', 'shzs', 'S', 0);
INSERT INTO `tp_city` VALUES (1288, 1287, 0, 3, 0, '新城街道办事处', '新疆维吾尔自治区石河子市新城街道办事处', '', '', 'xcjdbsc', 'X', 0);
INSERT INTO `tp_city` VALUES (1289, 1287, 0, 3, 0, '向阳街道办事处', '新疆维吾尔自治区石河子市向阳街道办事处', '', '', 'xyjdbsc', 'X', 0);
INSERT INTO `tp_city` VALUES (1290, 1287, 0, 3, 0, '红山街道办事处', '新疆维吾尔自治区石河子市红山街道办事处', '', '', 'hsjdbsc', 'H', 0);
INSERT INTO `tp_city` VALUES (1291, 1287, 0, 3, 0, '老街街道办事处', '新疆维吾尔自治区石河子市老街街道办事处', '', '', 'ljjdbsc', 'L', 0);
INSERT INTO `tp_city` VALUES (1292, 1287, 0, 3, 0, '东城街道办事处', '新疆维吾尔自治区石河子市东城街道办事处', '', '', 'dcjdbsc', 'D', 0);
INSERT INTO `tp_city` VALUES (1293, 1287, 0, 3, 0, '北泉镇', '新疆维吾尔自治区石河子市北泉镇', '', '', 'bqz', 'B', 0);
INSERT INTO `tp_city` VALUES (1294, 1287, 0, 3, 0, '石河子乡', '新疆维吾尔自治区石河子市石河子乡', '', '', 'shzx', 'S', 0);
INSERT INTO `tp_city` VALUES (1295, 1287, 0, 3, 0, '兵团一五二团', '新疆维吾尔自治区石河子市兵团一五二团', '', '', 'btywet', 'B', 0);
INSERT INTO `tp_city` VALUES (1296, 1154, 0, 2, 0, '阿拉尔市', '新疆维吾尔自治区阿拉尔市', '843300', '', 'ales', 'A', 0);
INSERT INTO `tp_city` VALUES (1297, 1296, 0, 3, 0, '金银川路街道办事处', '新疆维吾尔自治区阿拉尔市金银川路街道办事处', '', '', 'jycljdbsc', 'J', 0);
INSERT INTO `tp_city` VALUES (1298, 1296, 0, 3, 0, '幸福路街道办事处', '新疆维吾尔自治区阿拉尔市幸福路街道办事处', '', '', 'xfljdbsc', 'X', 0);
INSERT INTO `tp_city` VALUES (1299, 1296, 0, 3, 0, '青松路街道办事处', '新疆维吾尔自治区阿拉尔市青松路街道办事处', '', '', 'qsljdbsc', 'Q', 0);
INSERT INTO `tp_city` VALUES (1300, 1296, 0, 3, 0, '南口街道办事处', '新疆维吾尔自治区阿拉尔市南口街道办事处', '', '', 'nkjdbsc', 'N', 0);
INSERT INTO `tp_city` VALUES (1301, 1296, 0, 3, 0, '托喀依乡', '新疆维吾尔自治区阿拉尔市托喀依乡', '', '', 'tkyx', 'T', 0);
INSERT INTO `tp_city` VALUES (1302, 1296, 0, 3, 0, '工业园区', '新疆维吾尔自治区阿拉尔市工业园区', '', '', 'gyyq', 'G', 0);
INSERT INTO `tp_city` VALUES (1303, 1296, 0, 3, 0, '兵团七团', '新疆维吾尔自治区阿拉尔市兵团七团', '', '', 'btqt', 'B', 0);
INSERT INTO `tp_city` VALUES (1304, 1296, 0, 3, 0, '兵团八团', '新疆维吾尔自治区阿拉尔市兵团八团', '', '', 'btbt', 'B', 0);
INSERT INTO `tp_city` VALUES (1305, 1296, 0, 3, 0, '兵团十团', '新疆维吾尔自治区阿拉尔市兵团十团', '', '', 'btst', 'B', 0);
INSERT INTO `tp_city` VALUES (1306, 1296, 0, 3, 0, '兵团十一团', '新疆维吾尔自治区阿拉尔市兵团十一团', '', '', 'btsyt', 'B', 0);
INSERT INTO `tp_city` VALUES (1307, 1296, 0, 3, 0, '兵团十二团', '新疆维吾尔自治区阿拉尔市兵团十二团', '', '', 'btset', 'B', 0);
INSERT INTO `tp_city` VALUES (1308, 1296, 0, 3, 0, '兵团十三团', '新疆维吾尔自治区阿拉尔市兵团十三团', '', '', 'btsst', 'B', 0);
INSERT INTO `tp_city` VALUES (1309, 1296, 0, 3, 0, '兵团十四团', '新疆维吾尔自治区阿拉尔市兵团十四团', '', '', 'btsst', 'B', 0);
INSERT INTO `tp_city` VALUES (1310, 1296, 0, 3, 0, '兵团十六团', '新疆维吾尔自治区阿拉尔市兵团十六团', '', '', 'btslt', 'B', 0);
INSERT INTO `tp_city` VALUES (1311, 1296, 0, 3, 0, '兵团第一师水利水电工程处', '新疆维吾尔自治区阿拉尔市兵团第一师水利水电工程处', '', '', 'btdysslsdg', 'B', 0);
INSERT INTO `tp_city` VALUES (1312, 1296, 0, 3, 0, '兵团第一师塔里木灌区水利管理处', '新疆维吾尔自治区阿拉尔市兵团第一师塔里木灌区水利管理处', '', '', 'btdystlmgq', 'B', 0);
INSERT INTO `tp_city` VALUES (1313, 1296, 0, 3, 0, '阿拉尔农场', '新疆维吾尔自治区阿拉尔市阿拉尔农场', '', '', 'alenc', 'A', 0);
INSERT INTO `tp_city` VALUES (1314, 1296, 0, 3, 0, '兵团第一师幸福农场', '新疆维吾尔自治区阿拉尔市兵团第一师幸福农场', '', '', 'btdysxfnc', 'B', 0);
INSERT INTO `tp_city` VALUES (1315, 1296, 0, 3, 0, '中心监狱', '新疆维吾尔自治区阿拉尔市中心监狱', '', '', 'zxjy', 'Z', 0);
INSERT INTO `tp_city` VALUES (1316, 1154, 0, 2, 0, '图木舒克市', '新疆维吾尔自治区图木舒克市', '843806', '', 'tmsks', 'T', 0);
INSERT INTO `tp_city` VALUES (1317, 1316, 0, 3, 0, '齐干却勒街道办事处', '新疆维吾尔自治区图木舒克市齐干却勒街道办事处', '', '', 'qgqljdbsc', 'Q', 0);
INSERT INTO `tp_city` VALUES (1318, 1316, 0, 3, 0, '前海街道办事处', '新疆维吾尔自治区图木舒克市前海街道办事处', '', '', 'qhjdbsc', 'Q', 0);
INSERT INTO `tp_city` VALUES (1319, 1316, 0, 3, 0, '永安坝街道办事处', '新疆维吾尔自治区图木舒克市永安坝街道办事处', '', '', 'yabjdbsc', 'Y', 0);
INSERT INTO `tp_city` VALUES (1320, 1316, 0, 3, 0, '兵团四十四团', '新疆维吾尔自治区图木舒克市兵团四十四团', '', '', 'btssst', 'B', 0);
INSERT INTO `tp_city` VALUES (1321, 1316, 0, 3, 0, '兵团四十九团', '新疆维吾尔自治区图木舒克市兵团四十九团', '', '', 'btssjt', 'B', 0);
INSERT INTO `tp_city` VALUES (1322, 1316, 0, 3, 0, '兵团五十团', '新疆维吾尔自治区图木舒克市兵团五十团', '', '', 'btwst', 'B', 0);
INSERT INTO `tp_city` VALUES (1323, 1316, 0, 3, 0, '兵团五十一团', '新疆维吾尔自治区图木舒克市兵团五十一团', '', '', 'btwsyt', 'B', 0);
INSERT INTO `tp_city` VALUES (1324, 1316, 0, 3, 0, '兵团五十三团', '新疆维吾尔自治区图木舒克市兵团五十三团', '', '', 'btwsst', 'B', 0);
INSERT INTO `tp_city` VALUES (1325, 1316, 0, 3, 0, '兵团图木舒克市喀拉拜勒镇', '新疆维吾尔自治区图木舒克市兵团图木舒克市喀拉拜勒镇', '', '', 'bttmsksklb', 'B', 0);
INSERT INTO `tp_city` VALUES (1326, 1316, 0, 3, 0, '兵团图木舒克市永安坝', '新疆维吾尔自治区图木舒克市兵团图木舒克市永安坝', '', '', 'bttmsksyab', 'B', 0);
INSERT INTO `tp_city` VALUES (1327, 0, 0, 1, 0, '吉林省', '吉林省', '', '', 'jls', 'J', 0);
INSERT INTO `tp_city` VALUES (1328, 1327, 0, 2, 0, '延边朝鲜族自治州', '吉林省延边朝鲜族自治州', '133000', '', 'ybcxzzzz', 'Y', 0);
INSERT INTO `tp_city` VALUES (1329, 1328, 0, 3, 0, '汪清县', '吉林省延边朝鲜族自治州汪清县', '133200', '', 'wqx', 'W', 0);
INSERT INTO `tp_city` VALUES (1330, 1328, 0, 3, 0, '其它区', '吉林省延边朝鲜族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1331, 1328, 0, 3, 0, '安图县', '吉林省延边朝鲜族自治州安图县', '133600', '', 'atx', 'A', 0);
INSERT INTO `tp_city` VALUES (1332, 1328, 0, 3, 0, '延吉市', '吉林省延边朝鲜族自治州延吉市', '133000', '', 'yjs', 'Y', 0);
INSERT INTO `tp_city` VALUES (1333, 1328, 0, 3, 0, '图们市', '吉林省延边朝鲜族自治州图们市', '133100', '', 'tms', 'T', 0);
INSERT INTO `tp_city` VALUES (1334, 1328, 0, 3, 0, '敦化市', '吉林省延边朝鲜族自治州敦化市', '133700', '', 'dhs', 'D', 0);
INSERT INTO `tp_city` VALUES (1335, 1328, 0, 3, 0, '珲春市', '吉林省延边朝鲜族自治州珲春市', '133300', '', 'cs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1336, 1328, 0, 3, 0, '龙井市', '吉林省延边朝鲜族自治州龙井市', '133400', '', 'ljs', 'L', 0);
INSERT INTO `tp_city` VALUES (1337, 1328, 0, 3, 0, '和龙市', '吉林省延边朝鲜族自治州和龙市', '133500', '', 'hls', 'H', 0);
INSERT INTO `tp_city` VALUES (1338, 1327, 0, 2, 0, '长春市', '吉林省长春市', '130000', '', 'ccs', 'C', 0);
INSERT INTO `tp_city` VALUES (1339, 1338, 0, 3, 0, '农安县', '吉林省长春市农安县', '130200', '', 'nax', 'N', 0);
INSERT INTO `tp_city` VALUES (1340, 1338, 0, 3, 0, '双阳区', '吉林省长春市双阳区', '130600', '', 'syq', 'S', 0);
INSERT INTO `tp_city` VALUES (1341, 1338, 0, 3, 0, '二道区', '吉林省长春市二道区', '130031', '', 'edq', 'E', 0);
INSERT INTO `tp_city` VALUES (1342, 1338, 0, 3, 0, '朝阳区', '吉林省长春市朝阳区', '130012', '', 'cyq', 'C', 0);
INSERT INTO `tp_city` VALUES (1343, 1338, 0, 3, 0, '绿园区', '吉林省长春市绿园区', '130062', '', 'lyq', 'L', 0);
INSERT INTO `tp_city` VALUES (1344, 1338, 0, 3, 0, '宽城区', '吉林省长春市宽城区', '130051', '', 'kcq', 'K', 0);
INSERT INTO `tp_city` VALUES (1345, 1338, 0, 3, 0, '南关区', '吉林省长春市南关区', '130022', '', 'ngq', 'N', 0);
INSERT INTO `tp_city` VALUES (1346, 1338, 0, 3, 0, '其它区', '吉林省长春市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1347, 1338, 0, 3, 0, '净月旅游开发区', '吉林省长春市净月旅游开发区', '', '', 'jylykfq', 'J', 0);
INSERT INTO `tp_city` VALUES (1348, 1338, 0, 3, 0, '经济技术开发区', '吉林省长春市经济技术开发区', '', '', 'jjjskfq', 'J', 0);
INSERT INTO `tp_city` VALUES (1349, 1338, 0, 3, 0, '汽车产业开发区', '吉林省长春市汽车产业开发区', '', '', 'qccykfq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1350, 1338, 0, 3, 0, '高新技术产业开发区', '吉林省长春市高新技术产业开发区', '', '', 'gxjscykfq', 'G', 0);
INSERT INTO `tp_city` VALUES (1351, 1338, 0, 3, 0, '德惠市', '吉林省长春市德惠市', '130300', '', 'dhs', 'D', 0);
INSERT INTO `tp_city` VALUES (1352, 1338, 0, 3, 0, '榆树市', '吉林省长春市榆树市', '130400', '', 'yss', 'Y', 0);
INSERT INTO `tp_city` VALUES (1353, 1338, 0, 3, 0, '九台市', '吉林省长春市九台市', '130500', '', 'jts', 'J', 0);
INSERT INTO `tp_city` VALUES (1354, 1327, 0, 2, 0, '松原市', '吉林省松原市', '138000', '', 'sys', 'S', 0);
INSERT INTO `tp_city` VALUES (1355, 1354, 0, 3, 0, '前郭尔罗斯蒙古族自治县', '吉林省松原市前郭尔罗斯蒙古族自治县', '131100', '', 'qgelsmgzzz', 'Q', 0);
INSERT INTO `tp_city` VALUES (1356, 1354, 0, 3, 0, '乾安县', '吉林省松原市乾安县', '131400', '', 'qax', 'Q', 0);
INSERT INTO `tp_city` VALUES (1357, 1354, 0, 3, 0, '长岭县', '吉林省松原市长岭县', '131500', '', 'clx', 'C', 0);
INSERT INTO `tp_city` VALUES (1358, 1354, 0, 3, 0, '其它区', '吉林省松原市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1359, 1354, 0, 3, 0, '扶余市', '吉林省松原市扶余市', '131200', '', 'fys', 'F', 0);
INSERT INTO `tp_city` VALUES (1360, 1354, 0, 3, 0, '宁江区', '吉林省松原市宁江区', '138000', '', 'njq', 'N', 0);
INSERT INTO `tp_city` VALUES (1361, 1327, 0, 2, 0, '白城市', '吉林省白城市', '137000', '', 'bcs', 'B', 0);
INSERT INTO `tp_city` VALUES (1362, 1361, 0, 3, 0, '大安市', '吉林省白城市大安市', '131300', '', 'das', 'D', 0);
INSERT INTO `tp_city` VALUES (1363, 1361, 0, 3, 0, '其它区', '吉林省白城市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1364, 1361, 0, 3, 0, '洮南市', '吉林省白城市洮南市', '137100', '', 'ns', 'Z', 0);
INSERT INTO `tp_city` VALUES (1365, 1361, 0, 3, 0, '洮北区', '吉林省白城市洮北区', '137000', '', 'bq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1366, 1361, 0, 3, 0, '通榆县', '吉林省白城市通榆县', '137200', '', 'tyx', 'T', 0);
INSERT INTO `tp_city` VALUES (1367, 1361, 0, 3, 0, '镇赉县', '吉林省白城市镇赉县', '137300', '', 'zx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1368, 1327, 0, 2, 0, '通化市', '吉林省通化市', '134000', '', 'ths', 'T', 0);
INSERT INTO `tp_city` VALUES (1369, 1368, 0, 3, 0, '二道江区', '吉林省通化市二道江区', '134303', '', 'edjq', 'E', 0);
INSERT INTO `tp_city` VALUES (1370, 1368, 0, 3, 0, '东昌区', '吉林省通化市东昌区', '134001', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (1371, 1368, 0, 3, 0, '辉南县', '吉林省通化市辉南县', '135100', '', 'hnx', 'H', 0);
INSERT INTO `tp_city` VALUES (1372, 1368, 0, 3, 0, '通化县', '吉林省通化市通化县', '134100', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (1373, 1368, 0, 3, 0, '柳河县', '吉林省通化市柳河县', '135300', '', 'lhx', 'L', 0);
INSERT INTO `tp_city` VALUES (1374, 1368, 0, 3, 0, '其它区', '吉林省通化市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1375, 1368, 0, 3, 0, '集安市', '吉林省通化市集安市', '134200', '', 'jas', 'J', 0);
INSERT INTO `tp_city` VALUES (1376, 1368, 0, 3, 0, '梅河口市', '吉林省通化市梅河口市', '135000', '', 'mhks', 'M', 0);
INSERT INTO `tp_city` VALUES (1377, 1327, 0, 2, 0, '白山市', '吉林省白山市', '134300', '', 'bss', 'B', 0);
INSERT INTO `tp_city` VALUES (1378, 1377, 0, 3, 0, '其它区', '吉林省白山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1379, 1377, 0, 3, 0, '临江市', '吉林省白山市临江市', '134600', '', 'ljs', 'L', 0);
INSERT INTO `tp_city` VALUES (1380, 1377, 0, 3, 0, '江源区', '吉林省白山市江源区', '134700', '', 'jyq', 'J', 0);
INSERT INTO `tp_city` VALUES (1381, 1377, 0, 3, 0, '抚松县', '吉林省白山市抚松县', '134500', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (1382, 1377, 0, 3, 0, '长白朝鲜族自治县', '吉林省白山市长白朝鲜族自治县', '134400', '', 'cbcxzzzx', 'C', 0);
INSERT INTO `tp_city` VALUES (1383, 1377, 0, 3, 0, '靖宇县', '吉林省白山市靖宇县', '135200', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (1384, 1377, 0, 3, 0, '浑江区', '吉林省白山市浑江区', '134300', '', 'hjq', 'H', 0);
INSERT INTO `tp_city` VALUES (1385, 1327, 0, 2, 0, '吉林市', '吉林省吉林市', '132000', '', 'jls', 'J', 0);
INSERT INTO `tp_city` VALUES (1386, 1385, 0, 3, 0, '蛟河市', '吉林省吉林市蛟河市', '132500', '', 'hs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1387, 1385, 0, 3, 0, '舒兰市', '吉林省吉林市舒兰市', '132600', '', 'sls', 'S', 0);
INSERT INTO `tp_city` VALUES (1388, 1385, 0, 3, 0, '桦甸市', '吉林省吉林市桦甸市', '132400', '', 'ds', 'Z', 0);
INSERT INTO `tp_city` VALUES (1389, 1385, 0, 3, 0, '其它区', '吉林省吉林市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1390, 1385, 0, 3, 0, '磐石市', '吉林省吉林市磐石市', '132300', '', 'pss', 'P', 0);
INSERT INTO `tp_city` VALUES (1391, 1385, 0, 3, 0, '船营区', '吉林省吉林市船营区', '132011', '', 'cyq', 'C', 0);
INSERT INTO `tp_city` VALUES (1392, 1385, 0, 3, 0, '昌邑区', '吉林省吉林市昌邑区', '132002', '', 'cyq', 'C', 0);
INSERT INTO `tp_city` VALUES (1393, 1385, 0, 3, 0, '龙潭区', '吉林省吉林市龙潭区', '132021', '', 'ltq', 'L', 0);
INSERT INTO `tp_city` VALUES (1394, 1385, 0, 3, 0, '永吉县', '吉林省吉林市永吉县', '132100', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1395, 1385, 0, 3, 0, '丰满区', '吉林省吉林市丰满区', '132113', '', 'fmq', 'F', 0);
INSERT INTO `tp_city` VALUES (1396, 1327, 0, 2, 0, '辽源市', '吉林省辽源市', '136200', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (1397, 1396, 0, 3, 0, '东丰县', '吉林省辽源市东丰县', '136300', '', 'dfx', 'D', 0);
INSERT INTO `tp_city` VALUES (1398, 1396, 0, 3, 0, '东辽县', '吉林省辽源市东辽县', '136600', '', 'dlx', 'D', 0);
INSERT INTO `tp_city` VALUES (1399, 1396, 0, 3, 0, '其它区', '吉林省辽源市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1400, 1396, 0, 3, 0, '龙山区', '吉林省辽源市龙山区', '136200', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (1401, 1396, 0, 3, 0, '西安区', '吉林省辽源市西安区', '136201', '', 'xaq', 'X', 0);
INSERT INTO `tp_city` VALUES (1402, 1327, 0, 2, 0, '四平市', '吉林省四平市', '136000', '', 'sps', 'S', 0);
INSERT INTO `tp_city` VALUES (1403, 1402, 0, 3, 0, '双辽市', '吉林省四平市双辽市', '136400', '', 'sls', 'S', 0);
INSERT INTO `tp_city` VALUES (1404, 1402, 0, 3, 0, '其它区', '吉林省四平市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1405, 1402, 0, 3, 0, '公主岭市', '吉林省四平市公主岭市', '136100', '', 'gzls', 'G', 0);
INSERT INTO `tp_city` VALUES (1406, 1402, 0, 3, 0, '铁东区', '吉林省四平市铁东区', '136001', '', 'tdq', 'T', 0);
INSERT INTO `tp_city` VALUES (1407, 1402, 0, 3, 0, '铁西区', '吉林省四平市铁西区', '136000', '', 'txq', 'T', 0);
INSERT INTO `tp_city` VALUES (1408, 1402, 0, 3, 0, '伊通满族自治县', '吉林省四平市伊通满族自治县', '130700', '', 'ytmzzzx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1409, 1402, 0, 3, 0, '梨树县', '吉林省四平市梨树县', '136500', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (1410, 0, 0, 1, 0, '安徽省', '安徽省', '', '', 'ahs', 'A', 0);
INSERT INTO `tp_city` VALUES (1411, 1410, 0, 2, 0, '蚌埠市', '安徽省蚌埠市', '233000', '', 'bbs', 'B', 0);
INSERT INTO `tp_city` VALUES (1412, 1411, 0, 3, 0, '五河县', '安徽省蚌埠市五河县', '233300', '', 'whx', 'W', 0);
INSERT INTO `tp_city` VALUES (1413, 1411, 0, 3, 0, '固镇县', '安徽省蚌埠市固镇县', '233200', '', 'gzx', 'G', 0);
INSERT INTO `tp_city` VALUES (1414, 1411, 0, 3, 0, '怀远县', '安徽省蚌埠市怀远县', '233400', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (1415, 1411, 0, 3, 0, '其它区', '安徽省蚌埠市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1416, 1411, 0, 3, 0, '龙子湖区', '安徽省蚌埠市龙子湖区', '233000', '', 'lzhq', 'L', 0);
INSERT INTO `tp_city` VALUES (1417, 1411, 0, 3, 0, '蚌山区', '安徽省蚌埠市蚌山区', '233000', '', 'bsq', 'B', 0);
INSERT INTO `tp_city` VALUES (1418, 1411, 0, 3, 0, '禹会区', '安徽省蚌埠市禹会区', '233010', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1419, 1411, 0, 3, 0, '淮上区', '安徽省蚌埠市淮上区', '233002', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (1420, 1410, 0, 2, 0, '淮南市', '安徽省淮南市', '232000', '', 'hns', 'H', 0);
INSERT INTO `tp_city` VALUES (1421, 1420, 0, 3, 0, '潘集区', '安徽省淮南市潘集区', '232082', '', 'pjq', 'P', 0);
INSERT INTO `tp_city` VALUES (1422, 1420, 0, 3, 0, '谢家集区', '安徽省淮南市谢家集区', '232052', '', 'xjjq', 'X', 0);
INSERT INTO `tp_city` VALUES (1423, 1420, 0, 3, 0, '八公山区', '安徽省淮南市八公山区', '232072', '', 'bgsq', 'B', 0);
INSERT INTO `tp_city` VALUES (1424, 1420, 0, 3, 0, '大通区', '安徽省淮南市大通区', '232033', '', 'dtq', 'D', 0);
INSERT INTO `tp_city` VALUES (1425, 1420, 0, 3, 0, '田家庵区', '安徽省淮南市田家庵区', '232000', '', 'tjq', 'T', 0);
INSERT INTO `tp_city` VALUES (1426, 1420, 0, 3, 0, '凤台县', '安徽省淮南市凤台县', '232100', '', 'ftx', 'F', 0);
INSERT INTO `tp_city` VALUES (1427, 1420, 0, 3, 0, '其它区', '安徽省淮南市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1428, 1410, 0, 2, 0, '合肥市', '安徽省合肥市', '230000', '', 'hfs', 'H', 0);
INSERT INTO `tp_city` VALUES (1429, 1428, 0, 3, 0, '高新区', '安徽省合肥市高新区', '', '', 'gxq', 'G', 0);
INSERT INTO `tp_city` VALUES (1430, 1428, 0, 3, 0, '肥东县', '安徽省合肥市肥东县', '231600', '', 'fdx', 'F', 0);
INSERT INTO `tp_city` VALUES (1431, 1428, 0, 3, 0, '肥西县', '安徽省合肥市肥西县', '231200', '', 'fxx', 'F', 0);
INSERT INTO `tp_city` VALUES (1432, 1428, 0, 3, 0, '长丰县', '安徽省合肥市长丰县', '231100', '', 'cfx', 'C', 0);
INSERT INTO `tp_city` VALUES (1433, 1428, 0, 3, 0, '包河区', '安徽省合肥市包河区', '230041', '', 'bhq', 'B', 0);
INSERT INTO `tp_city` VALUES (1434, 1428, 0, 3, 0, '蜀山区', '安徽省合肥市蜀山区', '230061', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (1435, 1428, 0, 3, 0, '庐阳区', '安徽省合肥市庐阳区', '230001', '', 'lyq', 'L', 0);
INSERT INTO `tp_city` VALUES (1436, 1428, 0, 3, 0, '瑶海区', '安徽省合肥市瑶海区', '230011', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1437, 1428, 0, 3, 0, '其它区', '安徽省合肥市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1438, 1428, 0, 3, 0, '中区', '安徽省合肥市中区', '', '', 'zq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1439, 1428, 0, 3, 0, '庐江县', '安徽省合肥市庐江县', '231500', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (1440, 1428, 0, 3, 0, '巢湖市', '安徽省合肥市巢湖市', '238000', '', 'chs', 'C', 0);
INSERT INTO `tp_city` VALUES (1441, 1428, 0, 3, 0, '居巢区', '安徽省合肥市居巢区', '238000', '', 'jcq', 'J', 0);
INSERT INTO `tp_city` VALUES (1442, 1410, 0, 2, 0, '芜湖市', '安徽省芜湖市', '241000', '', 'whs', 'W', 0);
INSERT INTO `tp_city` VALUES (1443, 1442, 0, 3, 0, '其它区', '安徽省芜湖市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1444, 1442, 0, 3, 0, '芜湖县', '安徽省芜湖市芜湖县', '241100', '', 'whx', 'W', 0);
INSERT INTO `tp_city` VALUES (1445, 1442, 0, 3, 0, '繁昌县', '安徽省芜湖市繁昌县', '241200', '', 'fcx', 'F', 0);
INSERT INTO `tp_city` VALUES (1446, 1442, 0, 3, 0, '南陵县', '安徽省芜湖市南陵县', '242400', '', 'nlx', 'N', 0);
INSERT INTO `tp_city` VALUES (1447, 1442, 0, 3, 0, '三山区', '安徽省芜湖市三山区', '241000', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (1448, 1442, 0, 3, 0, '弋江区', '安徽省芜湖市弋江区', '241000', '', 'jq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1449, 1442, 0, 3, 0, '镜湖区', '安徽省芜湖市镜湖区', '241000', '', 'jhq', 'J', 0);
INSERT INTO `tp_city` VALUES (1450, 1442, 0, 3, 0, '鸠江区', '安徽省芜湖市鸠江区', '241000', '', 'jq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1451, 1442, 0, 3, 0, '无为县', '安徽省芜湖市无为县', '238300', '', 'wwx', 'W', 0);
INSERT INTO `tp_city` VALUES (1452, 1410, 0, 2, 0, '安庆市', '安徽省安庆市', '246000', '', 'aqs', 'A', 0);
INSERT INTO `tp_city` VALUES (1453, 1452, 0, 3, 0, '迎江区', '安徽省安庆市迎江区', '246003', '', 'yjq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1454, 1452, 0, 3, 0, '大观区', '安徽省安庆市大观区', '246004', '', 'dgq', 'D', 0);
INSERT INTO `tp_city` VALUES (1455, 1452, 0, 3, 0, '宜秀区', '安徽省安庆市宜秀区', '246003', '', 'yxq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1456, 1452, 0, 3, 0, '枞阳县', '安徽省安庆市枞阳县', '246700', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1457, 1452, 0, 3, 0, '怀宁县', '安徽省安庆市怀宁县', '246100', '', 'hnx', 'H', 0);
INSERT INTO `tp_city` VALUES (1458, 1452, 0, 3, 0, '岳西县', '安徽省安庆市岳西县', '246600', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1459, 1452, 0, 3, 0, '太湖县', '安徽省安庆市太湖县', '246400', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (1460, 1452, 0, 3, 0, '潜山县', '安徽省安庆市潜山县', '246300', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1461, 1452, 0, 3, 0, '望江县', '安徽省安庆市望江县', '246200', '', 'wjx', 'W', 0);
INSERT INTO `tp_city` VALUES (1462, 1452, 0, 3, 0, '宿松县', '安徽省安庆市宿松县', '246500', '', 'ssx', 'S', 0);
INSERT INTO `tp_city` VALUES (1463, 1452, 0, 3, 0, '桐城市', '安徽省安庆市桐城市', '231400', '', 'tcs', 'T', 0);
INSERT INTO `tp_city` VALUES (1464, 1452, 0, 3, 0, '其它区', '安徽省安庆市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1465, 1410, 0, 2, 0, '马鞍山市', '安徽省马鞍山市', '243000', '', 'mass', 'M', 0);
INSERT INTO `tp_city` VALUES (1466, 1465, 0, 3, 0, '花山区', '安徽省马鞍山市花山区', '243000', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (1467, 1465, 0, 3, 0, '金家庄区', '安徽省马鞍山市金家庄区', '243021', '', 'jjzq', 'J', 0);
INSERT INTO `tp_city` VALUES (1468, 1465, 0, 3, 0, '博望区', '安徽省马鞍山市博望区', '', '', 'bwq', 'B', 0);
INSERT INTO `tp_city` VALUES (1469, 1465, 0, 3, 0, '雨山区', '安徽省马鞍山市雨山区', '243071', '', 'ysq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1470, 1465, 0, 3, 0, '当涂县', '安徽省马鞍山市当涂县', '243100', '', 'dtx', 'D', 0);
INSERT INTO `tp_city` VALUES (1471, 1465, 0, 3, 0, '其它区', '安徽省马鞍山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1472, 1465, 0, 3, 0, '含山县', '安徽省马鞍山市含山县', '238100', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (1473, 1465, 0, 3, 0, '和县', '安徽省马鞍山市和县', '238200', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (1474, 1410, 0, 2, 0, '淮北市', '安徽省淮北市', '235000', '', 'hbs', 'H', 0);
INSERT INTO `tp_city` VALUES (1475, 1474, 0, 3, 0, '烈山区', '安徽省淮北市烈山区', '235025', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (1476, 1474, 0, 3, 0, '相山区', '安徽省淮北市相山区', '235000', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (1477, 1474, 0, 3, 0, '杜集区', '安徽省淮北市杜集区', '235047', '', 'djq', 'D', 0);
INSERT INTO `tp_city` VALUES (1478, 1474, 0, 3, 0, '其它区', '安徽省淮北市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1479, 1474, 0, 3, 0, '濉溪县', '安徽省淮北市濉溪县', '235100', '', 'xx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1480, 1410, 0, 2, 0, '铜陵市', '安徽省铜陵市', '244000', '', 'tls', 'T', 0);
INSERT INTO `tp_city` VALUES (1481, 1480, 0, 3, 0, '铜官山区', '安徽省铜陵市铜官山区', '244000', '', 'tgsq', 'T', 0);
INSERT INTO `tp_city` VALUES (1482, 1480, 0, 3, 0, '狮子山区', '安徽省铜陵市狮子山区', '244031', '', 'szsq', 'S', 0);
INSERT INTO `tp_city` VALUES (1483, 1480, 0, 3, 0, '铜陵县', '安徽省铜陵市铜陵县', '244100', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (1484, 1480, 0, 3, 0, '其它区', '安徽省铜陵市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1485, 1480, 0, 3, 0, '郊区', '安徽省铜陵市郊区', '244000', '', 'jq', 'J', 0);
INSERT INTO `tp_city` VALUES (1486, 1410, 0, 2, 0, '宿州市', '安徽省宿州市', '234000', '', 'szs', 'S', 0);
INSERT INTO `tp_city` VALUES (1487, 1486, 0, 3, 0, '砀山县', '安徽省宿州市砀山县', '235300', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1488, 1486, 0, 3, 0, '萧县', '安徽省宿州市萧县', '235200', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (1489, 1486, 0, 3, 0, '灵璧县', '安徽省宿州市灵璧县', '234200', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (1490, 1486, 0, 3, 0, '泗县', '安徽省宿州市泗县', '234300', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (1491, 1486, 0, 3, 0, '其它区', '安徽省宿州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1492, 1486, 0, 3, 0, '埇桥区', '安徽省宿州市埇桥区', '234000', '', 'qq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1493, 1410, 0, 2, 0, '六安市', '安徽省六安市', '237000', '', 'las', 'L', 0);
INSERT INTO `tp_city` VALUES (1494, 1493, 0, 3, 0, '金安区', '安徽省六安市金安区', '237005', '', 'jaq', 'J', 0);
INSERT INTO `tp_city` VALUES (1495, 1493, 0, 3, 0, '裕安区', '安徽省六安市裕安区', '237010', '', 'yaq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1496, 1493, 0, 3, 0, '舒城县', '安徽省六安市舒城县', '231300', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (1497, 1493, 0, 3, 0, '霍邱县', '安徽省六安市霍邱县', '237400', '', 'hqx', 'H', 0);
INSERT INTO `tp_city` VALUES (1498, 1493, 0, 3, 0, '寿县', '安徽省六安市寿县', '232200', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (1499, 1493, 0, 3, 0, '其它区', '安徽省六安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1500, 1493, 0, 3, 0, '霍山县', '安徽省六安市霍山县', '237200', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (1501, 1493, 0, 3, 0, '金寨县', '安徽省六安市金寨县', '237300', '', 'jzx', 'J', 0);
INSERT INTO `tp_city` VALUES (1502, 1410, 0, 2, 0, '滁州市', '安徽省滁州市', '239000', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (1503, 1502, 0, 3, 0, '琅琊区', '安徽省滁州市琅琊区', '239000', '', 'lq', 'L', 0);
INSERT INTO `tp_city` VALUES (1504, 1502, 0, 3, 0, '南谯区', '安徽省滁州市南谯区', '239000', '', 'nq', 'N', 0);
INSERT INTO `tp_city` VALUES (1505, 1502, 0, 3, 0, '天长市', '安徽省滁州市天长市', '239300', '', 'tcs', 'T', 0);
INSERT INTO `tp_city` VALUES (1506, 1502, 0, 3, 0, '明光市', '安徽省滁州市明光市', '239400', '', 'mgs', 'M', 0);
INSERT INTO `tp_city` VALUES (1507, 1502, 0, 3, 0, '其它区', '安徽省滁州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1508, 1502, 0, 3, 0, '凤阳县', '安徽省滁州市凤阳县', '233100', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (1509, 1502, 0, 3, 0, '定远县', '安徽省滁州市定远县', '233200', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (1510, 1502, 0, 3, 0, '全椒县', '安徽省滁州市全椒县', '239500', '', 'qjx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1511, 1502, 0, 3, 0, '来安县', '安徽省滁州市来安县', '239200', '', 'lax', 'L', 0);
INSERT INTO `tp_city` VALUES (1512, 1410, 0, 2, 0, '黄山市', '安徽省黄山市', '245000', '', 'hss', 'H', 0);
INSERT INTO `tp_city` VALUES (1513, 1512, 0, 3, 0, '祁门县', '安徽省黄山市祁门县', '245600', '', 'qmx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1514, 1512, 0, 3, 0, '其它区', '安徽省黄山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1515, 1512, 0, 3, 0, '黟县', '安徽省黄山市黟县', '245500', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (1516, 1512, 0, 3, 0, '休宁县', '安徽省黄山市休宁县', '245400', '', 'xnx', 'X', 0);
INSERT INTO `tp_city` VALUES (1517, 1512, 0, 3, 0, '歙县', '安徽省黄山市歙县', '245200', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (1518, 1512, 0, 3, 0, '徽州区', '安徽省黄山市徽州区', '245061', '', 'hzq', 'H', 0);
INSERT INTO `tp_city` VALUES (1519, 1512, 0, 3, 0, '屯溪区', '安徽省黄山市屯溪区', '245000', '', 'txq', 'T', 0);
INSERT INTO `tp_city` VALUES (1520, 1512, 0, 3, 0, '黄山区', '安徽省黄山市黄山区', '242700', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (1521, 1410, 0, 2, 0, '阜阳市', '安徽省阜阳市', '236000', '', 'fys', 'F', 0);
INSERT INTO `tp_city` VALUES (1522, 1521, 0, 3, 0, '界首市', '安徽省阜阳市界首市', '236500', '', 'jss', 'J', 0);
INSERT INTO `tp_city` VALUES (1523, 1521, 0, 3, 0, '其它区', '安徽省阜阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1524, 1521, 0, 3, 0, '临泉县', '安徽省阜阳市临泉县', '236400', '', 'lqx', 'L', 0);
INSERT INTO `tp_city` VALUES (1525, 1521, 0, 3, 0, '太和县', '安徽省阜阳市太和县', '236600', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (1526, 1521, 0, 3, 0, '阜南县', '安徽省阜阳市阜南县', '236300', '', 'fnx', 'F', 0);
INSERT INTO `tp_city` VALUES (1527, 1521, 0, 3, 0, '颍上县', '安徽省阜阳市颍上县', '236200', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1528, 1521, 0, 3, 0, '颍州区', '安徽省阜阳市颍州区', '236001', '', 'zq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1529, 1521, 0, 3, 0, '颍东区', '安徽省阜阳市颍东区', '236058', '', 'dq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1530, 1521, 0, 3, 0, '颍泉区', '安徽省阜阳市颍泉区', '236045', '', 'qq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1531, 1410, 0, 2, 0, '宣城市', '安徽省宣城市', '242000', '', 'xcs', 'X', 0);
INSERT INTO `tp_city` VALUES (1532, 1531, 0, 3, 0, '绩溪县', '安徽省宣城市绩溪县', '245300', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (1533, 1531, 0, 3, 0, '旌德县', '安徽省宣城市旌德县', '242600', '', 'dx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1534, 1531, 0, 3, 0, '其它区', '安徽省宣城市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1535, 1531, 0, 3, 0, '宁国市', '安徽省宣城市宁国市', '242300', '', 'ngs', 'N', 0);
INSERT INTO `tp_city` VALUES (1536, 1531, 0, 3, 0, '宣州区', '安徽省宣城市宣州区', '242000', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (1537, 1531, 0, 3, 0, '泾县', '安徽省宣城市泾县', '242500', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (1538, 1531, 0, 3, 0, '广德县', '安徽省宣城市广德县', '242200', '', 'gdx', 'G', 0);
INSERT INTO `tp_city` VALUES (1539, 1531, 0, 3, 0, '郎溪县', '安徽省宣城市郎溪县', '242100', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (1540, 1410, 0, 2, 0, '亳州市', '安徽省亳州市', '236800', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1541, 1540, 0, 3, 0, '其它区', '安徽省亳州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1542, 1540, 0, 3, 0, '涡阳县', '安徽省亳州市涡阳县', '233600', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (1543, 1540, 0, 3, 0, '利辛县', '安徽省亳州市利辛县', '236700', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (1544, 1540, 0, 3, 0, '蒙城县', '安徽省亳州市蒙城县', '233500', '', 'mcx', 'M', 0);
INSERT INTO `tp_city` VALUES (1545, 1540, 0, 3, 0, '谯城区', '安徽省亳州市谯城区', '236800', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1546, 1410, 0, 2, 0, '池州市', '安徽省池州市', '247000', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (1547, 1546, 0, 3, 0, '其它区', '安徽省池州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1548, 1546, 0, 3, 0, '石台县', '安徽省池州市石台县', '245100', '', 'stx', 'S', 0);
INSERT INTO `tp_city` VALUES (1549, 1546, 0, 3, 0, '青阳县', '安徽省池州市青阳县', '242800', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1550, 1546, 0, 3, 0, '东至县', '安徽省池州市东至县', '247200', '', 'dzx', 'D', 0);
INSERT INTO `tp_city` VALUES (1551, 1546, 0, 3, 0, '贵池区', '安徽省池州市贵池区', '247100', '', 'gcq', 'G', 0);
INSERT INTO `tp_city` VALUES (1552, 0, 0, 1, 0, '内蒙古自治区', '内蒙古自治区', '', '', 'nmgzzq', 'N', 0);
INSERT INTO `tp_city` VALUES (1553, 1552, 0, 2, 0, '呼和浩特市', '内蒙古自治区呼和浩特市', '010000', '', 'hhhts', 'H', 0);
INSERT INTO `tp_city` VALUES (1554, 1553, 0, 3, 0, '回民区', '内蒙古自治区呼和浩特市回民区', '010030', '', 'hmq', 'H', 0);
INSERT INTO `tp_city` VALUES (1555, 1553, 0, 3, 0, '新城区', '内蒙古自治区呼和浩特市新城区', '010050', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (1556, 1553, 0, 3, 0, '赛罕区', '内蒙古自治区呼和浩特市赛罕区', '010020', '', 'shq', 'S', 0);
INSERT INTO `tp_city` VALUES (1557, 1553, 0, 3, 0, '玉泉区', '内蒙古自治区呼和浩特市玉泉区', '010020', '', 'yqq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1558, 1553, 0, 3, 0, '清水河县', '内蒙古自治区呼和浩特市清水河县', '011600', '', 'qshx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1559, 1553, 0, 3, 0, '武川县', '内蒙古自治区呼和浩特市武川县', '011700', '', 'wcx', 'W', 0);
INSERT INTO `tp_city` VALUES (1560, 1553, 0, 3, 0, '其它区', '内蒙古自治区呼和浩特市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1561, 1553, 0, 3, 0, '土默特左旗', '内蒙古自治区呼和浩特市土默特左旗', '010100', '', 'tmtzq', 'T', 0);
INSERT INTO `tp_city` VALUES (1562, 1553, 0, 3, 0, '托克托县', '内蒙古自治区呼和浩特市托克托县', '010200', '', 'tktx', 'T', 0);
INSERT INTO `tp_city` VALUES (1563, 1553, 0, 3, 0, '和林格尔县', '内蒙古自治区呼和浩特市和林格尔县', '011500', '', 'hlgex', 'H', 0);
INSERT INTO `tp_city` VALUES (1564, 1552, 0, 2, 0, '包头市', '内蒙古自治区包头市', '014000', '', 'bts', 'B', 0);
INSERT INTO `tp_city` VALUES (1565, 1564, 0, 3, 0, '东河区', '内蒙古自治区包头市东河区', '014040', '', 'dhq', 'D', 0);
INSERT INTO `tp_city` VALUES (1566, 1564, 0, 3, 0, '昆都仑区', '内蒙古自治区包头市昆都仑区', '014010', '', 'kdlq', 'K', 0);
INSERT INTO `tp_city` VALUES (1567, 1564, 0, 3, 0, '青山区', '内蒙古自治区包头市青山区', '014030', '', 'qsq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1568, 1564, 0, 3, 0, '石拐区', '内蒙古自治区包头市石拐区', '014070', '', 'sgq', 'S', 0);
INSERT INTO `tp_city` VALUES (1569, 1564, 0, 3, 0, '白云鄂博矿区', '内蒙古自治区包头市白云鄂博矿区', '014080', '', 'byebkq', 'B', 0);
INSERT INTO `tp_city` VALUES (1570, 1564, 0, 3, 0, '九原区', '内蒙古自治区包头市九原区', '014060', '', 'jyq', 'J', 0);
INSERT INTO `tp_city` VALUES (1571, 1564, 0, 3, 0, '其它区', '内蒙古自治区包头市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1572, 1564, 0, 3, 0, '达尔罕茂明安联合旗', '内蒙古自治区包头市达尔罕茂明安联合旗', '014500', '', 'dehmmalhq', 'D', 0);
INSERT INTO `tp_city` VALUES (1573, 1564, 0, 3, 0, '固阳县', '内蒙古自治区包头市固阳县', '014200', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (1574, 1564, 0, 3, 0, '土默特右旗', '内蒙古自治区包头市土默特右旗', '014100', '', 'tmtyq', 'T', 0);
INSERT INTO `tp_city` VALUES (1575, 1552, 0, 2, 0, '乌海市', '内蒙古自治区乌海市', '016000', '', 'whs', 'W', 0);
INSERT INTO `tp_city` VALUES (1576, 1575, 0, 3, 0, '海南区', '内蒙古自治区乌海市海南区', '016030', '', 'hnq', 'H', 0);
INSERT INTO `tp_city` VALUES (1577, 1575, 0, 3, 0, '海勃湾区', '内蒙古自治区乌海市海勃湾区', '016000', '', 'hbwq', 'H', 0);
INSERT INTO `tp_city` VALUES (1578, 1575, 0, 3, 0, '乌达区', '内蒙古自治区乌海市乌达区', '016040', '', 'wdq', 'W', 0);
INSERT INTO `tp_city` VALUES (1579, 1575, 0, 3, 0, '其它区', '内蒙古自治区乌海市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1580, 1552, 0, 2, 0, '赤峰市', '内蒙古自治区赤峰市', '024000', '', 'cfs', 'C', 0);
INSERT INTO `tp_city` VALUES (1581, 1580, 0, 3, 0, '元宝山区', '内蒙古自治区赤峰市元宝山区', '024076', '', 'ybsq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1582, 1580, 0, 3, 0, '红山区', '内蒙古自治区赤峰市红山区', '024020', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (1583, 1580, 0, 3, 0, '松山区', '内蒙古自治区赤峰市松山区', '024005', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (1584, 1580, 0, 3, 0, '林西县', '内蒙古自治区赤峰市林西县', '025250', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (1585, 1580, 0, 3, 0, '克什克腾旗', '内蒙古自治区赤峰市克什克腾旗', '025350', '', 'ksktq', 'K', 0);
INSERT INTO `tp_city` VALUES (1586, 1580, 0, 3, 0, '翁牛特旗', '内蒙古自治区赤峰市翁牛特旗', '024500', '', 'wntq', 'W', 0);
INSERT INTO `tp_city` VALUES (1587, 1580, 0, 3, 0, '喀喇沁旗', '内蒙古自治区赤峰市喀喇沁旗', '024400', '', 'klqq', 'K', 0);
INSERT INTO `tp_city` VALUES (1588, 1580, 0, 3, 0, '宁城县', '内蒙古自治区赤峰市宁城县', '024200', '', 'ncx', 'N', 0);
INSERT INTO `tp_city` VALUES (1589, 1580, 0, 3, 0, '敖汉旗', '内蒙古自治区赤峰市敖汉旗', '024300', '', 'ahq', 'A', 0);
INSERT INTO `tp_city` VALUES (1590, 1580, 0, 3, 0, '其它区', '内蒙古自治区赤峰市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1591, 1580, 0, 3, 0, '阿鲁科尔沁旗', '内蒙古自治区赤峰市阿鲁科尔沁旗', '025550', '', 'alkeqq', 'A', 0);
INSERT INTO `tp_city` VALUES (1592, 1580, 0, 3, 0, '巴林左旗', '内蒙古自治区赤峰市巴林左旗', '025450', '', 'blzq', 'B', 0);
INSERT INTO `tp_city` VALUES (1593, 1580, 0, 3, 0, '巴林右旗', '内蒙古自治区赤峰市巴林右旗', '025150', '', 'blyq', 'B', 0);
INSERT INTO `tp_city` VALUES (1594, 1552, 0, 2, 0, '通辽市', '内蒙古自治区通辽市', '028000', '', 'tls', 'T', 0);
INSERT INTO `tp_city` VALUES (1595, 1594, 0, 3, 0, '科尔沁区', '内蒙古自治区通辽市科尔沁区', '028000', '', 'keqq', 'K', 0);
INSERT INTO `tp_city` VALUES (1596, 1594, 0, 3, 0, '扎鲁特旗', '内蒙古自治区通辽市扎鲁特旗', '029100', '', 'zltq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1597, 1594, 0, 3, 0, '库伦旗', '内蒙古自治区通辽市库伦旗', '028200', '', 'klq', 'K', 0);
INSERT INTO `tp_city` VALUES (1598, 1594, 0, 3, 0, '奈曼旗', '内蒙古自治区通辽市奈曼旗', '028300', '', 'nmq', 'N', 0);
INSERT INTO `tp_city` VALUES (1599, 1594, 0, 3, 0, '科尔沁左翼后旗', '内蒙古自治区通辽市科尔沁左翼后旗', '028100', '', 'keqzyhq', 'K', 0);
INSERT INTO `tp_city` VALUES (1600, 1594, 0, 3, 0, '开鲁县', '内蒙古自治区通辽市开鲁县', '028400', '', 'klx', 'K', 0);
INSERT INTO `tp_city` VALUES (1601, 1594, 0, 3, 0, '科尔沁左翼中旗', '内蒙古自治区通辽市科尔沁左翼中旗', '029300', '', 'keqzyzq', 'K', 0);
INSERT INTO `tp_city` VALUES (1602, 1594, 0, 3, 0, '霍林郭勒市', '内蒙古自治区通辽市霍林郭勒市', '029200', '', 'hlgls', 'H', 0);
INSERT INTO `tp_city` VALUES (1603, 1594, 0, 3, 0, '其它区', '内蒙古自治区通辽市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1604, 1552, 0, 2, 0, '鄂尔多斯市', '内蒙古自治区鄂尔多斯市', '017004', '', 'eedss', 'E', 0);
INSERT INTO `tp_city` VALUES (1605, 1604, 0, 3, 0, '鄂托克旗', '内蒙古自治区鄂尔多斯市鄂托克旗', '016100', '', 'etkq', 'E', 0);
INSERT INTO `tp_city` VALUES (1606, 1604, 0, 3, 0, '杭锦旗', '内蒙古自治区鄂尔多斯市杭锦旗', '017400', '', 'hjq', 'H', 0);
INSERT INTO `tp_city` VALUES (1607, 1604, 0, 3, 0, '乌审旗', '内蒙古自治区鄂尔多斯市乌审旗', '017300', '', 'wsq', 'W', 0);
INSERT INTO `tp_city` VALUES (1608, 1604, 0, 3, 0, '伊金霍洛旗', '内蒙古自治区鄂尔多斯市伊金霍洛旗', '017200', '', 'yjhlq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1609, 1604, 0, 3, 0, '其它区', '内蒙古自治区鄂尔多斯市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1610, 1604, 0, 3, 0, '鄂托克前旗', '内蒙古自治区鄂尔多斯市鄂托克前旗', '016200', '', 'etkqq', 'E', 0);
INSERT INTO `tp_city` VALUES (1611, 1604, 0, 3, 0, '准格尔旗', '内蒙古自治区鄂尔多斯市准格尔旗', '017100', '', 'zgeq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1612, 1604, 0, 3, 0, '达拉特旗', '内蒙古自治区鄂尔多斯市达拉特旗', '014300', '', 'dltq', 'D', 0);
INSERT INTO `tp_city` VALUES (1613, 1604, 0, 3, 0, '东胜区', '内蒙古自治区鄂尔多斯市东胜区', '017000', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (1614, 1552, 0, 2, 0, '呼伦贝尔市', '内蒙古自治区呼伦贝尔市', '021008', '', 'hlbes', 'H', 0);
INSERT INTO `tp_city` VALUES (1615, 1614, 0, 3, 0, '满洲里市', '内蒙古自治区呼伦贝尔市满洲里市', '021400', '', 'mzls', 'M', 0);
INSERT INTO `tp_city` VALUES (1616, 1614, 0, 3, 0, '牙克石市', '内蒙古自治区呼伦贝尔市牙克石市', '162650', '', 'ykss', 'Y', 0);
INSERT INTO `tp_city` VALUES (1617, 1614, 0, 3, 0, '扎兰屯市', '内蒙古自治区呼伦贝尔市扎兰屯市', '162650', '', 'zlts', 'Z', 0);
INSERT INTO `tp_city` VALUES (1618, 1614, 0, 3, 0, '鄂伦春自治旗', '内蒙古自治区呼伦贝尔市鄂伦春自治旗', '165450', '', 'elczzq', 'E', 0);
INSERT INTO `tp_city` VALUES (1619, 1614, 0, 3, 0, '莫力达瓦达斡尔族自治旗', '内蒙古自治区呼伦贝尔市莫力达瓦达斡尔族自治旗', '162850', '', 'mldwdwezzz', 'M', 0);
INSERT INTO `tp_city` VALUES (1620, 1614, 0, 3, 0, '阿荣旗', '内蒙古自治区呼伦贝尔市阿荣旗', '162750', '', 'arq', 'A', 0);
INSERT INTO `tp_city` VALUES (1621, 1614, 0, 3, 0, '新巴尔虎右旗', '内蒙古自治区呼伦贝尔市新巴尔虎右旗', '021300', '', 'xbehyq', 'X', 0);
INSERT INTO `tp_city` VALUES (1622, 1614, 0, 3, 0, '新巴尔虎左旗', '内蒙古自治区呼伦贝尔市新巴尔虎左旗', '021200', '', 'xbehzq', 'X', 0);
INSERT INTO `tp_city` VALUES (1623, 1614, 0, 3, 0, '陈巴尔虎旗', '内蒙古自治区呼伦贝尔市陈巴尔虎旗', '021500', '', 'cbehq', 'C', 0);
INSERT INTO `tp_city` VALUES (1624, 1614, 0, 3, 0, '鄂温克族自治旗', '内蒙古自治区呼伦贝尔市鄂温克族自治旗', '021100', '', 'ewkzzzq', 'E', 0);
INSERT INTO `tp_city` VALUES (1625, 1614, 0, 3, 0, '扎赉诺尔区', '内蒙古自治区呼伦贝尔市扎赉诺尔区', '', '', 'zneq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1626, 1614, 0, 3, 0, '海拉尔区', '内蒙古自治区呼伦贝尔市海拉尔区', '021000', '', 'hleq', 'H', 0);
INSERT INTO `tp_city` VALUES (1627, 1614, 0, 3, 0, '额尔古纳市', '内蒙古自治区呼伦贝尔市额尔古纳市', '022250', '', 'eegns', 'E', 0);
INSERT INTO `tp_city` VALUES (1628, 1614, 0, 3, 0, '根河市', '内蒙古自治区呼伦贝尔市根河市', '022350', '', 'ghs', 'G', 0);
INSERT INTO `tp_city` VALUES (1629, 1614, 0, 3, 0, '其它区', '内蒙古自治区呼伦贝尔市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1630, 1552, 0, 2, 0, '乌兰察布市', '内蒙古自治区乌兰察布市', '012000', '', 'wlcbs', 'W', 0);
INSERT INTO `tp_city` VALUES (1631, 1630, 0, 3, 0, '集宁区', '内蒙古自治区乌兰察布市集宁区', '012000', '', 'jnq', 'J', 0);
INSERT INTO `tp_city` VALUES (1632, 1630, 0, 3, 0, '丰镇市', '内蒙古自治区乌兰察布市丰镇市', '012100', '', 'fzs', 'F', 0);
INSERT INTO `tp_city` VALUES (1633, 1630, 0, 3, 0, '其它区', '内蒙古自治区乌兰察布市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1634, 1630, 0, 3, 0, '凉城县', '内蒙古自治区乌兰察布市凉城县', '013750', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (1635, 1630, 0, 3, 0, '兴和县', '内蒙古自治区乌兰察布市兴和县', '013650', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (1636, 1630, 0, 3, 0, '察哈尔右翼中旗', '内蒙古自治区乌兰察布市察哈尔右翼中旗', '013550', '', 'cheyyzq', 'C', 0);
INSERT INTO `tp_city` VALUES (1637, 1630, 0, 3, 0, '察哈尔右翼前旗', '内蒙古自治区乌兰察布市察哈尔右翼前旗', '012200', '', 'cheyyqq', 'C', 0);
INSERT INTO `tp_city` VALUES (1638, 1630, 0, 3, 0, '卓资县', '内蒙古自治区乌兰察布市卓资县', '012300', '', 'zzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1639, 1630, 0, 3, 0, '商都县', '内蒙古自治区乌兰察布市商都县', '013400', '', 'sdx', 'S', 0);
INSERT INTO `tp_city` VALUES (1640, 1630, 0, 3, 0, '化德县', '内蒙古自治区乌兰察布市化德县', '013350', '', 'hdx', 'H', 0);
INSERT INTO `tp_city` VALUES (1641, 1630, 0, 3, 0, '察哈尔右翼后旗', '内蒙古自治区乌兰察布市察哈尔右翼后旗', '012400', '', 'cheyyhq', 'C', 0);
INSERT INTO `tp_city` VALUES (1642, 1630, 0, 3, 0, '四子王旗', '内蒙古自治区乌兰察布市四子王旗', '011800', '', 'szwq', 'S', 0);
INSERT INTO `tp_city` VALUES (1643, 1552, 0, 2, 0, '巴彦淖尔市', '内蒙古自治区巴彦淖尔市', '015001', '', 'bynes', 'B', 0);
INSERT INTO `tp_city` VALUES (1644, 1643, 0, 3, 0, '杭锦后旗', '内蒙古自治区巴彦淖尔市杭锦后旗', '015400', '', 'hjhq', 'H', 0);
INSERT INTO `tp_city` VALUES (1645, 1643, 0, 3, 0, '其它区', '内蒙古自治区巴彦淖尔市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1646, 1643, 0, 3, 0, '乌拉特中旗', '内蒙古自治区巴彦淖尔市乌拉特中旗', '015300', '', 'wltzq', 'W', 0);
INSERT INTO `tp_city` VALUES (1647, 1643, 0, 3, 0, '乌拉特后旗', '内蒙古自治区巴彦淖尔市乌拉特后旗', '015500', '', 'wlthq', 'W', 0);
INSERT INTO `tp_city` VALUES (1648, 1643, 0, 3, 0, '磴口县', '内蒙古自治区巴彦淖尔市磴口县', '015200', '', 'kx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1649, 1643, 0, 3, 0, '乌拉特前旗', '内蒙古自治区巴彦淖尔市乌拉特前旗', '015400', '', 'wltqq', 'W', 0);
INSERT INTO `tp_city` VALUES (1650, 1643, 0, 3, 0, '五原县', '内蒙古自治区巴彦淖尔市五原县', '015100', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (1651, 1643, 0, 3, 0, '临河区', '内蒙古自治区巴彦淖尔市临河区', '015001', '', 'lhq', 'L', 0);
INSERT INTO `tp_city` VALUES (1652, 1552, 0, 2, 0, '锡林郭勒盟', '内蒙古自治区锡林郭勒盟', '026021', '', 'xlglm', 'X', 0);
INSERT INTO `tp_city` VALUES (1653, 1652, 0, 3, 0, '锡林浩特市', '内蒙古自治区锡林郭勒盟锡林浩特市', '026000', '', 'xlhts', 'X', 0);
INSERT INTO `tp_city` VALUES (1654, 1652, 0, 3, 0, '二连浩特市', '内蒙古自治区锡林郭勒盟二连浩特市', '011100', '', 'elhts', 'E', 0);
INSERT INTO `tp_city` VALUES (1655, 1652, 0, 3, 0, '其它区', '内蒙古自治区锡林郭勒盟其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1656, 1652, 0, 3, 0, '正镶白旗', '内蒙古自治区锡林郭勒盟正镶白旗', '013800', '', 'zxbq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1657, 1652, 0, 3, 0, '镶黄旗', '内蒙古自治区锡林郭勒盟镶黄旗', '013250', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (1658, 1652, 0, 3, 0, '多伦县', '内蒙古自治区锡林郭勒盟多伦县', '027300', '', 'dlx', 'D', 0);
INSERT INTO `tp_city` VALUES (1659, 1652, 0, 3, 0, '正蓝旗', '内蒙古自治区锡林郭勒盟正蓝旗', '027200', '', 'zlq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1660, 1652, 0, 3, 0, '苏尼特右旗', '内蒙古自治区锡林郭勒盟苏尼特右旗', '011200', '', 'sntyq', 'S', 0);
INSERT INTO `tp_city` VALUES (1661, 1652, 0, 3, 0, '东乌珠穆沁旗', '内蒙古自治区锡林郭勒盟东乌珠穆沁旗', '026300', '', 'dwzmqq', 'D', 0);
INSERT INTO `tp_city` VALUES (1662, 1652, 0, 3, 0, '西乌珠穆沁旗', '内蒙古自治区锡林郭勒盟西乌珠穆沁旗', '026200', '', 'xwzmqq', 'X', 0);
INSERT INTO `tp_city` VALUES (1663, 1652, 0, 3, 0, '太仆寺旗', '内蒙古自治区锡林郭勒盟太仆寺旗', '027000', '', 'tpsq', 'T', 0);
INSERT INTO `tp_city` VALUES (1664, 1652, 0, 3, 0, '阿巴嘎旗', '内蒙古自治区锡林郭勒盟阿巴嘎旗', '011400', '', 'abgq', 'A', 0);
INSERT INTO `tp_city` VALUES (1665, 1652, 0, 3, 0, '苏尼特左旗', '内蒙古自治区锡林郭勒盟苏尼特左旗', '011300', '', 'sntzq', 'S', 0);
INSERT INTO `tp_city` VALUES (1666, 1552, 0, 2, 0, '兴安盟', '内蒙古自治区兴安盟', '137401', '', 'xam', 'X', 0);
INSERT INTO `tp_city` VALUES (1667, 1666, 0, 3, 0, '突泉县', '内蒙古自治区兴安盟突泉县', '137500', '', 'tqx', 'T', 0);
INSERT INTO `tp_city` VALUES (1668, 1666, 0, 3, 0, '其它区', '内蒙古自治区兴安盟其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1669, 1666, 0, 3, 0, '阿尔山市', '内蒙古自治区兴安盟阿尔山市', '137800', '', 'aess', 'A', 0);
INSERT INTO `tp_city` VALUES (1670, 1666, 0, 3, 0, '乌兰浩特市', '内蒙古自治区兴安盟乌兰浩特市', '137400', '', 'wlhts', 'W', 0);
INSERT INTO `tp_city` VALUES (1671, 1666, 0, 3, 0, '扎赉特旗', '内蒙古自治区兴安盟扎赉特旗', '137600', '', 'ztq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1672, 1666, 0, 3, 0, '科尔沁右翼中旗', '内蒙古自治区兴安盟科尔沁右翼中旗', '029400', '', 'keqyyzq', 'K', 0);
INSERT INTO `tp_city` VALUES (1673, 1666, 0, 3, 0, '科尔沁右翼前旗', '内蒙古自治区兴安盟科尔沁右翼前旗', '137400', '', 'keqyyqq', 'K', 0);
INSERT INTO `tp_city` VALUES (1674, 1552, 0, 2, 0, '阿拉善盟', '内蒙古自治区阿拉善盟', '750306', '', 'alsm', 'A', 0);
INSERT INTO `tp_city` VALUES (1675, 1674, 0, 3, 0, '阿拉善左旗', '内蒙古自治区阿拉善盟阿拉善左旗', '750300', '', 'alszq', 'A', 0);
INSERT INTO `tp_city` VALUES (1676, 1674, 0, 3, 0, '阿拉善右旗', '内蒙古自治区阿拉善盟阿拉善右旗', '737300', '', 'alsyq', 'A', 0);
INSERT INTO `tp_city` VALUES (1677, 1674, 0, 3, 0, '额济纳旗', '内蒙古自治区阿拉善盟额济纳旗', '735400', '', 'ejnq', 'E', 0);
INSERT INTO `tp_city` VALUES (1678, 1674, 0, 3, 0, '其它区', '内蒙古自治区阿拉善盟其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1679, 0, 0, 1, 0, '台湾', '台湾', '', '', 'tw', 'T', 0);
INSERT INTO `tp_city` VALUES (1680, 1679, 0, 2, 0, '连江县', '台湾连江县', '', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (1681, 1680, 0, 3, 0, '莒光乡', '台湾连江县莒光乡', '', '', 'gx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1682, 1680, 0, 3, 0, '北竿乡', '台湾连江县北竿乡', '', '', 'bgx', 'B', 0);
INSERT INTO `tp_city` VALUES (1683, 1680, 0, 3, 0, '南竿乡', '台湾连江县南竿乡', '', '', 'ngx', 'N', 0);
INSERT INTO `tp_city` VALUES (1684, 1680, 0, 3, 0, '东引乡', '台湾连江县东引乡', '', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (1685, 1679, 0, 2, 0, '新竹市', '台湾新竹市', '', '', 'xzs', 'X', 0);
INSERT INTO `tp_city` VALUES (1686, 1685, 0, 3, 0, '其它区', '台湾新竹市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1687, 1685, 0, 3, 0, '北区', '台湾新竹市北区', '', '', 'bq', 'B', 0);
INSERT INTO `tp_city` VALUES (1688, 1685, 0, 3, 0, '香山区', '台湾新竹市香山区', '', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (1689, 1685, 0, 3, 0, '东区', '台湾新竹市东区', '', '', 'dq', 'D', 0);
INSERT INTO `tp_city` VALUES (1690, 1679, 0, 2, 0, '嘉义市', '台湾嘉义市', '', '', 'jys', 'J', 0);
INSERT INTO `tp_city` VALUES (1691, 1690, 0, 3, 0, '东区', '台湾嘉义市东区', '', '', 'dq', 'D', 0);
INSERT INTO `tp_city` VALUES (1692, 1690, 0, 3, 0, '西区', '台湾嘉义市西区', '', '', 'xq', 'X', 0);
INSERT INTO `tp_city` VALUES (1693, 1690, 0, 3, 0, '其它区', '台湾嘉义市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1694, 1679, 0, 2, 0, '基隆市', '台湾基隆市', '', '', 'jls', 'J', 0);
INSERT INTO `tp_city` VALUES (1695, 1694, 0, 3, 0, '其它区', '台湾基隆市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1696, 1694, 0, 3, 0, '安乐区', '台湾基隆市安乐区', '204', '', 'alq', 'A', 0);
INSERT INTO `tp_city` VALUES (1697, 1694, 0, 3, 0, '中山区', '台湾基隆市中山区', '203', '', 'zsq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1698, 1694, 0, 3, 0, '七堵区', '台湾基隆市七堵区', '206', '', 'qdq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1699, 1694, 0, 3, 0, '暖暖区', '台湾基隆市暖暖区', '205', '', 'nnq', 'N', 0);
INSERT INTO `tp_city` VALUES (1700, 1694, 0, 3, 0, '仁爱区', '台湾基隆市仁爱区', '200', '', 'raq', 'R', 0);
INSERT INTO `tp_city` VALUES (1701, 1694, 0, 3, 0, '信义区', '台湾基隆市信义区', '201', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (1702, 1694, 0, 3, 0, '中正区', '台湾基隆市中正区', '202', '', 'zzq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1703, 1679, 0, 2, 0, '新北市', '台湾新北市', '', '', 'xbs', 'X', 0);
INSERT INTO `tp_city` VALUES (1704, 1703, 0, 3, 0, '万里区', '台湾新北市万里区', '', '', 'wlq', 'W', 0);
INSERT INTO `tp_city` VALUES (1705, 1703, 0, 3, 0, '金山区', '台湾新北市金山区', '', '', 'jsq', 'J', 0);
INSERT INTO `tp_city` VALUES (1706, 1703, 0, 3, 0, '板桥区', '台湾新北市板桥区', '', '', 'bqq', 'B', 0);
INSERT INTO `tp_city` VALUES (1707, 1703, 0, 3, 0, '汐止区', '台湾新北市汐止区', '', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (1708, 1703, 0, 3, 0, '深坑区', '台湾新北市深坑区', '', '', 'skq', 'S', 0);
INSERT INTO `tp_city` VALUES (1709, 1703, 0, 3, 0, '石碇区', '台湾新北市石碇区', '', '', 'sq', 'S', 0);
INSERT INTO `tp_city` VALUES (1710, 1703, 0, 3, 0, '树林区', '台湾新北市树林区', '', '', 'slq', 'S', 0);
INSERT INTO `tp_city` VALUES (1711, 1703, 0, 3, 0, '三峡区', '台湾新北市三峡区', '', '', 'sxq', 'S', 0);
INSERT INTO `tp_city` VALUES (1712, 1703, 0, 3, 0, '土城区', '台湾新北市土城区', '', '', 'tcq', 'T', 0);
INSERT INTO `tp_city` VALUES (1713, 1703, 0, 3, 0, '中和区', '台湾新北市中和区', '', '', 'zhq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1714, 1703, 0, 3, 0, '泰山区', '台湾新北市泰山区', '', '', 'tsq', 'T', 0);
INSERT INTO `tp_city` VALUES (1715, 1703, 0, 3, 0, '新庄区', '台湾新北市新庄区', '', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (1716, 1703, 0, 3, 0, '三重区', '台湾新北市三重区', '', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (1717, 1703, 0, 3, 0, '莺歌区', '台湾新北市莺歌区', '', '', 'gq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1718, 1703, 0, 3, 0, '贡寮区', '台湾新北市贡寮区', '', '', 'gq', 'G', 0);
INSERT INTO `tp_city` VALUES (1719, 1703, 0, 3, 0, '双溪区', '台湾新北市双溪区', '', '', 'sxq', 'S', 0);
INSERT INTO `tp_city` VALUES (1720, 1703, 0, 3, 0, '平溪区', '台湾新北市平溪区', '', '', 'pxq', 'P', 0);
INSERT INTO `tp_city` VALUES (1721, 1703, 0, 3, 0, '瑞芳区', '台湾新北市瑞芳区', '', '', 'rfq', 'R', 0);
INSERT INTO `tp_city` VALUES (1722, 1703, 0, 3, 0, '永和区', '台湾新北市永和区', '', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1723, 1703, 0, 3, 0, '乌来区', '台湾新北市乌来区', '', '', 'wlq', 'W', 0);
INSERT INTO `tp_city` VALUES (1724, 1703, 0, 3, 0, '坪林区', '台湾新北市坪林区', '', '', 'plq', 'P', 0);
INSERT INTO `tp_city` VALUES (1725, 1703, 0, 3, 0, '新店区', '台湾新北市新店区', '', '', 'xdq', 'X', 0);
INSERT INTO `tp_city` VALUES (1726, 1703, 0, 3, 0, '五股区', '台湾新北市五股区', '', '', 'wgq', 'W', 0);
INSERT INTO `tp_city` VALUES (1727, 1703, 0, 3, 0, '八里区', '台湾新北市八里区', '', '', 'blq', 'B', 0);
INSERT INTO `tp_city` VALUES (1728, 1703, 0, 3, 0, '林口区', '台湾新北市林口区', '', '', 'lkq', 'L', 0);
INSERT INTO `tp_city` VALUES (1729, 1703, 0, 3, 0, '芦洲区', '台湾新北市芦洲区', '', '', 'lzq', 'L', 0);
INSERT INTO `tp_city` VALUES (1730, 1703, 0, 3, 0, '石门区', '台湾新北市石门区', '', '', 'smq', 'S', 0);
INSERT INTO `tp_city` VALUES (1731, 1703, 0, 3, 0, '淡水区', '台湾新北市淡水区', '', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (1732, 1703, 0, 3, 0, '三芝区', '台湾新北市三芝区', '', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (1733, 1679, 0, 2, 0, '新竹县', '台湾新竹县', '', '', 'xzx', 'X', 0);
INSERT INTO `tp_city` VALUES (1734, 1733, 0, 3, 0, '五峰乡', '台湾新竹县五峰乡', '', '', 'wfx', 'W', 0);
INSERT INTO `tp_city` VALUES (1735, 1733, 0, 3, 0, '横山乡', '台湾新竹县横山乡', '', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (1736, 1733, 0, 3, 0, '宝山乡', '台湾新竹县宝山乡', '', '', 'bsx', 'B', 0);
INSERT INTO `tp_city` VALUES (1737, 1733, 0, 3, 0, '竹东镇', '台湾新竹县竹东镇', '', '', 'zdz', 'Z', 0);
INSERT INTO `tp_city` VALUES (1738, 1733, 0, 3, 0, '峨眉乡', '台湾新竹县峨眉乡', '', '', 'emx', 'E', 0);
INSERT INTO `tp_city` VALUES (1739, 1733, 0, 3, 0, '尖石乡', '台湾新竹县尖石乡', '', '', 'jsx', 'J', 0);
INSERT INTO `tp_city` VALUES (1740, 1733, 0, 3, 0, '北埔乡', '台湾新竹县北埔乡', '', '', 'bpx', 'B', 0);
INSERT INTO `tp_city` VALUES (1741, 1733, 0, 3, 0, '竹北市', '台湾新竹县竹北市', '', '', 'zbs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1742, 1733, 0, 3, 0, '湖口乡', '台湾新竹县湖口乡', '', '', 'hkx', 'H', 0);
INSERT INTO `tp_city` VALUES (1743, 1733, 0, 3, 0, '关西镇', '台湾新竹县关西镇', '', '', 'gxz', 'G', 0);
INSERT INTO `tp_city` VALUES (1744, 1733, 0, 3, 0, '芎林乡', '台湾新竹县芎林乡', '', '', 'lx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1745, 1733, 0, 3, 0, '新丰乡', '台湾新竹县新丰乡', '', '', 'xfx', 'X', 0);
INSERT INTO `tp_city` VALUES (1746, 1733, 0, 3, 0, '新埔镇', '台湾新竹县新埔镇', '', '', 'xpz', 'X', 0);
INSERT INTO `tp_city` VALUES (1747, 1679, 0, 2, 0, '桃园县', '台湾桃园县', '', '', 'tyx', 'T', 0);
INSERT INTO `tp_city` VALUES (1748, 1747, 0, 3, 0, '桃园市', '台湾桃园县桃园市', '', '', 'tys', 'T', 0);
INSERT INTO `tp_city` VALUES (1749, 1747, 0, 3, 0, '龟山乡', '台湾桃园县龟山乡', '', '', 'gsx', 'G', 0);
INSERT INTO `tp_city` VALUES (1750, 1747, 0, 3, 0, '八德市', '台湾桃园县八德市', '', '', 'bds', 'B', 0);
INSERT INTO `tp_city` VALUES (1751, 1747, 0, 3, 0, '大溪镇', '台湾桃园县大溪镇', '', '', 'dxz', 'D', 0);
INSERT INTO `tp_city` VALUES (1752, 1747, 0, 3, 0, '龙潭乡', '台湾桃园县龙潭乡', '', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (1753, 1747, 0, 3, 0, '杨梅市', '台湾桃园县杨梅市', '', '', 'yms', 'Y', 0);
INSERT INTO `tp_city` VALUES (1754, 1747, 0, 3, 0, '新屋乡', '台湾桃园县新屋乡', '', '', 'xwx', 'X', 0);
INSERT INTO `tp_city` VALUES (1755, 1747, 0, 3, 0, '观音乡', '台湾桃园县观音乡', '', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (1756, 1747, 0, 3, 0, '中坜市', '台湾桃园县中坜市', '', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1757, 1747, 0, 3, 0, '平镇市', '台湾桃园县平镇市', '', '', 'pzs', 'P', 0);
INSERT INTO `tp_city` VALUES (1758, 1747, 0, 3, 0, '复兴乡', '台湾桃园县复兴乡', '', '', 'fxx', 'F', 0);
INSERT INTO `tp_city` VALUES (1759, 1747, 0, 3, 0, '大园乡', '台湾桃园县大园乡', '', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (1760, 1747, 0, 3, 0, '芦竹乡', '台湾桃园县芦竹乡', '', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (1761, 1679, 0, 2, 0, '宜兰县', '台湾宜兰县', '', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1762, 1761, 0, 3, 0, '壮围乡', '台湾宜兰县壮围乡', '', '', 'zwx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1763, 1761, 0, 3, 0, '礁溪乡', '台湾宜兰县礁溪乡', '', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (1764, 1761, 0, 3, 0, '罗东镇', '台湾宜兰县罗东镇', '', '', 'ldz', 'L', 0);
INSERT INTO `tp_city` VALUES (1765, 1761, 0, 3, 0, '员山乡', '台湾宜兰县员山乡', '', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1766, 1761, 0, 3, 0, '大同乡', '台湾宜兰县大同乡', '', '', 'dtx', 'D', 0);
INSERT INTO `tp_city` VALUES (1767, 1761, 0, 3, 0, '三星乡', '台湾宜兰县三星乡', '', '', 'sxx', 'S', 0);
INSERT INTO `tp_city` VALUES (1768, 1761, 0, 3, 0, '冬山乡', '台湾宜兰县冬山乡', '', '', 'dsx', 'D', 0);
INSERT INTO `tp_city` VALUES (1769, 1761, 0, 3, 0, '五结乡', '台湾宜兰县五结乡', '', '', 'wjx', 'W', 0);
INSERT INTO `tp_city` VALUES (1770, 1761, 0, 3, 0, '南澳乡', '台湾宜兰县南澳乡', '', '', 'nax', 'N', 0);
INSERT INTO `tp_city` VALUES (1771, 1761, 0, 3, 0, '苏澳镇', '台湾宜兰县苏澳镇', '', '', 'saz', 'S', 0);
INSERT INTO `tp_city` VALUES (1772, 1761, 0, 3, 0, '钓鱼台', '台湾宜兰县钓鱼台', '', '', 'dyt', 'D', 0);
INSERT INTO `tp_city` VALUES (1773, 1761, 0, 3, 0, '宜兰市', '台湾宜兰县宜兰市', '', '', 'yls', 'Y', 0);
INSERT INTO `tp_city` VALUES (1774, 1761, 0, 3, 0, '头城镇', '台湾宜兰县头城镇', '', '', 'tcz', 'T', 0);
INSERT INTO `tp_city` VALUES (1775, 1679, 0, 2, 0, '苗栗县', '台湾苗栗县', '', '', 'mlx', 'M', 0);
INSERT INTO `tp_city` VALUES (1776, 1775, 0, 3, 0, '苑里镇', '台湾苗栗县苑里镇', '', '', 'ylz', 'Y', 0);
INSERT INTO `tp_city` VALUES (1777, 1775, 0, 3, 0, '苗栗市', '台湾苗栗县苗栗市', '', '', 'mls', 'M', 0);
INSERT INTO `tp_city` VALUES (1778, 1775, 0, 3, 0, '后龙镇', '台湾苗栗县后龙镇', '', '', 'hlz', 'H', 0);
INSERT INTO `tp_city` VALUES (1779, 1775, 0, 3, 0, '通霄镇', '台湾苗栗县通霄镇', '', '', 'txz', 'T', 0);
INSERT INTO `tp_city` VALUES (1780, 1775, 0, 3, 0, '南庄乡', '台湾苗栗县南庄乡', '', '', 'nzx', 'N', 0);
INSERT INTO `tp_city` VALUES (1781, 1775, 0, 3, 0, '狮潭乡', '台湾苗栗县狮潭乡', '', '', 'stx', 'S', 0);
INSERT INTO `tp_city` VALUES (1782, 1775, 0, 3, 0, '头份镇', '台湾苗栗县头份镇', '', '', 'tfz', 'T', 0);
INSERT INTO `tp_city` VALUES (1783, 1775, 0, 3, 0, '三湾乡', '台湾苗栗县三湾乡', '', '', 'swx', 'S', 0);
INSERT INTO `tp_city` VALUES (1784, 1775, 0, 3, 0, '三义乡', '台湾苗栗县三义乡', '', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (1785, 1775, 0, 3, 0, '西湖乡', '台湾苗栗县西湖乡', '', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (1786, 1775, 0, 3, 0, '泰安乡', '台湾苗栗县泰安乡', '', '', 'tax', 'T', 0);
INSERT INTO `tp_city` VALUES (1787, 1775, 0, 3, 0, '铜锣乡', '台湾苗栗县铜锣乡', '', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (1788, 1775, 0, 3, 0, '公馆乡', '台湾苗栗县公馆乡', '', '', 'ggx', 'G', 0);
INSERT INTO `tp_city` VALUES (1789, 1775, 0, 3, 0, '大湖乡', '台湾苗栗县大湖乡', '', '', 'dhx', 'D', 0);
INSERT INTO `tp_city` VALUES (1790, 1775, 0, 3, 0, '造桥乡', '台湾苗栗县造桥乡', '', '', 'zqx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1791, 1775, 0, 3, 0, '头屋乡', '台湾苗栗县头屋乡', '', '', 'twx', 'T', 0);
INSERT INTO `tp_city` VALUES (1792, 1775, 0, 3, 0, '卓兰镇', '台湾苗栗县卓兰镇', '', '', 'zlz', 'Z', 0);
INSERT INTO `tp_city` VALUES (1793, 1775, 0, 3, 0, '竹南镇', '台湾苗栗县竹南镇', '', '', 'znz', 'Z', 0);
INSERT INTO `tp_city` VALUES (1794, 1679, 0, 2, 0, '嘉义县', '台湾嘉义县', '', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (1795, 1794, 0, 3, 0, '梅山乡', '台湾嘉义县梅山乡', '', '', 'msx', 'M', 0);
INSERT INTO `tp_city` VALUES (1796, 1794, 0, 3, 0, '竹崎乡', '台湾嘉义县竹崎乡', '', '', 'zqx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1797, 1794, 0, 3, 0, '阿里山乡', '台湾嘉义县阿里山乡', '', '', 'alsx', 'A', 0);
INSERT INTO `tp_city` VALUES (1798, 1794, 0, 3, 0, '中埔乡', '台湾嘉义县中埔乡', '', '', 'zpx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1799, 1794, 0, 3, 0, '大埔乡', '台湾嘉义县大埔乡', '', '', 'dpx', 'D', 0);
INSERT INTO `tp_city` VALUES (1800, 1794, 0, 3, 0, '水上乡', '台湾嘉义县水上乡', '', '', 'ssx', 'S', 0);
INSERT INTO `tp_city` VALUES (1801, 1794, 0, 3, 0, '鹿草乡', '台湾嘉义县鹿草乡', '', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (1802, 1794, 0, 3, 0, '太保市', '台湾嘉义县太保市', '', '', 'tbs', 'T', 0);
INSERT INTO `tp_city` VALUES (1803, 1794, 0, 3, 0, '朴子市', '台湾嘉义县朴子市', '', '', 'pzs', 'P', 0);
INSERT INTO `tp_city` VALUES (1804, 1794, 0, 3, 0, '东石乡', '台湾嘉义县东石乡', '', '', 'dsx', 'D', 0);
INSERT INTO `tp_city` VALUES (1805, 1794, 0, 3, 0, '六脚乡', '台湾嘉义县六脚乡', '', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (1806, 1794, 0, 3, 0, '新港乡', '台湾嘉义县新港乡', '', '', 'xgx', 'X', 0);
INSERT INTO `tp_city` VALUES (1807, 1794, 0, 3, 0, '民雄乡', '台湾嘉义县民雄乡', '', '', 'mxx', 'M', 0);
INSERT INTO `tp_city` VALUES (1808, 1794, 0, 3, 0, '大林镇', '台湾嘉义县大林镇', '', '', 'dlz', 'D', 0);
INSERT INTO `tp_city` VALUES (1809, 1794, 0, 3, 0, '溪口乡', '台湾嘉义县溪口乡', '', '', 'xkx', 'X', 0);
INSERT INTO `tp_city` VALUES (1810, 1794, 0, 3, 0, '义竹乡', '台湾嘉义县义竹乡', '', '', 'yzx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1811, 1794, 0, 3, 0, '番路乡', '台湾嘉义县番路乡', '', '', 'flx', 'F', 0);
INSERT INTO `tp_city` VALUES (1812, 1794, 0, 3, 0, '布袋镇', '台湾嘉义县布袋镇', '', '', 'bdz', 'B', 0);
INSERT INTO `tp_city` VALUES (1813, 1679, 0, 2, 0, '彰化县', '台湾彰化县', '', '', 'zhx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1814, 1813, 0, 3, 0, '二水乡', '台湾彰化县二水乡', '', '', 'esx', 'E', 0);
INSERT INTO `tp_city` VALUES (1815, 1813, 0, 3, 0, '埤头乡', '台湾彰化县埤头乡', '', '', 'tx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1816, 1813, 0, 3, 0, '溪州乡', '台湾彰化县溪州乡', '', '', 'xzx', 'X', 0);
INSERT INTO `tp_city` VALUES (1817, 1813, 0, 3, 0, '北斗镇', '台湾彰化县北斗镇', '', '', 'bdz', 'B', 0);
INSERT INTO `tp_city` VALUES (1818, 1813, 0, 3, 0, '田尾乡', '台湾彰化县田尾乡', '', '', 'twx', 'T', 0);
INSERT INTO `tp_city` VALUES (1819, 1813, 0, 3, 0, '大城乡', '台湾彰化县大城乡', '', '', 'dcx', 'D', 0);
INSERT INTO `tp_city` VALUES (1820, 1813, 0, 3, 0, '芳苑乡', '台湾彰化县芳苑乡', '', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (1821, 1813, 0, 3, 0, '竹塘乡', '台湾彰化县竹塘乡', '', '', 'ztx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1822, 1813, 0, 3, 0, '二林镇', '台湾彰化县二林镇', '', '', 'elz', 'E', 0);
INSERT INTO `tp_city` VALUES (1823, 1813, 0, 3, 0, '大村乡', '台湾彰化县大村乡', '', '', 'dcx', 'D', 0);
INSERT INTO `tp_city` VALUES (1824, 1813, 0, 3, 0, '溪湖镇', '台湾彰化县溪湖镇', '', '', 'xhz', 'X', 0);
INSERT INTO `tp_city` VALUES (1825, 1813, 0, 3, 0, '田中镇', '台湾彰化县田中镇', '', '', 'tzz', 'T', 0);
INSERT INTO `tp_city` VALUES (1826, 1813, 0, 3, 0, '埔盐乡', '台湾彰化县埔盐乡', '', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (1827, 1813, 0, 3, 0, '社头乡', '台湾彰化县社头乡', '', '', 'stx', 'S', 0);
INSERT INTO `tp_city` VALUES (1828, 1813, 0, 3, 0, '员林镇', '台湾彰化县员林镇', '', '', 'ylz', 'Y', 0);
INSERT INTO `tp_city` VALUES (1829, 1813, 0, 3, 0, '埔心乡', '台湾彰化县埔心乡', '', '', 'pxx', 'P', 0);
INSERT INTO `tp_city` VALUES (1830, 1813, 0, 3, 0, '永靖乡', '台湾彰化县永靖乡', '', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1831, 1813, 0, 3, 0, '线西乡', '台湾彰化县线西乡', '', '', 'xxx', 'X', 0);
INSERT INTO `tp_city` VALUES (1832, 1813, 0, 3, 0, '福兴乡', '台湾彰化县福兴乡', '', '', 'fxx', 'F', 0);
INSERT INTO `tp_city` VALUES (1833, 1813, 0, 3, 0, '伸港乡', '台湾彰化县伸港乡', '', '', 'sgx', 'S', 0);
INSERT INTO `tp_city` VALUES (1834, 1813, 0, 3, 0, '和美镇', '台湾彰化县和美镇', '', '', 'hmz', 'H', 0);
INSERT INTO `tp_city` VALUES (1835, 1813, 0, 3, 0, '花坛乡', '台湾彰化县花坛乡', '', '', 'htx', 'H', 0);
INSERT INTO `tp_city` VALUES (1836, 1813, 0, 3, 0, '芬园乡', '台湾彰化县芬园乡', '', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (1837, 1813, 0, 3, 0, '鹿港镇', '台湾彰化县鹿港镇', '', '', 'lgz', 'L', 0);
INSERT INTO `tp_city` VALUES (1838, 1813, 0, 3, 0, '秀水乡', '台湾彰化县秀水乡', '', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (1839, 1813, 0, 3, 0, '彰化市', '台湾彰化县彰化市', '', '', 'zhs', 'Z', 0);
INSERT INTO `tp_city` VALUES (1840, 1679, 0, 2, 0, '云林县', '台湾云林县', '', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1841, 1840, 0, 3, 0, '麦寮乡', '台湾云林县麦寮乡', '', '', 'mx', 'M', 0);
INSERT INTO `tp_city` VALUES (1842, 1840, 0, 3, 0, '仑背乡', '台湾云林县仑背乡', '', '', 'lbx', 'L', 0);
INSERT INTO `tp_city` VALUES (1843, 1840, 0, 3, 0, '林内乡', '台湾云林县林内乡', '', '', 'lnx', 'L', 0);
INSERT INTO `tp_city` VALUES (1844, 1840, 0, 3, 0, '斗六市', '台湾云林县斗六市', '', '', 'dls', 'D', 0);
INSERT INTO `tp_city` VALUES (1845, 1840, 0, 3, 0, '莿桐乡', '台湾云林县莿桐乡', '', '', 'tx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1846, 1840, 0, 3, 0, '古坑乡', '台湾云林县古坑乡', '', '', 'gkx', 'G', 0);
INSERT INTO `tp_city` VALUES (1847, 1840, 0, 3, 0, '二仑乡', '台湾云林县二仑乡', '', '', 'elx', 'E', 0);
INSERT INTO `tp_city` VALUES (1848, 1840, 0, 3, 0, '西螺镇', '台湾云林县西螺镇', '', '', 'xlz', 'X', 0);
INSERT INTO `tp_city` VALUES (1849, 1840, 0, 3, 0, '水林乡', '台湾云林县水林乡', '', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (1850, 1840, 0, 3, 0, '北港镇', '台湾云林县北港镇', '', '', 'bgz', 'B', 0);
INSERT INTO `tp_city` VALUES (1851, 1840, 0, 3, 0, '四湖乡', '台湾云林县四湖乡', '', '', 'shx', 'S', 0);
INSERT INTO `tp_city` VALUES (1852, 1840, 0, 3, 0, '口湖乡', '台湾云林县口湖乡', '', '', 'khx', 'K', 0);
INSERT INTO `tp_city` VALUES (1853, 1840, 0, 3, 0, '元长乡', '台湾云林县元长乡', '', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1854, 1840, 0, 3, 0, '东势乡', '台湾云林县东势乡', '', '', 'dsx', 'D', 0);
INSERT INTO `tp_city` VALUES (1855, 1840, 0, 3, 0, '台西乡', '台湾云林县台西乡', '', '', 'txx', 'T', 0);
INSERT INTO `tp_city` VALUES (1856, 1840, 0, 3, 0, '土库镇', '台湾云林县土库镇', '', '', 'tkz', 'T', 0);
INSERT INTO `tp_city` VALUES (1857, 1840, 0, 3, 0, '褒忠乡', '台湾云林县褒忠乡', '', '', 'bzx', 'B', 0);
INSERT INTO `tp_city` VALUES (1858, 1840, 0, 3, 0, '大埤乡', '台湾云林县大埤乡', '', '', 'dx', 'D', 0);
INSERT INTO `tp_city` VALUES (1859, 1840, 0, 3, 0, '虎尾镇', '台湾云林县虎尾镇', '', '', 'hwz', 'H', 0);
INSERT INTO `tp_city` VALUES (1860, 1840, 0, 3, 0, '斗南镇', '台湾云林县斗南镇', '', '', 'dnz', 'D', 0);
INSERT INTO `tp_city` VALUES (1861, 1679, 0, 2, 0, '屏东县', '台湾屏东县', '', '', 'pdx', 'P', 0);
INSERT INTO `tp_city` VALUES (1862, 1861, 0, 3, 0, '雾台乡', '台湾屏东县雾台乡', '', '', 'wtx', 'W', 0);
INSERT INTO `tp_city` VALUES (1863, 1861, 0, 3, 0, '玛家乡', '台湾屏东县玛家乡', '', '', 'mjx', 'M', 0);
INSERT INTO `tp_city` VALUES (1864, 1861, 0, 3, 0, '九如乡', '台湾屏东县九如乡', '', '', 'jrx', 'J', 0);
INSERT INTO `tp_city` VALUES (1865, 1861, 0, 3, 0, '里港乡', '台湾屏东县里港乡', '', '', 'lgx', 'L', 0);
INSERT INTO `tp_city` VALUES (1866, 1861, 0, 3, 0, '屏东市', '台湾屏东县屏东市', '', '', 'pds', 'P', 0);
INSERT INTO `tp_city` VALUES (1867, 1861, 0, 3, 0, '三地门乡', '台湾屏东县三地门乡', '', '', 'sdmx', 'S', 0);
INSERT INTO `tp_city` VALUES (1868, 1861, 0, 3, 0, '竹田乡', '台湾屏东县竹田乡', '', '', 'ztx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1869, 1861, 0, 3, 0, '内埔乡', '台湾屏东县内埔乡', '', '', 'npx', 'N', 0);
INSERT INTO `tp_city` VALUES (1870, 1861, 0, 3, 0, '万丹乡', '台湾屏东县万丹乡', '', '', 'wdx', 'W', 0);
INSERT INTO `tp_city` VALUES (1871, 1861, 0, 3, 0, '潮州镇', '台湾屏东县潮州镇', '', '', 'czz', 'C', 0);
INSERT INTO `tp_city` VALUES (1872, 1861, 0, 3, 0, '高树乡', '台湾屏东县高树乡', '', '', 'gsx', 'G', 0);
INSERT INTO `tp_city` VALUES (1873, 1861, 0, 3, 0, '盐埔乡', '台湾屏东县盐埔乡', '', '', 'ypx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1874, 1861, 0, 3, 0, '长治乡', '台湾屏东县长治乡', '', '', 'czx', 'C', 0);
INSERT INTO `tp_city` VALUES (1875, 1861, 0, 3, 0, '麟洛乡', '台湾屏东县麟洛乡', '', '', 'lx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1876, 1861, 0, 3, 0, '琉球乡', '台湾屏东县琉球乡', '', '', 'lqx', 'L', 0);
INSERT INTO `tp_city` VALUES (1877, 1861, 0, 3, 0, '佳冬乡', '台湾屏东县佳冬乡', '', '', 'jdx', 'J', 0);
INSERT INTO `tp_city` VALUES (1878, 1861, 0, 3, 0, '新园乡', '台湾屏东县新园乡', '', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (1879, 1861, 0, 3, 0, '枋寮乡', '台湾屏东县枋寮乡', '', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (1880, 1861, 0, 3, 0, '枋山乡', '台湾屏东县枋山乡', '', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1881, 1861, 0, 3, 0, '春日乡', '台湾屏东县春日乡', '', '', 'crx', 'C', 0);
INSERT INTO `tp_city` VALUES (1882, 1861, 0, 3, 0, '狮子乡', '台湾屏东县狮子乡', '', '', 'szx', 'S', 0);
INSERT INTO `tp_city` VALUES (1883, 1861, 0, 3, 0, '车城乡', '台湾屏东县车城乡', '', '', 'ccx', 'C', 0);
INSERT INTO `tp_city` VALUES (1884, 1861, 0, 3, 0, '泰武乡', '台湾屏东县泰武乡', '', '', 'twx', 'T', 0);
INSERT INTO `tp_city` VALUES (1885, 1861, 0, 3, 0, '来义乡', '台湾屏东县来义乡', '', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (1886, 1861, 0, 3, 0, '万峦乡', '台湾屏东县万峦乡', '', '', 'wlx', 'W', 0);
INSERT INTO `tp_city` VALUES (1887, 1861, 0, 3, 0, '崁顶乡', '台湾屏东县崁顶乡', '', '', 'dx', 'D', 0);
INSERT INTO `tp_city` VALUES (1888, 1861, 0, 3, 0, '新埤乡', '台湾屏东县新埤乡', '', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (1889, 1861, 0, 3, 0, '南州乡', '台湾屏东县南州乡', '', '', 'nzx', 'N', 0);
INSERT INTO `tp_city` VALUES (1890, 1861, 0, 3, 0, '林边乡', '台湾屏东县林边乡', '', '', 'lbx', 'L', 0);
INSERT INTO `tp_city` VALUES (1891, 1861, 0, 3, 0, '东港镇', '台湾屏东县东港镇', '', '', 'dgz', 'D', 0);
INSERT INTO `tp_city` VALUES (1892, 1861, 0, 3, 0, '恒春镇', '台湾屏东县恒春镇', '', '', 'hcz', 'H', 0);
INSERT INTO `tp_city` VALUES (1893, 1861, 0, 3, 0, '牡丹乡', '台湾屏东县牡丹乡', '', '', 'mdx', 'M', 0);
INSERT INTO `tp_city` VALUES (1894, 1861, 0, 3, 0, '满州乡', '台湾屏东县满州乡', '', '', 'mzx', 'M', 0);
INSERT INTO `tp_city` VALUES (1895, 1679, 0, 2, 0, '澎湖县', '台湾澎湖县', '', '', 'phx', 'P', 0);
INSERT INTO `tp_city` VALUES (1896, 1895, 0, 3, 0, '望安乡', '台湾澎湖县望安乡', '', '', 'wax', 'W', 0);
INSERT INTO `tp_city` VALUES (1897, 1895, 0, 3, 0, '西屿乡', '台湾澎湖县西屿乡', '', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (1898, 1895, 0, 3, 0, '白沙乡', '台湾澎湖县白沙乡', '', '', 'bsx', 'B', 0);
INSERT INTO `tp_city` VALUES (1899, 1895, 0, 3, 0, '七美乡', '台湾澎湖县七美乡', '', '', 'qmx', 'Q', 0);
INSERT INTO `tp_city` VALUES (1900, 1895, 0, 3, 0, '马公市', '台湾澎湖县马公市', '', '', 'mgs', 'M', 0);
INSERT INTO `tp_city` VALUES (1901, 1895, 0, 3, 0, '湖西乡', '台湾澎湖县湖西乡', '', '', 'hxx', 'H', 0);
INSERT INTO `tp_city` VALUES (1902, 1679, 0, 2, 0, '花莲县', '台湾花莲县', '', '', 'hlx', 'H', 0);
INSERT INTO `tp_city` VALUES (1903, 1902, 0, 3, 0, '花莲市', '台湾花莲县花莲市', '', '', 'hls', 'H', 0);
INSERT INTO `tp_city` VALUES (1904, 1902, 0, 3, 0, '吉安乡', '台湾花莲县吉安乡', '', '', 'jax', 'J', 0);
INSERT INTO `tp_city` VALUES (1905, 1902, 0, 3, 0, '秀林乡', '台湾花莲县秀林乡', '', '', 'xlx', 'X', 0);
INSERT INTO `tp_city` VALUES (1906, 1902, 0, 3, 0, '太鲁阁', '台湾花莲县太鲁阁', '', '', 'tlg', 'T', 0);
INSERT INTO `tp_city` VALUES (1907, 1902, 0, 3, 0, '新城乡', '台湾花莲县新城乡', '', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (1908, 1902, 0, 3, 0, '丰滨乡', '台湾花莲县丰滨乡', '', '', 'fbx', 'F', 0);
INSERT INTO `tp_city` VALUES (1909, 1902, 0, 3, 0, '光复乡', '台湾花莲县光复乡', '', '', 'gfx', 'G', 0);
INSERT INTO `tp_city` VALUES (1910, 1902, 0, 3, 0, '凤林镇', '台湾花莲县凤林镇', '', '', 'flz', 'F', 0);
INSERT INTO `tp_city` VALUES (1911, 1902, 0, 3, 0, '寿丰乡', '台湾花莲县寿丰乡', '', '', 'sfx', 'S', 0);
INSERT INTO `tp_city` VALUES (1912, 1902, 0, 3, 0, '玉里镇', '台湾花莲县玉里镇', '', '', 'ylz', 'Y', 0);
INSERT INTO `tp_city` VALUES (1913, 1902, 0, 3, 0, '卓溪乡', '台湾花莲县卓溪乡', '', '', 'zxx', 'Z', 0);
INSERT INTO `tp_city` VALUES (1914, 1902, 0, 3, 0, '瑞穗乡', '台湾花莲县瑞穗乡', '', '', 'rsx', 'R', 0);
INSERT INTO `tp_city` VALUES (1915, 1902, 0, 3, 0, '万荣乡', '台湾花莲县万荣乡', '', '', 'wrx', 'W', 0);
INSERT INTO `tp_city` VALUES (1916, 1902, 0, 3, 0, '富里乡', '台湾花莲县富里乡', '', '', 'flx', 'F', 0);
INSERT INTO `tp_city` VALUES (1917, 1679, 0, 2, 0, '台东县', '台湾台东县', '', '', 'tdx', 'T', 0);
INSERT INTO `tp_city` VALUES (1918, 1917, 0, 3, 0, '海端乡', '台湾台东县海端乡', '', '', 'hdx', 'H', 0);
INSERT INTO `tp_city` VALUES (1919, 1917, 0, 3, 0, '池上乡', '台湾台东县池上乡', '', '', 'csx', 'C', 0);
INSERT INTO `tp_city` VALUES (1920, 1917, 0, 3, 0, '东河乡', '台湾台东县东河乡', '', '', 'dhx', 'D', 0);
INSERT INTO `tp_city` VALUES (1921, 1917, 0, 3, 0, '成功镇', '台湾台东县成功镇', '', '', 'cgz', 'C', 0);
INSERT INTO `tp_city` VALUES (1922, 1917, 0, 3, 0, '延平乡', '台湾台东县延平乡', '', '', 'ypx', 'Y', 0);
INSERT INTO `tp_city` VALUES (1923, 1917, 0, 3, 0, '卑南乡', '台湾台东县卑南乡', '', '', 'bnx', 'B', 0);
INSERT INTO `tp_city` VALUES (1924, 1917, 0, 3, 0, '鹿野乡', '台湾台东县鹿野乡', '', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (1925, 1917, 0, 3, 0, '关山镇', '台湾台东县关山镇', '', '', 'gsz', 'G', 0);
INSERT INTO `tp_city` VALUES (1926, 1917, 0, 3, 0, '台东市', '台湾台东县台东市', '', '', 'tds', 'T', 0);
INSERT INTO `tp_city` VALUES (1927, 1917, 0, 3, 0, '绿岛乡', '台湾台东县绿岛乡', '', '', 'ldx', 'L', 0);
INSERT INTO `tp_city` VALUES (1928, 1917, 0, 3, 0, '兰屿乡', '台湾台东县兰屿乡', '', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (1929, 1917, 0, 3, 0, '太麻里乡', '台湾台东县太麻里乡', '', '', 'tmlx', 'T', 0);
INSERT INTO `tp_city` VALUES (1930, 1917, 0, 3, 0, '金峰乡', '台湾台东县金峰乡', '', '', 'jfx', 'J', 0);
INSERT INTO `tp_city` VALUES (1931, 1917, 0, 3, 0, '长滨乡', '台湾台东县长滨乡', '', '', 'cbx', 'C', 0);
INSERT INTO `tp_city` VALUES (1932, 1917, 0, 3, 0, '达仁乡', '台湾台东县达仁乡', '', '', 'drx', 'D', 0);
INSERT INTO `tp_city` VALUES (1933, 1917, 0, 3, 0, '大武乡', '台湾台东县大武乡', '', '', 'dwx', 'D', 0);
INSERT INTO `tp_city` VALUES (1934, 1679, 0, 2, 0, '台北市', '台湾台北市', '', '', 'tbs', 'T', 0);
INSERT INTO `tp_city` VALUES (1935, 1934, 0, 3, 0, '中正区', '台湾台北市中正区', '100', '', 'zzq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1936, 1934, 0, 3, 0, '大同区', '台湾台北市大同区', '103', '', 'dtq', 'D', 0);
INSERT INTO `tp_city` VALUES (1937, 1934, 0, 3, 0, '中山区', '台湾台北市中山区', '104', '', 'zsq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1938, 1934, 0, 3, 0, '松山区', '台湾台北市松山区', '105', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (1939, 1934, 0, 3, 0, '大安区', '台湾台北市大安区', '106', '', 'daq', 'D', 0);
INSERT INTO `tp_city` VALUES (1940, 1934, 0, 3, 0, '万华区', '台湾台北市万华区', '108', '', 'whq', 'W', 0);
INSERT INTO `tp_city` VALUES (1941, 1934, 0, 3, 0, '信义区', '台湾台北市信义区', '110', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (1942, 1934, 0, 3, 0, '士林区', '台湾台北市士林区', '111', '', 'slq', 'S', 0);
INSERT INTO `tp_city` VALUES (1943, 1934, 0, 3, 0, '北投区', '台湾台北市北投区', '112', '', 'btq', 'B', 0);
INSERT INTO `tp_city` VALUES (1944, 1934, 0, 3, 0, '内湖区', '台湾台北市内湖区', '114', '', 'nhq', 'N', 0);
INSERT INTO `tp_city` VALUES (1945, 1934, 0, 3, 0, '南港区', '台湾台北市南港区', '115', '', 'ngq', 'N', 0);
INSERT INTO `tp_city` VALUES (1946, 1934, 0, 3, 0, '其它区', '台湾台北市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1947, 1934, 0, 3, 0, '文山区', '台湾台北市文山区', '116', '', 'wsq', 'W', 0);
INSERT INTO `tp_city` VALUES (1948, 1679, 0, 2, 0, '高雄市', '台湾高雄市', '', '', 'gxs', 'G', 0);
INSERT INTO `tp_city` VALUES (1949, 1948, 0, 3, 0, '永安区', '台湾高雄市永安区', '', '', 'yaq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1950, 1948, 0, 3, 0, '湖内区', '台湾高雄市湖内区', '', '', 'hnq', 'H', 0);
INSERT INTO `tp_city` VALUES (1951, 1948, 0, 3, 0, '凤山区', '台湾高雄市凤山区', '', '', 'fsq', 'F', 0);
INSERT INTO `tp_city` VALUES (1952, 1948, 0, 3, 0, '大寮区', '台湾高雄市大寮区', '', '', 'dq', 'D', 0);
INSERT INTO `tp_city` VALUES (1953, 1948, 0, 3, 0, '燕巢区', '台湾高雄市燕巢区', '', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1954, 1948, 0, 3, 0, '桥头区', '台湾高雄市桥头区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1955, 1948, 0, 3, 0, '梓官区', '台湾高雄市梓官区', '', '', 'gq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1956, 1948, 0, 3, 0, '弥陀区', '台湾高雄市弥陀区', '', '', 'mtq', 'M', 0);
INSERT INTO `tp_city` VALUES (1957, 1948, 0, 3, 0, '冈山区', '台湾高雄市冈山区', '', '', 'gsq', 'G', 0);
INSERT INTO `tp_city` VALUES (1958, 1948, 0, 3, 0, '路竹区', '台湾高雄市路竹区', '', '', 'lzq', 'L', 0);
INSERT INTO `tp_city` VALUES (1959, 1948, 0, 3, 0, '阿莲区', '台湾高雄市阿莲区', '', '', 'alq', 'A', 0);
INSERT INTO `tp_city` VALUES (1960, 1948, 0, 3, 0, '田寮区', '台湾高雄市田寮区', '', '', 'tq', 'T', 0);
INSERT INTO `tp_city` VALUES (1961, 1948, 0, 3, 0, '苓雅区', '台湾高雄市苓雅区', '', '', 'yq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1962, 1948, 0, 3, 0, '仁武区', '台湾高雄市仁武区', '', '', 'rwq', 'R', 0);
INSERT INTO `tp_city` VALUES (1963, 1948, 0, 3, 0, '大社区', '台湾高雄市大社区', '', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (1964, 1948, 0, 3, 0, '茄萣区', '台湾高雄市茄萣区', '', '', 'qq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1965, 1948, 0, 3, 0, '桃源区', '台湾高雄市桃源区', '', '', 'tyq', 'T', 0);
INSERT INTO `tp_city` VALUES (1966, 1948, 0, 3, 0, '甲仙区', '台湾高雄市甲仙区', '', '', 'jxq', 'J', 0);
INSERT INTO `tp_city` VALUES (1967, 1948, 0, 3, 0, '茂林区', '台湾高雄市茂林区', '', '', 'mlq', 'M', 0);
INSERT INTO `tp_city` VALUES (1968, 1948, 0, 3, 0, '那玛夏区', '台湾高雄市那玛夏区', '', '', 'nmxq', 'N', 0);
INSERT INTO `tp_city` VALUES (1969, 1948, 0, 3, 0, '六龟区', '台湾高雄市六龟区', '', '', 'lgq', 'L', 0);
INSERT INTO `tp_city` VALUES (1970, 1948, 0, 3, 0, '美浓区', '台湾高雄市美浓区', '', '', 'mnq', 'M', 0);
INSERT INTO `tp_city` VALUES (1971, 1948, 0, 3, 0, '杉林区', '台湾高雄市杉林区', '', '', 'slq', 'S', 0);
INSERT INTO `tp_city` VALUES (1972, 1948, 0, 3, 0, '内门区', '台湾高雄市内门区', '', '', 'nmq', 'N', 0);
INSERT INTO `tp_city` VALUES (1973, 1948, 0, 3, 0, '鸟松区', '台湾高雄市鸟松区', '', '', 'nsq', 'N', 0);
INSERT INTO `tp_city` VALUES (1974, 1948, 0, 3, 0, '林园区', '台湾高雄市林园区', '', '', 'lyq', 'L', 0);
INSERT INTO `tp_city` VALUES (1975, 1948, 0, 3, 0, '旗山区', '台湾高雄市旗山区', '', '', 'qsq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1976, 1948, 0, 3, 0, '大树区', '台湾高雄市大树区', '', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (1977, 1948, 0, 3, 0, '其它区', '台湾高雄市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1978, 1948, 0, 3, 0, '楠梓区', '台湾高雄市楠梓区', '811', '', 'q', 'Z', 0);
INSERT INTO `tp_city` VALUES (1979, 1948, 0, 3, 0, '小港区', '台湾高雄市小港区', '812', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (1980, 1948, 0, 3, 0, '三民区', '台湾高雄市三民区', '807', '', 'smq', 'S', 0);
INSERT INTO `tp_city` VALUES (1981, 1948, 0, 3, 0, '左营区', '台湾高雄市左营区', '813', '', 'zyq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1982, 1948, 0, 3, 0, '新兴区', '台湾高雄市新兴区', '800', '', 'xxq', 'X', 0);
INSERT INTO `tp_city` VALUES (1983, 1948, 0, 3, 0, '芩雅区', '台湾高雄市芩雅区', '802', '', 'yq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1984, 1948, 0, 3, 0, '前金区', '台湾高雄市前金区', '801', '', 'qjq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1985, 1948, 0, 3, 0, '鼓山区', '台湾高雄市鼓山区', '804', '', 'gsq', 'G', 0);
INSERT INTO `tp_city` VALUES (1986, 1948, 0, 3, 0, '盐埕区', '台湾高雄市盐埕区', '803', '', 'yq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1987, 1948, 0, 3, 0, '前镇区', '台湾高雄市前镇区', '806', '', 'qzq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1988, 1948, 0, 3, 0, '旗津区', '台湾高雄市旗津区', '805', '', 'qjq', 'Q', 0);
INSERT INTO `tp_city` VALUES (1989, 1679, 0, 2, 0, '台南市', '台湾台南市', '', '', 'tns', 'T', 0);
INSERT INTO `tp_city` VALUES (1990, 1989, 0, 3, 0, '安定区', '台湾台南市安定区', '', '', 'adq', 'A', 0);
INSERT INTO `tp_city` VALUES (1991, 1989, 0, 3, 0, '新市区', '台湾台南市新市区', '', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (1992, 1989, 0, 3, 0, '玉井区', '台湾台南市玉井区', '', '', 'yjq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1993, 1989, 0, 3, 0, '左镇区', '台湾台南市左镇区', '', '', 'zzq', 'Z', 0);
INSERT INTO `tp_city` VALUES (1994, 1989, 0, 3, 0, '新化区', '台湾台南市新化区', '', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (1995, 1989, 0, 3, 0, '归仁区', '台湾台南市归仁区', '', '', 'grq', 'G', 0);
INSERT INTO `tp_city` VALUES (1996, 1989, 0, 3, 0, '永康区', '台湾台南市永康区', '', '', 'ykq', 'Y', 0);
INSERT INTO `tp_city` VALUES (1997, 1989, 0, 3, 0, '佳里区', '台湾台南市佳里区', '', '', 'jlq', 'J', 0);
INSERT INTO `tp_city` VALUES (1998, 1989, 0, 3, 0, '麻豆区', '台湾台南市麻豆区', '', '', 'mdq', 'M', 0);
INSERT INTO `tp_city` VALUES (1999, 1989, 0, 3, 0, '官田区', '台湾台南市官田区', '', '', 'gtq', 'G', 0);
INSERT INTO `tp_city` VALUES (2000, 1989, 0, 3, 0, '龙崎区', '台湾台南市龙崎区', '', '', 'lqq', 'L', 0);
INSERT INTO `tp_city` VALUES (2001, 1989, 0, 3, 0, '关庙区', '台湾台南市关庙区', '', '', 'gmq', 'G', 0);
INSERT INTO `tp_city` VALUES (2002, 1989, 0, 3, 0, '仁德区', '台湾台南市仁德区', '', '', 'rdq', 'R', 0);
INSERT INTO `tp_city` VALUES (2003, 1989, 0, 3, 0, '南化区', '台湾台南市南化区', '', '', 'nhq', 'N', 0);
INSERT INTO `tp_city` VALUES (2004, 1989, 0, 3, 0, '楠西区', '台湾台南市楠西区', '', '', 'xq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2005, 1989, 0, 3, 0, '后壁区', '台湾台南市后壁区', '', '', 'hbq', 'H', 0);
INSERT INTO `tp_city` VALUES (2006, 1989, 0, 3, 0, '白河区', '台湾台南市白河区', '', '', 'bhq', 'B', 0);
INSERT INTO `tp_city` VALUES (2007, 1989, 0, 3, 0, '北门区', '台湾台南市北门区', '', '', 'bmq', 'B', 0);
INSERT INTO `tp_city` VALUES (2008, 1989, 0, 3, 0, '新营区', '台湾台南市新营区', '', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (2009, 1989, 0, 3, 0, '将军区', '台湾台南市将军区', '', '', 'jjq', 'J', 0);
INSERT INTO `tp_city` VALUES (2010, 1989, 0, 3, 0, '学甲区', '台湾台南市学甲区', '', '', 'xjq', 'X', 0);
INSERT INTO `tp_city` VALUES (2011, 1989, 0, 3, 0, '西港区', '台湾台南市西港区', '', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (2012, 1989, 0, 3, 0, '七股区', '台湾台南市七股区', '', '', 'qgq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2013, 1989, 0, 3, 0, '大内区', '台湾台南市大内区', '', '', 'dnq', 'D', 0);
INSERT INTO `tp_city` VALUES (2014, 1989, 0, 3, 0, '山上区', '台湾台南市山上区', '', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (2015, 1989, 0, 3, 0, '盐水区', '台湾台南市盐水区', '', '', 'ysq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2016, 1989, 0, 3, 0, '善化区', '台湾台南市善化区', '', '', 'shq', 'S', 0);
INSERT INTO `tp_city` VALUES (2017, 1989, 0, 3, 0, '下营区', '台湾台南市下营区', '', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (2018, 1989, 0, 3, 0, '柳营区', '台湾台南市柳营区', '', '', 'lyq', 'L', 0);
INSERT INTO `tp_city` VALUES (2019, 1989, 0, 3, 0, '东山区', '台湾台南市东山区', '', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (2020, 1989, 0, 3, 0, '六甲区', '台湾台南市六甲区', '', '', 'ljq', 'L', 0);
INSERT INTO `tp_city` VALUES (2021, 1989, 0, 3, 0, '安平区', '台湾台南市安平区', '708', '', 'apq', 'A', 0);
INSERT INTO `tp_city` VALUES (2022, 1989, 0, 3, 0, '北区', '台湾台南市北区', '704', '', 'bq', 'B', 0);
INSERT INTO `tp_city` VALUES (2023, 1989, 0, 3, 0, '其它区', '台湾台南市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2024, 1989, 0, 3, 0, '安南区', '台湾台南市安南区', '709', '', 'anq', 'A', 0);
INSERT INTO `tp_city` VALUES (2025, 1989, 0, 3, 0, '东区', '台湾台南市东区', '701', '', 'dq', 'D', 0);
INSERT INTO `tp_city` VALUES (2026, 1989, 0, 3, 0, '南区', '台湾台南市南区', '702', '', 'nq', 'N', 0);
INSERT INTO `tp_city` VALUES (2027, 1989, 0, 3, 0, '中西区', '台湾台南市中西区', '703', '', 'zxq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2028, 1679, 0, 2, 0, '金门县', '台湾金门县', '', '', 'jmx', 'J', 0);
INSERT INTO `tp_city` VALUES (2029, 2028, 0, 3, 0, '乌坵乡', '台湾金门县乌坵乡', '', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (2030, 2028, 0, 3, 0, '金城镇', '台湾金门县金城镇', '', '', 'jcz', 'J', 0);
INSERT INTO `tp_city` VALUES (2031, 2028, 0, 3, 0, '烈屿乡', '台湾金门县烈屿乡', '', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (2032, 2028, 0, 3, 0, '金湖镇', '台湾金门县金湖镇', '', '', 'jhz', 'J', 0);
INSERT INTO `tp_city` VALUES (2033, 2028, 0, 3, 0, '金宁乡', '台湾金门县金宁乡', '', '', 'jnx', 'J', 0);
INSERT INTO `tp_city` VALUES (2034, 2028, 0, 3, 0, '金沙镇', '台湾金门县金沙镇', '', '', 'jsz', 'J', 0);
INSERT INTO `tp_city` VALUES (2035, 1679, 0, 2, 0, '台中市', '台湾台中市', '', '', 'tzs', 'T', 0);
INSERT INTO `tp_city` VALUES (2036, 2035, 0, 3, 0, '大安区', '台湾台中市大安区', '', '', 'daq', 'D', 0);
INSERT INTO `tp_city` VALUES (2037, 2035, 0, 3, 0, '外埔区', '台湾台中市外埔区', '', '', 'wpq', 'W', 0);
INSERT INTO `tp_city` VALUES (2038, 2035, 0, 3, 0, '大甲区', '台湾台中市大甲区', '', '', 'djq', 'D', 0);
INSERT INTO `tp_city` VALUES (2039, 2035, 0, 3, 0, '清水区', '台湾台中市清水区', '', '', 'qsq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2040, 2035, 0, 3, 0, '大雅区', '台湾台中市大雅区', '', '', 'dyq', 'D', 0);
INSERT INTO `tp_city` VALUES (2041, 2035, 0, 3, 0, '神冈区', '台湾台中市神冈区', '', '', 'sgq', 'S', 0);
INSERT INTO `tp_city` VALUES (2042, 2035, 0, 3, 0, '新社区', '台湾台中市新社区', '', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (2043, 2035, 0, 3, 0, '潭子区', '台湾台中市潭子区', '', '', 'tzq', 'T', 0);
INSERT INTO `tp_city` VALUES (2044, 2035, 0, 3, 0, '龙井区', '台湾台中市龙井区', '', '', 'ljq', 'L', 0);
INSERT INTO `tp_city` VALUES (2045, 2035, 0, 3, 0, '梧栖区', '台湾台中市梧栖区', '', '', 'wqq', 'W', 0);
INSERT INTO `tp_city` VALUES (2046, 2035, 0, 3, 0, '大肚区', '台湾台中市大肚区', '', '', 'ddq', 'D', 0);
INSERT INTO `tp_city` VALUES (2047, 2035, 0, 3, 0, '沙鹿区', '台湾台中市沙鹿区', '', '', 'slq', 'S', 0);
INSERT INTO `tp_city` VALUES (2048, 2035, 0, 3, 0, '乌日区', '台湾台中市乌日区', '', '', 'wrq', 'W', 0);
INSERT INTO `tp_city` VALUES (2049, 2035, 0, 3, 0, '丰原区', '台湾台中市丰原区', '', '', 'fyq', 'F', 0);
INSERT INTO `tp_city` VALUES (2050, 2035, 0, 3, 0, '大里区', '台湾台中市大里区', '', '', 'dlq', 'D', 0);
INSERT INTO `tp_city` VALUES (2051, 2035, 0, 3, 0, '雾峰区', '台湾台中市雾峰区', '', '', 'wfq', 'W', 0);
INSERT INTO `tp_city` VALUES (2052, 2035, 0, 3, 0, '东势区', '台湾台中市东势区', '', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (2053, 2035, 0, 3, 0, '和平区', '台湾台中市和平区', '', '', 'hpq', 'H', 0);
INSERT INTO `tp_city` VALUES (2054, 2035, 0, 3, 0, '后里区', '台湾台中市后里区', '', '', 'hlq', 'H', 0);
INSERT INTO `tp_city` VALUES (2055, 2035, 0, 3, 0, '石冈区', '台湾台中市石冈区', '', '', 'sgq', 'S', 0);
INSERT INTO `tp_city` VALUES (2056, 2035, 0, 3, 0, '太平区', '台湾台中市太平区', '', '', 'tpq', 'T', 0);
INSERT INTO `tp_city` VALUES (2057, 2035, 0, 3, 0, '南屯区', '台湾台中市南屯区', '408', '', 'ntq', 'N', 0);
INSERT INTO `tp_city` VALUES (2058, 2035, 0, 3, 0, '其它区', '台湾台中市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2059, 2035, 0, 3, 0, '中区', '台湾台中市中区', '400', '', 'zq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2060, 2035, 0, 3, 0, '东区', '台湾台中市东区', '401', '', 'dq', 'D', 0);
INSERT INTO `tp_city` VALUES (2061, 2035, 0, 3, 0, '南区', '台湾台中市南区', '402', '', 'nq', 'N', 0);
INSERT INTO `tp_city` VALUES (2062, 2035, 0, 3, 0, '西区', '台湾台中市西区', '403', '', 'xq', 'X', 0);
INSERT INTO `tp_city` VALUES (2063, 2035, 0, 3, 0, '北区', '台湾台中市北区', '404', '', 'bq', 'B', 0);
INSERT INTO `tp_city` VALUES (2064, 2035, 0, 3, 0, '北屯区', '台湾台中市北屯区', '406', '', 'btq', 'B', 0);
INSERT INTO `tp_city` VALUES (2065, 2035, 0, 3, 0, '西屯区', '台湾台中市西屯区', '407', '', 'xtq', 'X', 0);
INSERT INTO `tp_city` VALUES (2066, 1679, 0, 2, 0, '南投县', '台湾南投县', '', '', 'ntx', 'N', 0);
INSERT INTO `tp_city` VALUES (2067, 2066, 0, 3, 0, '鹿谷乡', '台湾南投县鹿谷乡', '', '', 'lgx', 'L', 0);
INSERT INTO `tp_city` VALUES (2068, 2066, 0, 3, 0, '竹山镇', '台湾南投县竹山镇', '', '', 'zsz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2069, 2066, 0, 3, 0, '信义乡', '台湾南投县信义乡', '', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (2070, 2066, 0, 3, 0, '南投市', '台湾南投县南投市', '', '', 'nts', 'N', 0);
INSERT INTO `tp_city` VALUES (2071, 2066, 0, 3, 0, '中寮乡', '台湾南投县中寮乡', '', '', 'zx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2072, 2066, 0, 3, 0, '名间乡', '台湾南投县名间乡', '', '', 'mjx', 'M', 0);
INSERT INTO `tp_city` VALUES (2073, 2066, 0, 3, 0, '集集镇', '台湾南投县集集镇', '', '', 'jjz', 'J', 0);
INSERT INTO `tp_city` VALUES (2074, 2066, 0, 3, 0, '水里乡', '台湾南投县水里乡', '', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (2075, 2066, 0, 3, 0, '鱼池乡', '台湾南投县鱼池乡', '', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2076, 2066, 0, 3, 0, '草屯镇', '台湾南投县草屯镇', '', '', 'ctz', 'C', 0);
INSERT INTO `tp_city` VALUES (2077, 2066, 0, 3, 0, '国姓乡', '台湾南投县国姓乡', '', '', 'gxx', 'G', 0);
INSERT INTO `tp_city` VALUES (2078, 2066, 0, 3, 0, '埔里镇', '台湾南投县埔里镇', '', '', 'plz', 'P', 0);
INSERT INTO `tp_city` VALUES (2079, 2066, 0, 3, 0, '仁爱乡', '台湾南投县仁爱乡', '', '', 'rax', 'R', 0);
INSERT INTO `tp_city` VALUES (2080, 0, 0, 1, 0, '海南省', '海南省', '', '', 'hns', 'H', 0);
INSERT INTO `tp_city` VALUES (2081, 2080, 0, 2, 0, '昌江黎族自治县', '海南省昌江黎族自治县', '572700', '', 'cjlzzzx', 'C', 0);
INSERT INTO `tp_city` VALUES (2082, 2081, 0, 3, 0, '石碌镇', '海南省昌江黎族自治县石碌镇', '', '', 'slz', 'S', 0);
INSERT INTO `tp_city` VALUES (2083, 2081, 0, 3, 0, '叉河镇', '海南省昌江黎族自治县叉河镇', '', '', 'chz', 'C', 0);
INSERT INTO `tp_city` VALUES (2084, 2081, 0, 3, 0, '十月田镇', '海南省昌江黎族自治县十月田镇', '', '', 'sytz', 'S', 0);
INSERT INTO `tp_city` VALUES (2085, 2081, 0, 3, 0, '乌烈镇', '海南省昌江黎族自治县乌烈镇', '', '', 'wlz', 'W', 0);
INSERT INTO `tp_city` VALUES (2086, 2081, 0, 3, 0, '昌化镇', '海南省昌江黎族自治县昌化镇', '', '', 'chz', 'C', 0);
INSERT INTO `tp_city` VALUES (2087, 2081, 0, 3, 0, '海尾镇', '海南省昌江黎族自治县海尾镇', '', '', 'hwz', 'H', 0);
INSERT INTO `tp_city` VALUES (2088, 2081, 0, 3, 0, '七叉镇', '海南省昌江黎族自治县七叉镇', '', '', 'qcz', 'Q', 0);
INSERT INTO `tp_city` VALUES (2089, 2081, 0, 3, 0, '王下乡', '海南省昌江黎族自治县王下乡', '', '', 'wxx', 'W', 0);
INSERT INTO `tp_city` VALUES (2090, 2081, 0, 3, 0, '国营红林农场', '海南省昌江黎族自治县国营红林农场', '', '', 'gyhlnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2091, 2081, 0, 3, 0, '国营霸王岭林场', '海南省昌江黎族自治县国营霸王岭林场', '', '', 'gybwllc', 'G', 0);
INSERT INTO `tp_city` VALUES (2092, 2081, 0, 3, 0, '海南矿业联合有限公司', '海南省昌江黎族自治县海南矿业联合有限公司', '', '', 'hnkylhyxgs', 'H', 0);
INSERT INTO `tp_city` VALUES (2093, 2080, 0, 2, 0, '白沙黎族自治县', '海南省白沙黎族自治县', '572800', '', 'bslzzzx', 'B', 0);
INSERT INTO `tp_city` VALUES (2094, 2093, 0, 3, 0, '牙叉镇', '海南省白沙黎族自治县牙叉镇', '', '', 'ycz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2095, 2093, 0, 3, 0, '七坊镇', '海南省白沙黎族自治县七坊镇', '', '', 'qfz', 'Q', 0);
INSERT INTO `tp_city` VALUES (2096, 2093, 0, 3, 0, '邦溪镇', '海南省白沙黎族自治县邦溪镇', '', '', 'bxz', 'B', 0);
INSERT INTO `tp_city` VALUES (2097, 2093, 0, 3, 0, '打安镇', '海南省白沙黎族自治县打安镇', '', '', 'daz', 'D', 0);
INSERT INTO `tp_city` VALUES (2098, 2093, 0, 3, 0, '细水乡', '海南省白沙黎族自治县细水乡', '', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (2099, 2093, 0, 3, 0, '元门乡', '海南省白沙黎族自治县元门乡', '', '', 'ymx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2100, 2093, 0, 3, 0, '南开乡', '海南省白沙黎族自治县南开乡', '', '', 'nkx', 'N', 0);
INSERT INTO `tp_city` VALUES (2101, 2093, 0, 3, 0, '阜龙乡', '海南省白沙黎族自治县阜龙乡', '', '', 'flx', 'F', 0);
INSERT INTO `tp_city` VALUES (2102, 2093, 0, 3, 0, '青松乡', '海南省白沙黎族自治县青松乡', '', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2103, 2093, 0, 3, 0, '金波乡', '海南省白沙黎族自治县金波乡', '', '', 'jbx', 'J', 0);
INSERT INTO `tp_city` VALUES (2104, 2093, 0, 3, 0, '荣邦乡', '海南省白沙黎族自治县荣邦乡', '', '', 'rbx', 'R', 0);
INSERT INTO `tp_city` VALUES (2105, 2093, 0, 3, 0, '国营白沙农场', '海南省白沙黎族自治县国营白沙农场', '', '', 'gybsnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2106, 2093, 0, 3, 0, '国营龙江农场', '海南省白沙黎族自治县国营龙江农场', '', '', 'gyljnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2107, 2093, 0, 3, 0, '国营邦溪农场', '海南省白沙黎族自治县国营邦溪农场', '', '', 'gybxnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2108, 2080, 0, 2, 0, '临高县', '海南省临高县', '571800', '', 'lgx', 'L', 0);
INSERT INTO `tp_city` VALUES (2109, 2108, 0, 3, 0, '临城镇', '海南省临高县临城镇', '', '', 'lcz', 'L', 0);
INSERT INTO `tp_city` VALUES (2110, 2108, 0, 3, 0, '波莲镇', '海南省临高县波莲镇', '', '', 'blz', 'B', 0);
INSERT INTO `tp_city` VALUES (2111, 2108, 0, 3, 0, '东英镇', '海南省临高县东英镇', '', '', 'dyz', 'D', 0);
INSERT INTO `tp_city` VALUES (2112, 2108, 0, 3, 0, '博厚镇', '海南省临高县博厚镇', '', '', 'bhz', 'B', 0);
INSERT INTO `tp_city` VALUES (2113, 2108, 0, 3, 0, '皇桐镇', '海南省临高县皇桐镇', '', '', 'htz', 'H', 0);
INSERT INTO `tp_city` VALUES (2114, 2108, 0, 3, 0, '多文镇', '海南省临高县多文镇', '', '', 'dwz', 'D', 0);
INSERT INTO `tp_city` VALUES (2115, 2108, 0, 3, 0, '和舍镇', '海南省临高县和舍镇', '', '', 'hsz', 'H', 0);
INSERT INTO `tp_city` VALUES (2116, 2108, 0, 3, 0, '南宝镇', '海南省临高县南宝镇', '', '', 'nbz', 'N', 0);
INSERT INTO `tp_city` VALUES (2117, 2108, 0, 3, 0, '新盈镇', '海南省临高县新盈镇', '', '', 'xyz', 'X', 0);
INSERT INTO `tp_city` VALUES (2118, 2108, 0, 3, 0, '调楼镇', '海南省临高县调楼镇', '', '', 'dlz', 'D', 0);
INSERT INTO `tp_city` VALUES (2119, 2108, 0, 3, 0, '国营红华农场', '海南省临高县国营红华农场', '', '', 'gyhhnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2120, 2108, 0, 3, 0, '国营加来农场', '海南省临高县国营加来农场', '', '', 'gyjlnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2121, 2080, 0, 2, 0, '澄迈县', '海南省澄迈县', '571900', '', 'cmx', 'C', 0);
INSERT INTO `tp_city` VALUES (2122, 2121, 0, 3, 0, '金江镇', '海南省澄迈县金江镇', '', '', 'jjz', 'J', 0);
INSERT INTO `tp_city` VALUES (2123, 2121, 0, 3, 0, '老城镇', '海南省澄迈县老城镇', '', '', 'lcz', 'L', 0);
INSERT INTO `tp_city` VALUES (2124, 2121, 0, 3, 0, '瑞溪镇', '海南省澄迈县瑞溪镇', '', '', 'rxz', 'R', 0);
INSERT INTO `tp_city` VALUES (2125, 2121, 0, 3, 0, '永发镇', '海南省澄迈县永发镇', '', '', 'yfz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2126, 2121, 0, 3, 0, '加乐镇', '海南省澄迈县加乐镇', '', '', 'jlz', 'J', 0);
INSERT INTO `tp_city` VALUES (2127, 2121, 0, 3, 0, '文儒镇', '海南省澄迈县文儒镇', '', '', 'wrz', 'W', 0);
INSERT INTO `tp_city` VALUES (2128, 2121, 0, 3, 0, '中兴镇', '海南省澄迈县中兴镇', '', '', 'zxz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2129, 2121, 0, 3, 0, '仁兴镇', '海南省澄迈县仁兴镇', '', '', 'rxz', 'R', 0);
INSERT INTO `tp_city` VALUES (2130, 2121, 0, 3, 0, '福山镇', '海南省澄迈县福山镇', '', '', 'fsz', 'F', 0);
INSERT INTO `tp_city` VALUES (2131, 2121, 0, 3, 0, '桥头镇', '海南省澄迈县桥头镇', '', '', 'qtz', 'Q', 0);
INSERT INTO `tp_city` VALUES (2132, 2121, 0, 3, 0, '大丰镇', '海南省澄迈县大丰镇', '', '', 'dfz', 'D', 0);
INSERT INTO `tp_city` VALUES (2133, 2121, 0, 3, 0, '国营红光农场', '海南省澄迈县国营红光农场', '', '', 'gyhgnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2134, 2121, 0, 3, 0, '国营西达农场', '海南省澄迈县国营西达农场', '', '', 'gyxdnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2135, 2121, 0, 3, 0, '国营金安农场', '海南省澄迈县国营金安农场', '', '', 'gyjanc', 'G', 0);
INSERT INTO `tp_city` VALUES (2136, 2080, 0, 2, 0, '屯昌县', '海南省屯昌县', '571600', '', 'tcx', 'T', 0);
INSERT INTO `tp_city` VALUES (2137, 2136, 0, 3, 0, '屯城镇', '海南省屯昌县屯城镇', '', '', 'tcz', 'T', 0);
INSERT INTO `tp_city` VALUES (2138, 2136, 0, 3, 0, '新兴镇', '海南省屯昌县新兴镇', '', '', 'xxz', 'X', 0);
INSERT INTO `tp_city` VALUES (2139, 2136, 0, 3, 0, '枫木镇', '海南省屯昌县枫木镇', '', '', 'fmz', 'F', 0);
INSERT INTO `tp_city` VALUES (2140, 2136, 0, 3, 0, '乌坡镇', '海南省屯昌县乌坡镇', '', '', 'wpz', 'W', 0);
INSERT INTO `tp_city` VALUES (2141, 2136, 0, 3, 0, '南吕镇', '海南省屯昌县南吕镇', '', '', 'nlz', 'N', 0);
INSERT INTO `tp_city` VALUES (2142, 2136, 0, 3, 0, '南坤镇', '海南省屯昌县南坤镇', '', '', 'nkz', 'N', 0);
INSERT INTO `tp_city` VALUES (2143, 2136, 0, 3, 0, '坡心镇', '海南省屯昌县坡心镇', '', '', 'pxz', 'P', 0);
INSERT INTO `tp_city` VALUES (2144, 2136, 0, 3, 0, '西昌镇', '海南省屯昌县西昌镇', '', '', 'xcz', 'X', 0);
INSERT INTO `tp_city` VALUES (2145, 2136, 0, 3, 0, '国营中建农场', '海南省屯昌县国营中建农场', '', '', 'gyzjnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2146, 2136, 0, 3, 0, '国营中坤农场', '海南省屯昌县国营中坤农场', '', '', 'gyzknc', 'G', 0);
INSERT INTO `tp_city` VALUES (2147, 2080, 0, 2, 0, '定安县', '海南省定安县', '571200', '', 'dax', 'D', 0);
INSERT INTO `tp_city` VALUES (2148, 2147, 0, 3, 0, '定城镇', '海南省定安县定城镇', '', '', 'dcz', 'D', 0);
INSERT INTO `tp_city` VALUES (2149, 2147, 0, 3, 0, '新竹镇', '海南省定安县新竹镇', '', '', 'xzz', 'X', 0);
INSERT INTO `tp_city` VALUES (2150, 2147, 0, 3, 0, '龙湖镇', '海南省定安县龙湖镇', '', '', 'lhz', 'L', 0);
INSERT INTO `tp_city` VALUES (2151, 2147, 0, 3, 0, '黄竹镇', '海南省定安县黄竹镇', '', '', 'hzz', 'H', 0);
INSERT INTO `tp_city` VALUES (2152, 2147, 0, 3, 0, '雷鸣镇', '海南省定安县雷鸣镇', '', '', 'lmz', 'L', 0);
INSERT INTO `tp_city` VALUES (2153, 2147, 0, 3, 0, '龙门镇', '海南省定安县龙门镇', '', '', 'lmz', 'L', 0);
INSERT INTO `tp_city` VALUES (2154, 2147, 0, 3, 0, '龙河镇', '海南省定安县龙河镇', '', '', 'lhz', 'L', 0);
INSERT INTO `tp_city` VALUES (2155, 2147, 0, 3, 0, '岭口镇', '海南省定安县岭口镇', '', '', 'lkz', 'L', 0);
INSERT INTO `tp_city` VALUES (2156, 2147, 0, 3, 0, '翰林镇', '海南省定安县翰林镇', '', '', 'hlz', 'H', 0);
INSERT INTO `tp_city` VALUES (2157, 2147, 0, 3, 0, '富文镇', '海南省定安县富文镇', '', '', 'fwz', 'F', 0);
INSERT INTO `tp_city` VALUES (2158, 2147, 0, 3, 0, '国营中瑞农场', '海南省定安县国营中瑞农场', '', '', 'gyzrnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2159, 2147, 0, 3, 0, '国营南海农场', '海南省定安县国营南海农场', '', '', 'gynhnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2160, 2147, 0, 3, 0, '国营金鸡岭农场', '海南省定安县国营金鸡岭农场', '', '', 'gyjjlnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2161, 2080, 0, 2, 0, '中沙群岛的岛礁及其海域', '海南省中沙群岛的岛礁及其海域', '573100', '', 'zsqdddjjqh', 'Z', 0);
INSERT INTO `tp_city` VALUES (2162, 2161, 0, 3, 0, '中沙岛礁', '海南省中沙群岛的岛礁及其海域中沙岛礁', '', '', 'zsdj', 'Z', 0);
INSERT INTO `tp_city` VALUES (2163, 2080, 0, 2, 0, '南沙群岛', '海南省南沙群岛', '573100', '', 'nsqd', 'N', 0);
INSERT INTO `tp_city` VALUES (2164, 2163, 0, 3, 0, '永暑岛', '海南省南沙群岛永暑岛', '', '', 'ysd', 'Y', 0);
INSERT INTO `tp_city` VALUES (2165, 2080, 0, 2, 0, '西沙群岛', '海南省西沙群岛', '573100', '', 'xsqd', 'X', 0);
INSERT INTO `tp_city` VALUES (2166, 2165, 0, 3, 0, '永兴岛', '海南省西沙群岛永兴岛', '', '', 'yxd', 'Y', 0);
INSERT INTO `tp_city` VALUES (2167, 2080, 0, 2, 0, '琼中黎族苗族自治县', '海南省琼中黎族苗族自治县', '572900', '', 'qzlzmzzzx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2168, 2167, 0, 3, 0, '营根镇', '海南省琼中黎族苗族自治县营根镇', '', '', 'ygz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2169, 2167, 0, 3, 0, '湾岭镇', '海南省琼中黎族苗族自治县湾岭镇', '', '', 'wlz', 'W', 0);
INSERT INTO `tp_city` VALUES (2170, 2167, 0, 3, 0, '黎母山镇', '海南省琼中黎族苗族自治县黎母山镇', '', '', 'lmsz', 'L', 0);
INSERT INTO `tp_city` VALUES (2171, 2167, 0, 3, 0, '和平镇', '海南省琼中黎族苗族自治县和平镇', '', '', 'hpz', 'H', 0);
INSERT INTO `tp_city` VALUES (2172, 2167, 0, 3, 0, '长征镇', '海南省琼中黎族苗族自治县长征镇', '', '', 'czz', 'C', 0);
INSERT INTO `tp_city` VALUES (2173, 2167, 0, 3, 0, '红毛镇', '海南省琼中黎族苗族自治县红毛镇', '', '', 'hmz', 'H', 0);
INSERT INTO `tp_city` VALUES (2174, 2167, 0, 3, 0, '中平镇', '海南省琼中黎族苗族自治县中平镇', '', '', 'zpz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2175, 2167, 0, 3, 0, '吊罗山乡', '海南省琼中黎族苗族自治县吊罗山乡', '', '', 'dlsx', 'D', 0);
INSERT INTO `tp_city` VALUES (2176, 2167, 0, 3, 0, '上安乡', '海南省琼中黎族苗族自治县上安乡', '', '', 'sax', 'S', 0);
INSERT INTO `tp_city` VALUES (2177, 2167, 0, 3, 0, '什运乡', '海南省琼中黎族苗族自治县什运乡', '', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (2178, 2167, 0, 3, 0, '国营阳江农场', '海南省琼中黎族苗族自治县国营阳江农场', '', '', 'gyyjnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2179, 2167, 0, 3, 0, '国营乌石农场', '海南省琼中黎族苗族自治县国营乌石农场', '', '', 'gywsnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2180, 2167, 0, 3, 0, '国营加钗农场', '海南省琼中黎族苗族自治县国营加钗农场', '', '', 'gyjnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2181, 2167, 0, 3, 0, '国营长征农场', '海南省琼中黎族苗族自治县国营长征农场', '', '', 'gycznc', 'G', 0);
INSERT INTO `tp_city` VALUES (2182, 2167, 0, 3, 0, '国营黎母山林业公司', '海南省琼中黎族苗族自治县国营黎母山林业公司', '', '', 'gylmslygs', 'G', 0);
INSERT INTO `tp_city` VALUES (2183, 2080, 0, 2, 0, '保亭黎族苗族自治县', '海南省保亭黎族苗族自治县', '572300', '', 'btlzmzzzx', 'B', 0);
INSERT INTO `tp_city` VALUES (2184, 2183, 0, 3, 0, '保城镇', '海南省保亭黎族苗族自治县保城镇', '', '', 'bcz', 'B', 0);
INSERT INTO `tp_city` VALUES (2185, 2183, 0, 3, 0, '什玲镇', '海南省保亭黎族苗族自治县什玲镇', '', '', 'slz', 'S', 0);
INSERT INTO `tp_city` VALUES (2186, 2183, 0, 3, 0, '加茂镇', '海南省保亭黎族苗族自治县加茂镇', '', '', 'jmz', 'J', 0);
INSERT INTO `tp_city` VALUES (2187, 2183, 0, 3, 0, '响水镇', '海南省保亭黎族苗族自治县响水镇', '', '', 'xsz', 'X', 0);
INSERT INTO `tp_city` VALUES (2188, 2183, 0, 3, 0, '新政镇', '海南省保亭黎族苗族自治县新政镇', '', '', 'xzz', 'X', 0);
INSERT INTO `tp_city` VALUES (2189, 2183, 0, 3, 0, '三道镇', '海南省保亭黎族苗族自治县三道镇', '', '', 'sdz', 'S', 0);
INSERT INTO `tp_city` VALUES (2190, 2183, 0, 3, 0, '六弓乡', '海南省保亭黎族苗族自治县六弓乡', '', '', 'lgx', 'L', 0);
INSERT INTO `tp_city` VALUES (2191, 2183, 0, 3, 0, '南林乡', '海南省保亭黎族苗族自治县南林乡', '', '', 'nlx', 'N', 0);
INSERT INTO `tp_city` VALUES (2192, 2183, 0, 3, 0, '毛感乡', '海南省保亭黎族苗族自治县毛感乡', '', '', 'mgx', 'M', 0);
INSERT INTO `tp_city` VALUES (2193, 2183, 0, 3, 0, '国营新星农场', '海南省保亭黎族苗族自治县国营新星农场', '', '', 'gyxxnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2194, 2183, 0, 3, 0, '海南保亭热带作物研究所', '海南省保亭黎族苗族自治县海南保亭热带作物研究所', '', '', 'hnbtrdzwyj', 'H', 0);
INSERT INTO `tp_city` VALUES (2195, 2183, 0, 3, 0, '国营金江农场', '海南省保亭黎族苗族自治县国营金江农场', '', '', 'gyjjnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2196, 2183, 0, 3, 0, '国营三道农场', '海南省保亭黎族苗族自治县国营三道农场', '', '', 'gysdnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2197, 2080, 0, 2, 0, '陵水黎族自治县', '海南省陵水黎族自治县', '572400', '', 'lslzzzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2198, 2197, 0, 3, 0, '椰林镇', '海南省陵水黎族自治县椰林镇', '', '', 'ylz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2199, 2197, 0, 3, 0, '光坡镇', '海南省陵水黎族自治县光坡镇', '', '', 'gpz', 'G', 0);
INSERT INTO `tp_city` VALUES (2200, 2197, 0, 3, 0, '三才镇', '海南省陵水黎族自治县三才镇', '', '', 'scz', 'S', 0);
INSERT INTO `tp_city` VALUES (2201, 2197, 0, 3, 0, '英州镇', '海南省陵水黎族自治县英州镇', '', '', 'yzz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2202, 2197, 0, 3, 0, '隆广镇', '海南省陵水黎族自治县隆广镇', '', '', 'lgz', 'L', 0);
INSERT INTO `tp_city` VALUES (2203, 2197, 0, 3, 0, '文罗镇', '海南省陵水黎族自治县文罗镇', '', '', 'wlz', 'W', 0);
INSERT INTO `tp_city` VALUES (2204, 2197, 0, 3, 0, '本号镇', '海南省陵水黎族自治县本号镇', '', '', 'bhz', 'B', 0);
INSERT INTO `tp_city` VALUES (2205, 2197, 0, 3, 0, '新村镇', '海南省陵水黎族自治县新村镇', '', '', 'xcz', 'X', 0);
INSERT INTO `tp_city` VALUES (2206, 2197, 0, 3, 0, '黎安镇', '海南省陵水黎族自治县黎安镇', '', '', 'laz', 'L', 0);
INSERT INTO `tp_city` VALUES (2207, 2197, 0, 3, 0, '提蒙乡', '海南省陵水黎族自治县提蒙乡', '', '', 'tmx', 'T', 0);
INSERT INTO `tp_city` VALUES (2208, 2197, 0, 3, 0, '群英乡', '海南省陵水黎族自治县群英乡', '', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2209, 2197, 0, 3, 0, '国营岭门农场', '海南省陵水黎族自治县国营岭门农场', '', '', 'gylmnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2210, 2197, 0, 3, 0, '国营南平农场', '海南省陵水黎族自治县国营南平农场', '', '', 'gynpnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2211, 2197, 0, 3, 0, '国营吊罗山林业公司', '海南省陵水黎族自治县国营吊罗山林业公司', '', '', 'gydlslygs', 'G', 0);
INSERT INTO `tp_city` VALUES (2212, 2080, 0, 2, 0, '乐东黎族自治县', '海南省乐东黎族自治县', '572500', '', 'ldlzzzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2213, 2212, 0, 3, 0, '抱由镇', '海南省乐东黎族自治县抱由镇', '', '', 'byz', 'B', 0);
INSERT INTO `tp_city` VALUES (2214, 2212, 0, 3, 0, '万冲镇', '海南省乐东黎族自治县万冲镇', '', '', 'wcz', 'W', 0);
INSERT INTO `tp_city` VALUES (2215, 2212, 0, 3, 0, '大安镇', '海南省乐东黎族自治县大安镇', '', '', 'daz', 'D', 0);
INSERT INTO `tp_city` VALUES (2216, 2212, 0, 3, 0, '志仲镇', '海南省乐东黎族自治县志仲镇', '', '', 'zzz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2217, 2212, 0, 3, 0, '千家镇', '海南省乐东黎族自治县千家镇', '', '', 'qjz', 'Q', 0);
INSERT INTO `tp_city` VALUES (2218, 2212, 0, 3, 0, '九所镇', '海南省乐东黎族自治县九所镇', '', '', 'jsz', 'J', 0);
INSERT INTO `tp_city` VALUES (2219, 2212, 0, 3, 0, '利国镇', '海南省乐东黎族自治县利国镇', '', '', 'lgz', 'L', 0);
INSERT INTO `tp_city` VALUES (2220, 2212, 0, 3, 0, '黄流镇', '海南省乐东黎族自治县黄流镇', '', '', 'hlz', 'H', 0);
INSERT INTO `tp_city` VALUES (2221, 2212, 0, 3, 0, '佛罗镇', '海南省乐东黎族自治县佛罗镇', '', '', 'flz', 'F', 0);
INSERT INTO `tp_city` VALUES (2222, 2212, 0, 3, 0, '尖峰镇', '海南省乐东黎族自治县尖峰镇', '', '', 'jfz', 'J', 0);
INSERT INTO `tp_city` VALUES (2223, 2212, 0, 3, 0, '莺歌海镇', '海南省乐东黎族自治县莺歌海镇', '', '', 'ghz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2224, 2212, 0, 3, 0, '国营山荣农场', '海南省乐东黎族自治县国营山荣农场', '', '', 'gysrnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2225, 2212, 0, 3, 0, '国营乐光农场', '海南省乐东黎族自治县国营乐光农场', '', '', 'gylgnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2226, 2212, 0, 3, 0, '国营保国农场', '海南省乐东黎族自治县国营保国农场', '', '', 'gybgnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2227, 2212, 0, 3, 0, '国营尖峰岭林业公司', '海南省乐东黎族自治县国营尖峰岭林业公司', '', '', 'gyjfllygs', 'G', 0);
INSERT INTO `tp_city` VALUES (2228, 2212, 0, 3, 0, '国营莺歌海盐场', '海南省乐东黎族自治县国营莺歌海盐场', '', '', 'gyghyc', 'G', 0);
INSERT INTO `tp_city` VALUES (2229, 2080, 0, 2, 0, '文昌市', '海南省文昌市', '571300', '', 'wcs', 'W', 0);
INSERT INTO `tp_city` VALUES (2230, 2229, 0, 3, 0, '文城镇', '海南省文昌市文城镇', '', '', 'wcz', 'W', 0);
INSERT INTO `tp_city` VALUES (2231, 2229, 0, 3, 0, '重兴镇', '海南省文昌市重兴镇', '', '', 'zxz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2232, 2229, 0, 3, 0, '蓬莱镇', '海南省文昌市蓬莱镇', '', '', 'plz', 'P', 0);
INSERT INTO `tp_city` VALUES (2233, 2229, 0, 3, 0, '会文镇', '海南省文昌市会文镇', '', '', 'hwz', 'H', 0);
INSERT INTO `tp_city` VALUES (2234, 2229, 0, 3, 0, '东路镇', '海南省文昌市东路镇', '', '', 'dlz', 'D', 0);
INSERT INTO `tp_city` VALUES (2235, 2229, 0, 3, 0, '潭牛镇', '海南省文昌市潭牛镇', '', '', 'tnz', 'T', 0);
INSERT INTO `tp_city` VALUES (2236, 2229, 0, 3, 0, '东阁镇', '海南省文昌市东阁镇', '', '', 'dgz', 'D', 0);
INSERT INTO `tp_city` VALUES (2237, 2229, 0, 3, 0, '文教镇', '海南省文昌市文教镇', '', '', 'wjz', 'W', 0);
INSERT INTO `tp_city` VALUES (2238, 2229, 0, 3, 0, '东郊镇', '海南省文昌市东郊镇', '', '', 'djz', 'D', 0);
INSERT INTO `tp_city` VALUES (2239, 2229, 0, 3, 0, '龙楼镇', '海南省文昌市龙楼镇', '', '', 'llz', 'L', 0);
INSERT INTO `tp_city` VALUES (2240, 2229, 0, 3, 0, '昌洒镇', '海南省文昌市昌洒镇', '', '', 'csz', 'C', 0);
INSERT INTO `tp_city` VALUES (2241, 2229, 0, 3, 0, '翁田镇', '海南省文昌市翁田镇', '', '', 'wtz', 'W', 0);
INSERT INTO `tp_city` VALUES (2242, 2229, 0, 3, 0, '抱罗镇', '海南省文昌市抱罗镇', '', '', 'blz', 'B', 0);
INSERT INTO `tp_city` VALUES (2243, 2229, 0, 3, 0, '冯坡镇', '海南省文昌市冯坡镇', '', '', 'fpz', 'F', 0);
INSERT INTO `tp_city` VALUES (2244, 2229, 0, 3, 0, '锦山镇', '海南省文昌市锦山镇', '', '', 'jsz', 'J', 0);
INSERT INTO `tp_city` VALUES (2245, 2229, 0, 3, 0, '铺前镇', '海南省文昌市铺前镇', '', '', 'pqz', 'P', 0);
INSERT INTO `tp_city` VALUES (2246, 2229, 0, 3, 0, '公坡镇', '海南省文昌市公坡镇', '', '', 'gpz', 'G', 0);
INSERT INTO `tp_city` VALUES (2247, 2229, 0, 3, 0, '国营东路农场', '海南省文昌市国营东路农场', '', '', 'gydlnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2248, 2229, 0, 3, 0, '国营南阳农场', '海南省文昌市国营南阳农场', '', '', 'gynync', 'G', 0);
INSERT INTO `tp_city` VALUES (2249, 2229, 0, 3, 0, '国营罗豆农场', '海南省文昌市国营罗豆农场', '', '', 'gyldnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2250, 2080, 0, 2, 0, '东方市', '海南省东方市', '572600', '', 'dfs', 'D', 0);
INSERT INTO `tp_city` VALUES (2251, 2250, 0, 3, 0, '八所镇', '海南省东方市八所镇', '', '', 'bsz', 'B', 0);
INSERT INTO `tp_city` VALUES (2252, 2250, 0, 3, 0, '东河镇', '海南省东方市东河镇', '', '', 'dhz', 'D', 0);
INSERT INTO `tp_city` VALUES (2253, 2250, 0, 3, 0, '大田镇', '海南省东方市大田镇', '', '', 'dtz', 'D', 0);
INSERT INTO `tp_city` VALUES (2254, 2250, 0, 3, 0, '感城镇', '海南省东方市感城镇', '', '', 'gcz', 'G', 0);
INSERT INTO `tp_city` VALUES (2255, 2250, 0, 3, 0, '板桥镇', '海南省东方市板桥镇', '', '', 'bqz', 'B', 0);
INSERT INTO `tp_city` VALUES (2256, 2250, 0, 3, 0, '三家镇', '海南省东方市三家镇', '', '', 'sjz', 'S', 0);
INSERT INTO `tp_city` VALUES (2257, 2250, 0, 3, 0, '四更镇', '海南省东方市四更镇', '', '', 'sgz', 'S', 0);
INSERT INTO `tp_city` VALUES (2258, 2250, 0, 3, 0, '新龙镇', '海南省东方市新龙镇', '', '', 'xlz', 'X', 0);
INSERT INTO `tp_city` VALUES (2259, 2250, 0, 3, 0, '天安乡', '海南省东方市天安乡', '', '', 'tax', 'T', 0);
INSERT INTO `tp_city` VALUES (2260, 2250, 0, 3, 0, '江边乡', '海南省东方市江边乡', '', '', 'jbx', 'J', 0);
INSERT INTO `tp_city` VALUES (2261, 2250, 0, 3, 0, '国营广坝农场', '海南省东方市国营广坝农场', '', '', 'gygbnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2262, 2250, 0, 3, 0, '东方华侨农场', '海南省东方市东方华侨农场', '', '', 'dfhqnc', 'D', 0);
INSERT INTO `tp_city` VALUES (2263, 2080, 0, 2, 0, '万宁市', '海南省万宁市', '571500', '', 'wns', 'W', 0);
INSERT INTO `tp_city` VALUES (2264, 2263, 0, 3, 0, '万城镇', '海南省万宁市万城镇', '', '', 'wcz', 'W', 0);
INSERT INTO `tp_city` VALUES (2265, 2263, 0, 3, 0, '龙滚镇', '海南省万宁市龙滚镇', '', '', 'lgz', 'L', 0);
INSERT INTO `tp_city` VALUES (2266, 2263, 0, 3, 0, '和乐镇', '海南省万宁市和乐镇', '', '', 'hlz', 'H', 0);
INSERT INTO `tp_city` VALUES (2267, 2263, 0, 3, 0, '后安镇', '海南省万宁市后安镇', '', '', 'haz', 'H', 0);
INSERT INTO `tp_city` VALUES (2268, 2263, 0, 3, 0, '大茂镇', '海南省万宁市大茂镇', '', '', 'dmz', 'D', 0);
INSERT INTO `tp_city` VALUES (2269, 2263, 0, 3, 0, '东澳镇', '海南省万宁市东澳镇', '', '', 'daz', 'D', 0);
INSERT INTO `tp_city` VALUES (2270, 2263, 0, 3, 0, '礼纪镇', '海南省万宁市礼纪镇', '', '', 'ljz', 'L', 0);
INSERT INTO `tp_city` VALUES (2271, 2263, 0, 3, 0, '长丰镇', '海南省万宁市长丰镇', '', '', 'cfz', 'C', 0);
INSERT INTO `tp_city` VALUES (2272, 2263, 0, 3, 0, '山根镇', '海南省万宁市山根镇', '', '', 'sgz', 'S', 0);
INSERT INTO `tp_city` VALUES (2273, 2263, 0, 3, 0, '北大镇', '海南省万宁市北大镇', '', '', 'bdz', 'B', 0);
INSERT INTO `tp_city` VALUES (2274, 2263, 0, 3, 0, '南桥镇', '海南省万宁市南桥镇', '', '', 'nqz', 'N', 0);
INSERT INTO `tp_city` VALUES (2275, 2263, 0, 3, 0, '三更罗镇', '海南省万宁市三更罗镇', '', '', 'sglz', 'S', 0);
INSERT INTO `tp_city` VALUES (2276, 2263, 0, 3, 0, '国营东兴农场', '海南省万宁市国营东兴农场', '', '', 'gydxnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2277, 2263, 0, 3, 0, '国营东和农场', '海南省万宁市国营东和农场', '', '', 'gydhnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2278, 2263, 0, 3, 0, '国营新中农场', '海南省万宁市国营新中农场', '', '', 'gyxznc', 'G', 0);
INSERT INTO `tp_city` VALUES (2279, 2263, 0, 3, 0, '兴隆华侨农场', '海南省万宁市兴隆华侨农场', '', '', 'xlhqnc', 'X', 0);
INSERT INTO `tp_city` VALUES (2280, 2263, 0, 3, 0, '地方国营六连林场', '海南省万宁市地方国营六连林场', '', '', 'dfgylllc', 'D', 0);
INSERT INTO `tp_city` VALUES (2281, 2080, 0, 2, 0, '五指山市', '海南省五指山市', '572200', '', 'wzss', 'W', 0);
INSERT INTO `tp_city` VALUES (2282, 2281, 0, 3, 0, '通什镇', '海南省五指山市通什镇', '', '', 'tsz', 'T', 0);
INSERT INTO `tp_city` VALUES (2283, 2281, 0, 3, 0, '南圣镇', '海南省五指山市南圣镇', '', '', 'nsz', 'N', 0);
INSERT INTO `tp_city` VALUES (2284, 2281, 0, 3, 0, '毛阳镇', '海南省五指山市毛阳镇', '', '', 'myz', 'M', 0);
INSERT INTO `tp_city` VALUES (2285, 2281, 0, 3, 0, '番阳镇', '海南省五指山市番阳镇', '', '', 'fyz', 'F', 0);
INSERT INTO `tp_city` VALUES (2286, 2281, 0, 3, 0, '畅好乡', '海南省五指山市畅好乡', '', '', 'chx', 'C', 0);
INSERT INTO `tp_city` VALUES (2287, 2281, 0, 3, 0, '毛道乡', '海南省五指山市毛道乡', '', '', 'mdx', 'M', 0);
INSERT INTO `tp_city` VALUES (2288, 2281, 0, 3, 0, '水满乡', '海南省五指山市水满乡', '', '', 'smx', 'S', 0);
INSERT INTO `tp_city` VALUES (2289, 2281, 0, 3, 0, '国营畅好农场', '海南省五指山市国营畅好农场', '', '', 'gychnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2290, 2080, 0, 2, 0, '儋州市', '海南省儋州市', '571700', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (2291, 2290, 0, 3, 0, '那大镇', '海南省儋州市那大镇', '', '', 'ndz', 'N', 0);
INSERT INTO `tp_city` VALUES (2292, 2290, 0, 3, 0, '和庆镇', '海南省儋州市和庆镇', '', '', 'hqz', 'H', 0);
INSERT INTO `tp_city` VALUES (2293, 2290, 0, 3, 0, '南丰镇', '海南省儋州市南丰镇', '', '', 'nfz', 'N', 0);
INSERT INTO `tp_city` VALUES (2294, 2290, 0, 3, 0, '大成镇', '海南省儋州市大成镇', '', '', 'dcz', 'D', 0);
INSERT INTO `tp_city` VALUES (2295, 2290, 0, 3, 0, '雅星镇', '海南省儋州市雅星镇', '', '', 'yxz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2296, 2290, 0, 3, 0, '兰洋镇', '海南省儋州市兰洋镇', '', '', 'lyz', 'L', 0);
INSERT INTO `tp_city` VALUES (2297, 2290, 0, 3, 0, '光村镇', '海南省儋州市光村镇', '', '', 'gcz', 'G', 0);
INSERT INTO `tp_city` VALUES (2298, 2290, 0, 3, 0, '木棠镇', '海南省儋州市木棠镇', '', '', 'mtz', 'M', 0);
INSERT INTO `tp_city` VALUES (2299, 2290, 0, 3, 0, '海头镇', '海南省儋州市海头镇', '', '', 'htz', 'H', 0);
INSERT INTO `tp_city` VALUES (2300, 2290, 0, 3, 0, '峨蔓镇', '海南省儋州市峨蔓镇', '', '', 'emz', 'E', 0);
INSERT INTO `tp_city` VALUES (2301, 2290, 0, 3, 0, '三都镇', '海南省儋州市三都镇', '', '', 'sdz', 'S', 0);
INSERT INTO `tp_city` VALUES (2302, 2290, 0, 3, 0, '王五镇', '海南省儋州市王五镇', '', '', 'wwz', 'W', 0);
INSERT INTO `tp_city` VALUES (2303, 2290, 0, 3, 0, '白马井镇', '海南省儋州市白马井镇', '', '', 'bmjz', 'B', 0);
INSERT INTO `tp_city` VALUES (2304, 2290, 0, 3, 0, '中和镇', '海南省儋州市中和镇', '', '', 'zhz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2305, 2290, 0, 3, 0, '排浦镇', '海南省儋州市排浦镇', '', '', 'ppz', 'P', 0);
INSERT INTO `tp_city` VALUES (2306, 2290, 0, 3, 0, '东成镇', '海南省儋州市东成镇', '', '', 'dcz', 'D', 0);
INSERT INTO `tp_city` VALUES (2307, 2290, 0, 3, 0, '新州镇', '海南省儋州市新州镇', '', '', 'xzz', 'X', 0);
INSERT INTO `tp_city` VALUES (2308, 2290, 0, 3, 0, '国营西培农场', '海南省儋州市国营西培农场', '', '', 'gyxpnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2309, 2290, 0, 3, 0, '国营西联农场', '海南省儋州市国营西联农场', '', '', 'gyxlnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2310, 2290, 0, 3, 0, '国营蓝洋农场', '海南省儋州市国营蓝洋农场', '', '', 'gylync', 'G', 0);
INSERT INTO `tp_city` VALUES (2311, 2290, 0, 3, 0, '国营八一农场', '海南省儋州市国营八一农场', '', '', 'gybync', 'G', 0);
INSERT INTO `tp_city` VALUES (2312, 2290, 0, 3, 0, '洋浦经济开发区', '海南省儋州市洋浦经济开发区', '', '', 'ypjjkfq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2313, 2290, 0, 3, 0, '华南热作学院', '海南省儋州市华南热作学院', '', '', 'hnrzxy', 'H', 0);
INSERT INTO `tp_city` VALUES (2314, 2080, 0, 2, 0, '琼海市', '海南省琼海市', '571400', '', 'qhs', 'Q', 0);
INSERT INTO `tp_city` VALUES (2315, 2314, 0, 3, 0, '嘉积镇', '海南省琼海市嘉积镇', '', '', 'jjz', 'J', 0);
INSERT INTO `tp_city` VALUES (2316, 2314, 0, 3, 0, '万泉镇', '海南省琼海市万泉镇', '', '', 'wqz', 'W', 0);
INSERT INTO `tp_city` VALUES (2317, 2314, 0, 3, 0, '石壁镇', '海南省琼海市石壁镇', '', '', 'sbz', 'S', 0);
INSERT INTO `tp_city` VALUES (2318, 2314, 0, 3, 0, '中原镇', '海南省琼海市中原镇', '', '', 'zyz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2319, 2314, 0, 3, 0, '博鳌镇', '海南省琼海市博鳌镇', '', '', 'bz', 'B', 0);
INSERT INTO `tp_city` VALUES (2320, 2314, 0, 3, 0, '阳江镇', '海南省琼海市阳江镇', '', '', 'yjz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2321, 2314, 0, 3, 0, '龙江镇', '海南省琼海市龙江镇', '', '', 'ljz', 'L', 0);
INSERT INTO `tp_city` VALUES (2322, 2314, 0, 3, 0, '潭门镇', '海南省琼海市潭门镇', '', '', 'tmz', 'T', 0);
INSERT INTO `tp_city` VALUES (2323, 2314, 0, 3, 0, '塔洋镇', '海南省琼海市塔洋镇', '', '', 'tyz', 'T', 0);
INSERT INTO `tp_city` VALUES (2324, 2314, 0, 3, 0, '长坡镇', '海南省琼海市长坡镇', '', '', 'cpz', 'C', 0);
INSERT INTO `tp_city` VALUES (2325, 2314, 0, 3, 0, '大路镇', '海南省琼海市大路镇', '', '', 'dlz', 'D', 0);
INSERT INTO `tp_city` VALUES (2326, 2314, 0, 3, 0, '会山镇', '海南省琼海市会山镇', '', '', 'hsz', 'H', 0);
INSERT INTO `tp_city` VALUES (2327, 2314, 0, 3, 0, '国营东太农场', '海南省琼海市国营东太农场', '', '', 'gydtnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2328, 2314, 0, 3, 0, '国营东红农场', '海南省琼海市国营东红农场', '', '', 'gydhnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2329, 2314, 0, 3, 0, '国营东升农场', '海南省琼海市国营东升农场', '', '', 'gydsnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2330, 2314, 0, 3, 0, '彬村山华侨农场', '海南省琼海市彬村山华侨农场', '', '', 'bcshqnc', 'B', 0);
INSERT INTO `tp_city` VALUES (2331, 2080, 0, 2, 0, '三沙市', '海南省三沙市', '', '', 'sss', 'S', 0);
INSERT INTO `tp_city` VALUES (2332, 2331, 0, 3, 0, '西沙群岛', '海南省三沙市西沙群岛', '', '', 'xsqd', 'X', 0);
INSERT INTO `tp_city` VALUES (2333, 2331, 0, 3, 0, '中沙群岛的岛礁及其海域', '海南省三沙市中沙群岛的岛礁及其海域', '', '', 'zsqdddjjqh', 'Z', 0);
INSERT INTO `tp_city` VALUES (2334, 2331, 0, 3, 0, '南沙群岛', '海南省三沙市南沙群岛', '', '', 'nsqd', 'N', 0);
INSERT INTO `tp_city` VALUES (2335, 2080, 0, 2, 0, '海口市', '海南省海口市', '570000', '', 'hks', 'H', 0);
INSERT INTO `tp_city` VALUES (2336, 2335, 0, 3, 0, '秀英区', '海南省海口市秀英区', '570311', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (2337, 2335, 0, 3, 0, '琼山区', '海南省海口市琼山区', '571100', '', 'qsq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2338, 2335, 0, 3, 0, '龙华区', '海南省海口市龙华区', '570105', '', 'lhq', 'L', 0);
INSERT INTO `tp_city` VALUES (2339, 2335, 0, 3, 0, '其它区', '海南省海口市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2340, 2335, 0, 3, 0, '美兰区', '海南省海口市美兰区', '570203', '', 'mlq', 'M', 0);
INSERT INTO `tp_city` VALUES (2341, 2080, 0, 2, 0, '三亚市', '海南省三亚市', '572000', '', 'sys', 'S', 0);
INSERT INTO `tp_city` VALUES (2342, 2341, 0, 3, 0, '海棠湾镇', '海南省三亚市海棠湾镇', '', '', 'htwz', 'H', 0);
INSERT INTO `tp_city` VALUES (2343, 2341, 0, 3, 0, '吉阳镇', '海南省三亚市吉阳镇', '', '', 'jyz', 'J', 0);
INSERT INTO `tp_city` VALUES (2344, 2341, 0, 3, 0, '凤凰镇', '海南省三亚市凤凰镇', '', '', 'fhz', 'F', 0);
INSERT INTO `tp_city` VALUES (2345, 2341, 0, 3, 0, '崖城镇', '海南省三亚市崖城镇', '', '', 'ycz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2346, 2341, 0, 3, 0, '天涯镇', '海南省三亚市天涯镇', '', '', 'tyz', 'T', 0);
INSERT INTO `tp_city` VALUES (2347, 2341, 0, 3, 0, '育才镇', '海南省三亚市育才镇', '', '', 'ycz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2348, 2341, 0, 3, 0, '国营南田农场', '海南省三亚市国营南田农场', '', '', 'gyntnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2349, 2341, 0, 3, 0, '国营南新农场', '海南省三亚市国营南新农场', '', '', 'gynxnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2350, 2341, 0, 3, 0, '国营立才农场', '海南省三亚市国营立才农场', '', '', 'gylcnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2351, 2341, 0, 3, 0, '国营南滨农场', '海南省三亚市国营南滨农场', '', '', 'gynbnc', 'G', 0);
INSERT INTO `tp_city` VALUES (2352, 2341, 0, 3, 0, '河西区街道办', '海南省三亚市河西区街道办', '', '', 'hxqjdb', 'H', 0);
INSERT INTO `tp_city` VALUES (2353, 2341, 0, 3, 0, '河东区街道办', '海南省三亚市河东区街道办', '', '', 'hdqjdb', 'H', 0);
INSERT INTO `tp_city` VALUES (2354, 0, 0, 1, 0, '香港', '香港', '', '', 'xg', 'X', 0);
INSERT INTO `tp_city` VALUES (2355, 2354, 0, 2, 0, '新界', '香港新界', '', '', 'xj', 'X', 0);
INSERT INTO `tp_city` VALUES (2356, 2355, 0, 3, 0, '北区', '香港新界北区', '810301', '', 'bq', 'B', 0);
INSERT INTO `tp_city` VALUES (2357, 2355, 0, 3, 0, '沙田区', '香港新界沙田区', '810303', '', 'stq', 'S', 0);
INSERT INTO `tp_city` VALUES (2358, 2355, 0, 3, 0, '大埔区', '香港新界大埔区', '810302', '', 'dpq', 'D', 0);
INSERT INTO `tp_city` VALUES (2359, 2355, 0, 3, 0, '葵青区', '香港新界葵青区', '810308', '', 'kqq', 'K', 0);
INSERT INTO `tp_city` VALUES (2360, 2355, 0, 3, 0, '离岛区', '香港新界离岛区', '810309', '', 'ldq', 'L', 0);
INSERT INTO `tp_city` VALUES (2361, 2355, 0, 3, 0, '屯门区', '香港新界屯门区', '810306', '', 'tmq', 'T', 0);
INSERT INTO `tp_city` VALUES (2362, 2355, 0, 3, 0, '荃湾区', '香港新界荃湾区', '810307', '', 'wq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2363, 2355, 0, 3, 0, '西贡区', '香港新界西贡区', '810304', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (2364, 2355, 0, 3, 0, '元朗区', '香港新界元朗区', '810305', '', 'ylq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2365, 2354, 0, 2, 0, '九龙', '香港九龙', '', '', 'jl', 'J', 0);
INSERT INTO `tp_city` VALUES (2366, 2365, 0, 3, 0, '黄大仙区', '香港九龙黄大仙区', '810204', '', 'hdxq', 'H', 0);
INSERT INTO `tp_city` VALUES (2367, 2365, 0, 3, 0, '观塘区', '香港九龙观塘区', '810205', '', 'gtq', 'G', 0);
INSERT INTO `tp_city` VALUES (2368, 2365, 0, 3, 0, '九龙城区', '香港九龙九龙城区', '810201', '', 'jlcq', 'J', 0);
INSERT INTO `tp_city` VALUES (2369, 2365, 0, 3, 0, '油尖旺区', '香港九龙油尖旺区', '810202', '', 'yjwq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2370, 2365, 0, 3, 0, '深水埗区', '香港九龙深水埗区', '810203', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (2371, 2354, 0, 2, 0, '香港岛', '香港香港岛', '', '', 'xgd', 'X', 0);
INSERT INTO `tp_city` VALUES (2372, 2371, 0, 3, 0, '东区', '香港香港岛东区', '810103', '', 'dq', 'D', 0);
INSERT INTO `tp_city` VALUES (2373, 2371, 0, 3, 0, '湾仔', '香港香港岛湾仔', '810102', '', 'wz', 'W', 0);
INSERT INTO `tp_city` VALUES (2374, 2371, 0, 3, 0, '中西区', '香港香港岛中西区', '810101', '', 'zxq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2375, 2371, 0, 3, 0, '南区', '香港香港岛南区', '810104', '', 'nq', 'N', 0);
INSERT INTO `tp_city` VALUES (2376, 0, 0, 1, 0, '云南省', '云南省', '', '', 'yns', 'Y', 0);
INSERT INTO `tp_city` VALUES (2377, 2376, 0, 2, 0, '玉溪市', '云南省玉溪市', '', '', 'yxs', 'Y', 0);
INSERT INTO `tp_city` VALUES (2378, 2377, 0, 3, 0, '华宁县', '云南省玉溪市华宁县', '652800', '', 'hnx', 'H', 0);
INSERT INTO `tp_city` VALUES (2379, 2377, 0, 3, 0, '易门县', '云南省玉溪市易门县', '651100', '', 'ymx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2380, 2377, 0, 3, 0, '峨山彝族自治县', '云南省玉溪市峨山彝族自治县', '653200', '', 'esyzzzx', 'E', 0);
INSERT INTO `tp_city` VALUES (2381, 2377, 0, 3, 0, '新平彝族傣族自治县', '云南省玉溪市新平彝族傣族自治县', '653400', '', 'xpyzdzzzx', 'X', 0);
INSERT INTO `tp_city` VALUES (2382, 2377, 0, 3, 0, '元江哈尼族彝族傣族自治县', '云南省玉溪市元江哈尼族彝族傣族自治县', '653300', '', 'yjhnzyzdzz', 'Y', 0);
INSERT INTO `tp_city` VALUES (2383, 2377, 0, 3, 0, '其它区', '云南省玉溪市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2384, 2377, 0, 3, 0, '江川县', '云南省玉溪市江川县', '652600', '', 'jcx', 'J', 0);
INSERT INTO `tp_city` VALUES (2385, 2377, 0, 3, 0, '澄江县', '云南省玉溪市澄江县', '652500', '', 'cjx', 'C', 0);
INSERT INTO `tp_city` VALUES (2386, 2377, 0, 3, 0, '通海县', '云南省玉溪市通海县', '652700', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (2387, 2377, 0, 3, 0, '红塔区', '云南省玉溪市红塔区', '653100', '', 'htq', 'H', 0);
INSERT INTO `tp_city` VALUES (2388, 2376, 0, 2, 0, '曲靖市', '云南省曲靖市', '655000', '', 'qjs', 'Q', 0);
INSERT INTO `tp_city` VALUES (2389, 2388, 0, 3, 0, '其它区', '云南省曲靖市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2390, 2388, 0, 3, 0, '宣威市', '云南省曲靖市宣威市', '655400', '', 'xws', 'X', 0);
INSERT INTO `tp_city` VALUES (2391, 2388, 0, 3, 0, '沾益县', '云南省曲靖市沾益县', '655331', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2392, 2388, 0, 3, 0, '会泽县', '云南省曲靖市会泽县', '654200', '', 'hzx', 'H', 0);
INSERT INTO `tp_city` VALUES (2393, 2388, 0, 3, 0, '罗平县', '云南省曲靖市罗平县', '655800', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (2394, 2388, 0, 3, 0, '富源县', '云南省曲靖市富源县', '655500', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (2395, 2388, 0, 3, 0, '陆良县', '云南省曲靖市陆良县', '655600', '', 'llx', 'L', 0);
INSERT INTO `tp_city` VALUES (2396, 2388, 0, 3, 0, '师宗县', '云南省曲靖市师宗县', '655700', '', 'szx', 'S', 0);
INSERT INTO `tp_city` VALUES (2397, 2388, 0, 3, 0, '马龙县', '云南省曲靖市马龙县', '655100', '', 'mlx', 'M', 0);
INSERT INTO `tp_city` VALUES (2398, 2388, 0, 3, 0, '麒麟区', '云南省曲靖市麒麟区', '655000', '', 'q', 'Z', 0);
INSERT INTO `tp_city` VALUES (2399, 2376, 0, 2, 0, '昆明市', '云南省昆明市', '650000', '', 'kms', 'K', 0);
INSERT INTO `tp_city` VALUES (2400, 2399, 0, 3, 0, '其它区', '云南省昆明市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2401, 2399, 0, 3, 0, '安宁市', '云南省昆明市安宁市', '650300', '', 'ans', 'A', 0);
INSERT INTO `tp_city` VALUES (2402, 2399, 0, 3, 0, '呈贡区', '云南省昆明市呈贡区', '650500', '', 'cgq', 'C', 0);
INSERT INTO `tp_city` VALUES (2403, 2399, 0, 3, 0, '晋宁县', '云南省昆明市晋宁县', '650600', '', 'jnx', 'J', 0);
INSERT INTO `tp_city` VALUES (2404, 2399, 0, 3, 0, '宜良县', '云南省昆明市宜良县', '652100', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2405, 2399, 0, 3, 0, '富民县', '云南省昆明市富民县', '650400', '', 'fmx', 'F', 0);
INSERT INTO `tp_city` VALUES (2406, 2399, 0, 3, 0, '嵩明县', '云南省昆明市嵩明县', '651700', '', 'mx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2407, 2399, 0, 3, 0, '石林彝族自治县', '云南省昆明市石林彝族自治县', '652200', '', 'slyzzzx', 'S', 0);
INSERT INTO `tp_city` VALUES (2408, 2399, 0, 3, 0, '东川区', '云南省昆明市东川区', '654100', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (2409, 2399, 0, 3, 0, '西山区', '云南省昆明市西山区', '650100', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (2410, 2399, 0, 3, 0, '禄劝彝族苗族自治县', '云南省昆明市禄劝彝族苗族自治县', '651500', '', 'lqyzmzzzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2411, 2399, 0, 3, 0, '寻甸回族彝族自治县', '云南省昆明市寻甸回族彝族自治县', '655200', '', 'xdhzyzzzx', 'X', 0);
INSERT INTO `tp_city` VALUES (2412, 2399, 0, 3, 0, '官渡区', '云南省昆明市官渡区', '650220', '', 'gdq', 'G', 0);
INSERT INTO `tp_city` VALUES (2413, 2399, 0, 3, 0, '五华区', '云南省昆明市五华区', '650032', '', 'whq', 'W', 0);
INSERT INTO `tp_city` VALUES (2414, 2399, 0, 3, 0, '盘龙区', '云南省昆明市盘龙区', '650051', '', 'plq', 'P', 0);
INSERT INTO `tp_city` VALUES (2415, 2376, 0, 2, 0, '丽江市', '云南省丽江市', '', '', 'ljs', 'L', 0);
INSERT INTO `tp_city` VALUES (2416, 2415, 0, 3, 0, '玉龙纳西族自治县', '云南省丽江市玉龙纳西族自治县', '674100', '', 'ylnxzzzx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2417, 2415, 0, 3, 0, '永胜县', '云南省丽江市永胜县', '674200', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2418, 2415, 0, 3, 0, '华坪县', '云南省丽江市华坪县', '674800', '', 'hpx', 'H', 0);
INSERT INTO `tp_city` VALUES (2419, 2415, 0, 3, 0, '宁蒗彝族自治县', '云南省丽江市宁蒗彝族自治县', '674300', '', 'nyzzzx', 'N', 0);
INSERT INTO `tp_city` VALUES (2420, 2415, 0, 3, 0, '其它区', '云南省丽江市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2421, 2415, 0, 3, 0, '古城区', '云南省丽江市古城区', '674100', '', 'gcq', 'G', 0);
INSERT INTO `tp_city` VALUES (2422, 2376, 0, 2, 0, '普洱市', '云南省普洱市', '665000', '', 'pes', 'P', 0);
INSERT INTO `tp_city` VALUES (2423, 2422, 0, 3, 0, '思茅区', '云南省普洱市思茅区', '665000', '', 'smq', 'S', 0);
INSERT INTO `tp_city` VALUES (2424, 2422, 0, 3, 0, '景东县', '云南省普洱市景东县', '676200', '', 'jdx', 'J', 0);
INSERT INTO `tp_city` VALUES (2425, 2422, 0, 3, 0, '墨江县', '云南省普洱市墨江县', '654800', '', 'mjx', 'M', 0);
INSERT INTO `tp_city` VALUES (2426, 2422, 0, 3, 0, '宁洱哈尼族彝族自治县', '云南省普洱市宁洱哈尼族彝族自治县', '665100', '', 'nehnzyzzzx', 'N', 0);
INSERT INTO `tp_city` VALUES (2427, 2422, 0, 3, 0, '孟连傣族拉祜族佤族自治县', '云南省普洱市孟连傣族拉祜族佤族自治县', '665800', '', 'mldzlzzzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (2428, 2422, 0, 3, 0, '江城哈尼族彝族自治县', '云南省普洱市江城哈尼族彝族自治县', '665900', '', 'jchnzyzzzx', 'J', 0);
INSERT INTO `tp_city` VALUES (2429, 2422, 0, 3, 0, '镇沅彝族哈尼族拉祜族自治县', '云南省普洱市镇沅彝族哈尼族拉祜族自治县', '666500', '', 'zyzhnzlzzz', 'Z', 0);
INSERT INTO `tp_city` VALUES (2430, 2422, 0, 3, 0, '景谷傣族彝族自治县', '云南省普洱市景谷傣族彝族自治县', '666400', '', 'jgdzyzzzx', 'J', 0);
INSERT INTO `tp_city` VALUES (2431, 2422, 0, 3, 0, '其它区', '云南省普洱市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2432, 2422, 0, 3, 0, '西盟佤族自治县', '云南省普洱市西盟佤族自治县', '665700', '', 'xmzzzx', 'X', 0);
INSERT INTO `tp_city` VALUES (2433, 2422, 0, 3, 0, '澜沧拉祜族自治县', '云南省普洱市澜沧拉祜族自治县', '665600', '', 'lclzzzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2434, 2376, 0, 2, 0, '临沧市', '云南省临沧市', '', '', 'lcs', 'L', 0);
INSERT INTO `tp_city` VALUES (2435, 2434, 0, 3, 0, '双江拉祜族佤族布朗族傣族自治县', '云南省临沧市双江拉祜族佤族布朗族傣族自治县', '677300', '', 'sjlzzblzdz', 'S', 0);
INSERT INTO `tp_city` VALUES (2436, 2434, 0, 3, 0, '镇康县', '云南省临沧市镇康县', '677700', '', 'zkx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2437, 2434, 0, 3, 0, '沧源佤族自治县', '云南省临沧市沧源佤族自治县', '677400', '', 'cyzzzx', 'C', 0);
INSERT INTO `tp_city` VALUES (2438, 2434, 0, 3, 0, '耿马傣族佤族自治县', '云南省临沧市耿马傣族佤族自治县', '677500', '', 'gmdzzzzx', 'G', 0);
INSERT INTO `tp_city` VALUES (2439, 2434, 0, 3, 0, '凤庆县', '云南省临沧市凤庆县', '675900', '', 'fqx', 'F', 0);
INSERT INTO `tp_city` VALUES (2440, 2434, 0, 3, 0, '永德县', '云南省临沧市永德县', '677600', '', 'ydx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2441, 2434, 0, 3, 0, '云县', '云南省临沧市云县', '675800', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2442, 2434, 0, 3, 0, '其它区', '云南省临沧市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2443, 2434, 0, 3, 0, '临翔区', '云南省临沧市临翔区', '677000', '', 'lxq', 'L', 0);
INSERT INTO `tp_city` VALUES (2444, 2376, 0, 2, 0, '保山市', '云南省保山市', '', '', 'bss', 'B', 0);
INSERT INTO `tp_city` VALUES (2445, 2444, 0, 3, 0, '其它区', '云南省保山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2446, 2444, 0, 3, 0, '昌宁县', '云南省保山市昌宁县', '678100', '', 'cnx', 'C', 0);
INSERT INTO `tp_city` VALUES (2447, 2444, 0, 3, 0, '施甸县', '云南省保山市施甸县', '678200', '', 'sdx', 'S', 0);
INSERT INTO `tp_city` VALUES (2448, 2444, 0, 3, 0, '龙陵县', '云南省保山市龙陵县', '678300', '', 'llx', 'L', 0);
INSERT INTO `tp_city` VALUES (2449, 2444, 0, 3, 0, '腾冲县', '云南省保山市腾冲县', '679100', '', 'tcx', 'T', 0);
INSERT INTO `tp_city` VALUES (2450, 2444, 0, 3, 0, '隆阳区', '云南省保山市隆阳区', '678000', '', 'lyq', 'L', 0);
INSERT INTO `tp_city` VALUES (2451, 2376, 0, 2, 0, '昭通市', '云南省昭通市', '657000', '', 'zts', 'Z', 0);
INSERT INTO `tp_city` VALUES (2452, 2451, 0, 3, 0, '巧家县', '云南省昭通市巧家县', '654600', '', 'qjx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2453, 2451, 0, 3, 0, '盐津县', '云南省昭通市盐津县', '657500', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2454, 2451, 0, 3, 0, '鲁甸县', '云南省昭通市鲁甸县', '657100', '', 'ldx', 'L', 0);
INSERT INTO `tp_city` VALUES (2455, 2451, 0, 3, 0, '昭阳区', '云南省昭通市昭阳区', '657000', '', 'zyq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2456, 2451, 0, 3, 0, '威信县', '云南省昭通市威信县', '657900', '', 'wxx', 'W', 0);
INSERT INTO `tp_city` VALUES (2457, 2451, 0, 3, 0, '彝良县', '云南省昭通市彝良县', '657600', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2458, 2451, 0, 3, 0, '其它区', '云南省昭通市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2459, 2451, 0, 3, 0, '水富县', '云南省昭通市水富县', '657800', '', 'sfx', 'S', 0);
INSERT INTO `tp_city` VALUES (2460, 2451, 0, 3, 0, '永善县', '云南省昭通市永善县', '657300', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2461, 2451, 0, 3, 0, '大关县', '云南省昭通市大关县', '657400', '', 'dgx', 'D', 0);
INSERT INTO `tp_city` VALUES (2462, 2451, 0, 3, 0, '镇雄县', '云南省昭通市镇雄县', '657200', '', 'zxx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2463, 2451, 0, 3, 0, '绥江县', '云南省昭通市绥江县', '657700', '', 'sjx', 'S', 0);
INSERT INTO `tp_city` VALUES (2464, 2376, 0, 2, 0, '楚雄州', '云南省楚雄州', '', '', 'cxz', 'C', 0);
INSERT INTO `tp_city` VALUES (2465, 2464, 0, 3, 0, '楚雄市', '云南省楚雄州楚雄市', '675000', '', 'cxs', 'C', 0);
INSERT INTO `tp_city` VALUES (2466, 2464, 0, 3, 0, '双柏县', '云南省楚雄州双柏县', '675100', '', 'sbx', 'S', 0);
INSERT INTO `tp_city` VALUES (2467, 2464, 0, 3, 0, '牟定县', '云南省楚雄州牟定县', '675500', '', 'mdx', 'M', 0);
INSERT INTO `tp_city` VALUES (2468, 2464, 0, 3, 0, '南华县', '云南省楚雄州南华县', '675200', '', 'nhx', 'N', 0);
INSERT INTO `tp_city` VALUES (2469, 2464, 0, 3, 0, '姚安县', '云南省楚雄州姚安县', '675300', '', 'yax', 'Y', 0);
INSERT INTO `tp_city` VALUES (2470, 2464, 0, 3, 0, '大姚县', '云南省楚雄州大姚县', '675400', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (2471, 2464, 0, 3, 0, '永仁县', '云南省楚雄州永仁县', '651400', '', 'yrx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2472, 2464, 0, 3, 0, '元谋县', '云南省楚雄州元谋县', '651300', '', 'ymx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2473, 2464, 0, 3, 0, '武定县', '云南省楚雄州武定县', '651600', '', 'wdx', 'W', 0);
INSERT INTO `tp_city` VALUES (2474, 2464, 0, 3, 0, '禄丰县', '云南省楚雄州禄丰县', '651200', '', 'lfx', 'L', 0);
INSERT INTO `tp_city` VALUES (2475, 2464, 0, 3, 0, '其它区', '云南省楚雄州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2476, 2376, 0, 2, 0, '德宏州', '云南省德宏州', '', '', 'dhz', 'D', 0);
INSERT INTO `tp_city` VALUES (2477, 2476, 0, 3, 0, '陇川县', '云南省德宏州陇川县', '678700', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (2478, 2476, 0, 3, 0, '其它区', '云南省德宏州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2479, 2476, 0, 3, 0, '梁河县', '云南省德宏州梁河县', '679200', '', 'lhx', 'L', 0);
INSERT INTO `tp_city` VALUES (2480, 2476, 0, 3, 0, '盈江县', '云南省德宏州盈江县', '679300', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2481, 2476, 0, 3, 0, '芒市', '云南省德宏州芒市', '678400', '', 'ms', 'M', 0);
INSERT INTO `tp_city` VALUES (2482, 2476, 0, 3, 0, '瑞丽市', '云南省德宏州瑞丽市', '678600', '', 'rls', 'R', 0);
INSERT INTO `tp_city` VALUES (2483, 2376, 0, 2, 0, '迪庆州', '云南省迪庆州', '', '', 'dqz', 'D', 0);
INSERT INTO `tp_city` VALUES (2484, 2483, 0, 3, 0, '其它区', '云南省迪庆州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2485, 2483, 0, 3, 0, '德钦县', '云南省迪庆州德钦县', '674500', '', 'dqx', 'D', 0);
INSERT INTO `tp_city` VALUES (2486, 2483, 0, 3, 0, '维西傈县', '云南省迪庆州维西傈县', '674600', '', 'wxlx', 'W', 0);
INSERT INTO `tp_city` VALUES (2487, 2483, 0, 3, 0, '香格里拉县', '云南省迪庆州香格里拉县', '674400', '', 'xgllx', 'X', 0);
INSERT INTO `tp_city` VALUES (2488, 2376, 0, 2, 0, '怒江州', '云南省怒江州', '', '', 'njz', 'N', 0);
INSERT INTO `tp_city` VALUES (2489, 2488, 0, 3, 0, '泸水县', '云南省怒江州泸水县', '673100', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2490, 2488, 0, 3, 0, '福贡县', '云南省怒江州福贡县', '673400', '', 'fgx', 'F', 0);
INSERT INTO `tp_city` VALUES (2491, 2488, 0, 3, 0, '兰坪县', '云南省怒江州兰坪县', '671400', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (2492, 2488, 0, 3, 0, '贡山县', '云南省怒江州贡山县', '673500', '', 'gsx', 'G', 0);
INSERT INTO `tp_city` VALUES (2493, 2488, 0, 3, 0, '其它区', '云南省怒江州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2494, 2376, 0, 2, 0, '文山州', '云南省文山州', '', '', 'wsz', 'W', 0);
INSERT INTO `tp_city` VALUES (2495, 2494, 0, 3, 0, '砚山县', '云南省文山州砚山县', '663100', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2496, 2494, 0, 3, 0, '西畴县', '云南省文山州西畴县', '663500', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (2497, 2494, 0, 3, 0, '文山市', '云南省文山州文山市', '663000', '', 'wss', 'W', 0);
INSERT INTO `tp_city` VALUES (2498, 2494, 0, 3, 0, '广南县', '云南省文山州广南县', '663300', '', 'gnx', 'G', 0);
INSERT INTO `tp_city` VALUES (2499, 2494, 0, 3, 0, '丘北县', '云南省文山州丘北县', '663200', '', 'qbx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2500, 2494, 0, 3, 0, '马关县', '云南省文山州马关县', '663700', '', 'mgx', 'M', 0);
INSERT INTO `tp_city` VALUES (2501, 2494, 0, 3, 0, '麻栗坡县', '云南省文山州麻栗坡县', '663600', '', 'mlpx', 'M', 0);
INSERT INTO `tp_city` VALUES (2502, 2494, 0, 3, 0, '其它区', '云南省文山州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2503, 2494, 0, 3, 0, '富宁县', '云南省文山州富宁县', '663400', '', 'fnx', 'F', 0);
INSERT INTO `tp_city` VALUES (2504, 2376, 0, 2, 0, '红河州', '云南省红河州', '', '', 'hhz', 'H', 0);
INSERT INTO `tp_city` VALUES (2505, 2504, 0, 3, 0, '开远市', '云南省红河州开远市', '661600', '', 'kys', 'K', 0);
INSERT INTO `tp_city` VALUES (2506, 2504, 0, 3, 0, '个旧市', '云南省红河州个旧市', '661000', '', 'gjs', 'G', 0);
INSERT INTO `tp_city` VALUES (2507, 2504, 0, 3, 0, '屏边县', '云南省红河州屏边县', '661200', '', 'pbx', 'P', 0);
INSERT INTO `tp_city` VALUES (2508, 2504, 0, 3, 0, '蒙自市', '云南省红河州蒙自市', '661100', '', 'mzs', 'M', 0);
INSERT INTO `tp_city` VALUES (2509, 2504, 0, 3, 0, '石屏县', '云南省红河州石屏县', '662200', '', 'spx', 'S', 0);
INSERT INTO `tp_city` VALUES (2510, 2504, 0, 3, 0, '建水县', '云南省红河州建水县', '654300', '', 'jsx', 'J', 0);
INSERT INTO `tp_city` VALUES (2511, 2504, 0, 3, 0, '泸西县', '云南省红河州泸西县', '652400', '', 'xx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2512, 2504, 0, 3, 0, '弥勒市', '云南省红河州弥勒市', '652300', '', 'mls', 'M', 0);
INSERT INTO `tp_city` VALUES (2513, 2504, 0, 3, 0, '元阳县', '云南省红河州元阳县', '662400', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2514, 2504, 0, 3, 0, '红河县', '云南省红河州红河县', '654400', '', 'hhx', 'H', 0);
INSERT INTO `tp_city` VALUES (2515, 2504, 0, 3, 0, '金平苗族瑶族傣族自治县', '云南省红河州金平苗族瑶族傣族自治县', '661500', '', 'jpmzyzdzzz', 'J', 0);
INSERT INTO `tp_city` VALUES (2516, 2504, 0, 3, 0, '绿春县', '云南省红河州绿春县', '662500', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (2517, 2504, 0, 3, 0, '河口县', '云南省红河州河口县', '661300', '', 'hkx', 'H', 0);
INSERT INTO `tp_city` VALUES (2518, 2504, 0, 3, 0, '其它区', '云南省红河州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2519, 2376, 0, 2, 0, '大理白族自治州', '云南省大理白族自治州', '', '', 'dlbzzzz', 'D', 0);
INSERT INTO `tp_city` VALUES (2520, 2519, 0, 3, 0, '鹤庆县', '云南省大理白族自治州鹤庆县', '671500', '', 'hqx', 'H', 0);
INSERT INTO `tp_city` VALUES (2521, 2519, 0, 3, 0, '其它区', '云南省大理白族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2522, 2519, 0, 3, 0, '永平县', '云南省大理白族自治州永平县', '672600', '', 'ypx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2523, 2519, 0, 3, 0, '云龙县', '云南省大理白族自治州云龙县', '672700', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2524, 2519, 0, 3, 0, '洱源县', '云南省大理白族自治州洱源县', '671200', '', 'eyx', 'E', 0);
INSERT INTO `tp_city` VALUES (2525, 2519, 0, 3, 0, '剑川县', '云南省大理白族自治州剑川县', '671300', '', 'jcx', 'J', 0);
INSERT INTO `tp_city` VALUES (2526, 2519, 0, 3, 0, '祥云县', '云南省大理白族自治州祥云县', '672100', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (2527, 2519, 0, 3, 0, '漾濞县', '云南省大理白族自治州漾濞县', '672500', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2528, 2519, 0, 3, 0, '巍山县', '云南省大理白族自治州巍山县', '672400', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (2529, 2519, 0, 3, 0, '南涧县', '云南省大理白族自治州南涧县', '675700', '', 'njx', 'N', 0);
INSERT INTO `tp_city` VALUES (2530, 2519, 0, 3, 0, '弥渡县', '云南省大理白族自治州弥渡县', '675600', '', 'mdx', 'M', 0);
INSERT INTO `tp_city` VALUES (2531, 2519, 0, 3, 0, '宾川县', '云南省大理白族自治州宾川县', '671600', '', 'bcx', 'B', 0);
INSERT INTO `tp_city` VALUES (2532, 2519, 0, 3, 0, '大理市', '云南省大理白族自治州大理市', '671000', '', 'dls', 'D', 0);
INSERT INTO `tp_city` VALUES (2533, 2376, 0, 2, 0, '西双版纳州', '云南省西双版纳州', '', '', 'xsbnz', 'X', 0);
INSERT INTO `tp_city` VALUES (2534, 2533, 0, 3, 0, '其它区', '云南省西双版纳州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2535, 2533, 0, 3, 0, '勐海县', '云南省西双版纳州勐海县', '666200', '', 'hx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2536, 2533, 0, 3, 0, '勐腊县', '云南省西双版纳州勐腊县', '666300', '', 'lx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2537, 2533, 0, 3, 0, '景洪市', '云南省西双版纳州景洪市', '666100', '', 'jhs', 'J', 0);
INSERT INTO `tp_city` VALUES (2538, 0, 0, 1, 0, '贵州省', '贵州省', '', '', 'gzs', 'G', 0);
INSERT INTO `tp_city` VALUES (2539, 2538, 0, 2, 0, '安顺市', '贵州省安顺市', '561000', '', 'ass', 'A', 0);
INSERT INTO `tp_city` VALUES (2540, 2539, 0, 3, 0, '西秀区', '贵州省安顺市西秀区', '561000', '', 'xxq', 'X', 0);
INSERT INTO `tp_city` VALUES (2541, 2539, 0, 3, 0, '镇宁县', '贵州省安顺市镇宁县', '561200', '', 'znx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2542, 2539, 0, 3, 0, '普定县', '贵州省安顺市普定县', '562100', '', 'pdx', 'P', 0);
INSERT INTO `tp_city` VALUES (2543, 2539, 0, 3, 0, '平坝县', '贵州省安顺市平坝县', '561100', '', 'pbx', 'P', 0);
INSERT INTO `tp_city` VALUES (2544, 2539, 0, 3, 0, '其它区', '贵州省安顺市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2545, 2539, 0, 3, 0, '紫云县', '贵州省安顺市紫云县', '550800', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2546, 2539, 0, 3, 0, '关岭县', '贵州省安顺市关岭县', '561300', '', 'glx', 'G', 0);
INSERT INTO `tp_city` VALUES (2547, 2538, 0, 2, 0, '六盘水市', '贵州省六盘水市', '553000', '', 'lpss', 'L', 0);
INSERT INTO `tp_city` VALUES (2548, 2547, 0, 3, 0, '水城县', '贵州省六盘水市水城县', '553600', '', 'scx', 'S', 0);
INSERT INTO `tp_city` VALUES (2549, 2547, 0, 3, 0, '其它区', '贵州省六盘水市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2550, 2547, 0, 3, 0, '盘县', '贵州省六盘水市盘县', '561601', '', 'px', 'P', 0);
INSERT INTO `tp_city` VALUES (2551, 2547, 0, 3, 0, '钟山区', '贵州省六盘水市钟山区', '553000', '', 'zsq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2552, 2547, 0, 3, 0, '六枝特区', '贵州省六盘水市六枝特区', '553400', '', 'lztq', 'L', 0);
INSERT INTO `tp_city` VALUES (2553, 2538, 0, 2, 0, '遵义市', '贵州省遵义市', '563000', '', 'zys', 'Z', 0);
INSERT INTO `tp_city` VALUES (2554, 2553, 0, 3, 0, '遵义县', '贵州省遵义市遵义县', '563100', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2555, 2553, 0, 3, 0, '绥阳县', '贵州省遵义市绥阳县', '563300', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (2556, 2553, 0, 3, 0, '桐梓县', '贵州省遵义市桐梓县', '563200', '', 'tx', 'T', 0);
INSERT INTO `tp_city` VALUES (2557, 2553, 0, 3, 0, '道真县', '贵州省遵义市道真县', '563500', '', 'dzx', 'D', 0);
INSERT INTO `tp_city` VALUES (2558, 2553, 0, 3, 0, '正安县', '贵州省遵义市正安县', '563400', '', 'zax', 'Z', 0);
INSERT INTO `tp_city` VALUES (2559, 2553, 0, 3, 0, '凤冈县', '贵州省遵义市凤冈县', '564200', '', 'fgx', 'F', 0);
INSERT INTO `tp_city` VALUES (2560, 2553, 0, 3, 0, '务川县', '贵州省遵义市务川县', '564300', '', 'wcx', 'W', 0);
INSERT INTO `tp_city` VALUES (2561, 2553, 0, 3, 0, '余庆县', '贵州省遵义市余庆县', '564400', '', 'yqx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2562, 2553, 0, 3, 0, '湄潭县', '贵州省遵义市湄潭县', '564100', '', 'tx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2563, 2553, 0, 3, 0, '习水县', '贵州省遵义市习水县', '564600', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (2564, 2553, 0, 3, 0, '仁怀市', '贵州省遵义市仁怀市', '564500', '', 'rhs', 'R', 0);
INSERT INTO `tp_city` VALUES (2565, 2553, 0, 3, 0, '其它区', '贵州省遵义市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2566, 2553, 0, 3, 0, '赤水市', '贵州省遵义市赤水市', '564700', '', 'css', 'C', 0);
INSERT INTO `tp_city` VALUES (2567, 2553, 0, 3, 0, '红花岗区', '贵州省遵义市红花岗区', '563000', '', 'hhgq', 'H', 0);
INSERT INTO `tp_city` VALUES (2568, 2553, 0, 3, 0, '汇川区', '贵州省遵义市汇川区', '563000', '', 'hcq', 'H', 0);
INSERT INTO `tp_city` VALUES (2569, 2538, 0, 2, 0, '铜仁市', '贵州省铜仁市', '', '', 'trs', 'T', 0);
INSERT INTO `tp_city` VALUES (2570, 2569, 0, 3, 0, '玉屏县', '贵州省铜仁市玉屏县', '554000', '', 'ypx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2571, 2569, 0, 3, 0, '江口县', '贵州省铜仁市江口县', '554400', '', 'jkx', 'J', 0);
INSERT INTO `tp_city` VALUES (2572, 2569, 0, 3, 0, '石阡县', '贵州省铜仁市石阡县', '555100', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (2573, 2569, 0, 3, 0, '思南县', '贵州省铜仁市思南县', '565100', '', 'snx', 'S', 0);
INSERT INTO `tp_city` VALUES (2574, 2569, 0, 3, 0, '印江县', '贵州省铜仁市印江县', '555200', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2575, 2569, 0, 3, 0, '德江县', '贵州省铜仁市德江县', '565200', '', 'djx', 'D', 0);
INSERT INTO `tp_city` VALUES (2576, 2569, 0, 3, 0, '沿河县', '贵州省铜仁市沿河县', '565300', '', 'yhx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2577, 2569, 0, 3, 0, '松桃县', '贵州省铜仁市松桃县', '554100', '', 'stx', 'S', 0);
INSERT INTO `tp_city` VALUES (2578, 2569, 0, 3, 0, '万山区', '贵州省铜仁市万山区', '554200', '', 'wsq', 'W', 0);
INSERT INTO `tp_city` VALUES (2579, 2569, 0, 3, 0, '其它区', '贵州省铜仁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2580, 2569, 0, 3, 0, '碧江区', '贵州省铜仁市碧江区', '554300', '', 'bjq', 'B', 0);
INSERT INTO `tp_city` VALUES (2581, 2538, 0, 2, 0, '黔西南州', '贵州省黔西南州', '', '', 'qxnz', 'Q', 0);
INSERT INTO `tp_city` VALUES (2582, 2581, 0, 3, 0, '兴义市', '贵州省黔西南州兴义市', '562400', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (2583, 2581, 0, 3, 0, '其它区', '贵州省黔西南州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2584, 2581, 0, 3, 0, '安龙县', '贵州省黔西南州安龙县', '552400', '', 'alx', 'A', 0);
INSERT INTO `tp_city` VALUES (2585, 2581, 0, 3, 0, '贞丰县', '贵州省黔西南州贞丰县', '562200', '', 'zfx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2586, 2581, 0, 3, 0, '晴隆县', '贵州省黔西南州晴隆县', '561400', '', 'qlx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2587, 2581, 0, 3, 0, '册亨县', '贵州省黔西南州册亨县', '552200', '', 'chx', 'C', 0);
INSERT INTO `tp_city` VALUES (2588, 2581, 0, 3, 0, '望谟县', '贵州省黔西南州望谟县', '552300', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (2589, 2581, 0, 3, 0, '普安县', '贵州省黔西南州普安县', '561500', '', 'pax', 'P', 0);
INSERT INTO `tp_city` VALUES (2590, 2581, 0, 3, 0, '兴仁县', '贵州省黔西南州兴仁县', '562300', '', 'xrx', 'X', 0);
INSERT INTO `tp_city` VALUES (2591, 2538, 0, 2, 0, '毕节市', '贵州省毕节市', '', '', 'bjs', 'B', 0);
INSERT INTO `tp_city` VALUES (2592, 2591, 0, 3, 0, '七星关区', '贵州省毕节市七星关区', '551700', '', 'qxgq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2593, 2591, 0, 3, 0, '大方县', '贵州省毕节市大方县', '551600', '', 'dfx', 'D', 0);
INSERT INTO `tp_city` VALUES (2594, 2591, 0, 3, 0, '黔西县', '贵州省毕节市黔西县', '551500', '', 'qxx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2595, 2591, 0, 3, 0, '纳雍县', '贵州省毕节市纳雍县', '553300', '', 'nyx', 'N', 0);
INSERT INTO `tp_city` VALUES (2596, 2591, 0, 3, 0, '威宁县', '贵州省毕节市威宁县', '553100', '', 'wnx', 'W', 0);
INSERT INTO `tp_city` VALUES (2597, 2591, 0, 3, 0, '金沙县', '贵州省毕节市金沙县', '551800', '', 'jsx', 'J', 0);
INSERT INTO `tp_city` VALUES (2598, 2591, 0, 3, 0, '织金县', '贵州省毕节市织金县', '552100', '', 'zjx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2599, 2591, 0, 3, 0, '赫章县', '贵州省毕节市赫章县', '553200', '', 'hzx', 'H', 0);
INSERT INTO `tp_city` VALUES (2600, 2591, 0, 3, 0, '其它区', '贵州省毕节市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2601, 2538, 0, 2, 0, '黔东南州', '贵州省黔东南州', '', '', 'qdnz', 'Q', 0);
INSERT INTO `tp_city` VALUES (2602, 2601, 0, 3, 0, '施秉县', '贵州省黔东南州施秉县', '556200', '', 'sbx', 'S', 0);
INSERT INTO `tp_city` VALUES (2603, 2601, 0, 3, 0, '黄平县', '贵州省黔东南州黄平县', '556100', '', 'hpx', 'H', 0);
INSERT INTO `tp_city` VALUES (2604, 2601, 0, 3, 0, '凯里市', '贵州省黔东南州凯里市', '556000', '', 'kls', 'K', 0);
INSERT INTO `tp_city` VALUES (2605, 2601, 0, 3, 0, '天柱县', '贵州省黔东南州天柱县', '556600', '', 'tzx', 'T', 0);
INSERT INTO `tp_city` VALUES (2606, 2601, 0, 3, 0, '岑巩县', '贵州省黔东南州岑巩县', '557800', '', 'gx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2607, 2601, 0, 3, 0, '镇远县', '贵州省黔东南州镇远县', '557700', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2608, 2601, 0, 3, 0, '三穗县', '贵州省黔东南州三穗县', '556500', '', 'ssx', 'S', 0);
INSERT INTO `tp_city` VALUES (2609, 2601, 0, 3, 0, '黎平县', '贵州省黔东南州黎平县', '557300', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (2610, 2601, 0, 3, 0, '台江县', '贵州省黔东南州台江县', '556300', '', 'tjx', 'T', 0);
INSERT INTO `tp_city` VALUES (2611, 2601, 0, 3, 0, '剑河县', '贵州省黔东南州剑河县', '556400', '', 'jhx', 'J', 0);
INSERT INTO `tp_city` VALUES (2612, 2601, 0, 3, 0, '锦屏县', '贵州省黔东南州锦屏县', '556700', '', 'jpx', 'J', 0);
INSERT INTO `tp_city` VALUES (2613, 2601, 0, 3, 0, '麻江县', '贵州省黔东南州麻江县', '557600', '', 'mjx', 'M', 0);
INSERT INTO `tp_city` VALUES (2614, 2601, 0, 3, 0, '雷山县', '贵州省黔东南州雷山县', '557100', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (2615, 2601, 0, 3, 0, '从江县', '贵州省黔东南州从江县', '557400', '', 'cjx', 'C', 0);
INSERT INTO `tp_city` VALUES (2616, 2601, 0, 3, 0, '榕江县', '贵州省黔东南州榕江县', '557200', '', 'jx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2617, 2601, 0, 3, 0, '其它区', '贵州省黔东南州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2618, 2601, 0, 3, 0, '丹寨县', '贵州省黔东南州丹寨县', '557500', '', 'dzx', 'D', 0);
INSERT INTO `tp_city` VALUES (2619, 2538, 0, 2, 0, '黔南州', '贵州省黔南州', '', '', 'qnz', 'Q', 0);
INSERT INTO `tp_city` VALUES (2620, 2619, 0, 3, 0, '福泉市', '贵州省黔南州福泉市', '550500', '', 'fqs', 'F', 0);
INSERT INTO `tp_city` VALUES (2621, 2619, 0, 3, 0, '都匀市', '贵州省黔南州都匀市', '558000', '', 'dys', 'D', 0);
INSERT INTO `tp_city` VALUES (2622, 2619, 0, 3, 0, '瓮安县', '贵州省黔南州瓮安县', '550400', '', 'wax', 'W', 0);
INSERT INTO `tp_city` VALUES (2623, 2619, 0, 3, 0, '平塘县', '贵州省黔南州平塘县', '558300', '', 'ptx', 'P', 0);
INSERT INTO `tp_city` VALUES (2624, 2619, 0, 3, 0, '独山县', '贵州省黔南州独山县', '558200', '', 'dsx', 'D', 0);
INSERT INTO `tp_city` VALUES (2625, 2619, 0, 3, 0, '贵定县', '贵州省黔南州贵定县', '551300', '', 'gdx', 'G', 0);
INSERT INTO `tp_city` VALUES (2626, 2619, 0, 3, 0, '荔波县', '贵州省黔南州荔波县', '558400', '', 'lbx', 'L', 0);
INSERT INTO `tp_city` VALUES (2627, 2619, 0, 3, 0, '其它区', '贵州省黔南州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2628, 2619, 0, 3, 0, '三都县', '贵州省黔南州三都县', '558100', '', 'sdx', 'S', 0);
INSERT INTO `tp_city` VALUES (2629, 2619, 0, 3, 0, '长顺县', '贵州省黔南州长顺县', '550700', '', 'csx', 'C', 0);
INSERT INTO `tp_city` VALUES (2630, 2619, 0, 3, 0, '罗甸县', '贵州省黔南州罗甸县', '550100', '', 'ldx', 'L', 0);
INSERT INTO `tp_city` VALUES (2631, 2619, 0, 3, 0, '惠水县', '贵州省黔南州惠水县', '550600', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (2632, 2619, 0, 3, 0, '龙里县', '贵州省黔南州龙里县', '551200', '', 'llx', 'L', 0);
INSERT INTO `tp_city` VALUES (2633, 2538, 0, 2, 0, '贵阳市', '贵州省贵阳市', '550000', '', 'gys', 'G', 0);
INSERT INTO `tp_city` VALUES (2634, 2633, 0, 3, 0, '观山湖区', '贵州省贵阳市观山湖区', '', '', 'gshq', 'G', 0);
INSERT INTO `tp_city` VALUES (2635, 2633, 0, 3, 0, '清镇市', '贵州省贵阳市清镇市', '551400', '', 'qzs', 'Q', 0);
INSERT INTO `tp_city` VALUES (2636, 2633, 0, 3, 0, '其它区', '贵州省贵阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2637, 2633, 0, 3, 0, '开阳县', '贵州省贵阳市开阳县', '550300', '', 'kyx', 'K', 0);
INSERT INTO `tp_city` VALUES (2638, 2633, 0, 3, 0, '修文县', '贵州省贵阳市修文县', '550200', '', 'xwx', 'X', 0);
INSERT INTO `tp_city` VALUES (2639, 2633, 0, 3, 0, '息烽县', '贵州省贵阳市息烽县', '551100', '', 'xfx', 'X', 0);
INSERT INTO `tp_city` VALUES (2640, 2633, 0, 3, 0, '白云区', '贵州省贵阳市白云区', '550014', '', 'byq', 'B', 0);
INSERT INTO `tp_city` VALUES (2641, 2633, 0, 3, 0, '乌当区', '贵州省贵阳市乌当区', '550018', '', 'wdq', 'W', 0);
INSERT INTO `tp_city` VALUES (2642, 2633, 0, 3, 0, '小河区', '贵州省贵阳市小河区', '550009', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (2643, 2633, 0, 3, 0, '花溪区', '贵州省贵阳市花溪区', '550025', '', 'hxq', 'H', 0);
INSERT INTO `tp_city` VALUES (2644, 2633, 0, 3, 0, '南明区', '贵州省贵阳市南明区', '550002', '', 'nmq', 'N', 0);
INSERT INTO `tp_city` VALUES (2645, 2633, 0, 3, 0, '云岩区', '贵州省贵阳市云岩区', '550001', '', 'yyq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2646, 0, 0, 1, 0, '江苏省', '江苏省', '', '', 'jss', 'J', 0);
INSERT INTO `tp_city` VALUES (2647, 2646, 0, 2, 0, '宿迁市', '江苏省宿迁市', '223800', '', 'sqs', 'S', 0);
INSERT INTO `tp_city` VALUES (2648, 2647, 0, 3, 0, '泗洪县', '江苏省宿迁市泗洪县', '223900', '', 'hx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2649, 2647, 0, 3, 0, '其它区', '江苏省宿迁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2650, 2647, 0, 3, 0, '沭阳县', '江苏省宿迁市沭阳县', '223600', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2651, 2647, 0, 3, 0, '泗阳县', '江苏省宿迁市泗阳县', '223700', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2652, 2647, 0, 3, 0, '宿城区', '江苏省宿迁市宿城区', '223800', '', 'scq', 'S', 0);
INSERT INTO `tp_city` VALUES (2653, 2647, 0, 3, 0, '宿豫区', '江苏省宿迁市宿豫区', '223800', '', 'syq', 'S', 0);
INSERT INTO `tp_city` VALUES (2654, 2646, 0, 2, 0, '泰州市', '江苏省泰州市', '225300', '', 'tzs', 'T', 0);
INSERT INTO `tp_city` VALUES (2655, 2654, 0, 3, 0, '姜堰区', '江苏省泰州市姜堰区', '225500', '', 'jyq', 'J', 0);
INSERT INTO `tp_city` VALUES (2656, 2654, 0, 3, 0, '其它区', '江苏省泰州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2657, 2654, 0, 3, 0, '兴化市', '江苏省泰州市兴化市', '225700', '', 'xhs', 'X', 0);
INSERT INTO `tp_city` VALUES (2658, 2654, 0, 3, 0, '靖江市', '江苏省泰州市靖江市', '214500', '', 'jjs', 'J', 0);
INSERT INTO `tp_city` VALUES (2659, 2654, 0, 3, 0, '泰兴市', '江苏省泰州市泰兴市', '225400', '', 'txs', 'T', 0);
INSERT INTO `tp_city` VALUES (2660, 2654, 0, 3, 0, '海陵区', '江苏省泰州市海陵区', '225300', '', 'hlq', 'H', 0);
INSERT INTO `tp_city` VALUES (2661, 2654, 0, 3, 0, '高港区', '江苏省泰州市高港区', '225321', '', 'ggq', 'G', 0);
INSERT INTO `tp_city` VALUES (2662, 2646, 0, 2, 0, '镇江市', '江苏省镇江市', '212000', '', 'zjs', 'Z', 0);
INSERT INTO `tp_city` VALUES (2663, 2662, 0, 3, 0, '其它区', '江苏省镇江市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2664, 2662, 0, 3, 0, '扬中市', '江苏省镇江市扬中市', '212200', '', 'yzs', 'Y', 0);
INSERT INTO `tp_city` VALUES (2665, 2662, 0, 3, 0, '句容市', '江苏省镇江市句容市', '212400', '', 'jrs', 'J', 0);
INSERT INTO `tp_city` VALUES (2666, 2662, 0, 3, 0, '丹阳市', '江苏省镇江市丹阳市', '212300', '', 'dys', 'D', 0);
INSERT INTO `tp_city` VALUES (2667, 2662, 0, 3, 0, '京口区', '江苏省镇江市京口区', '212001', '', 'jkq', 'J', 0);
INSERT INTO `tp_city` VALUES (2668, 2662, 0, 3, 0, '润州区', '江苏省镇江市润州区', '212004', '', 'rzq', 'R', 0);
INSERT INTO `tp_city` VALUES (2669, 2662, 0, 3, 0, '丹徒区', '江苏省镇江市丹徒区', '212001', '', 'dtq', 'D', 0);
INSERT INTO `tp_city` VALUES (2670, 2646, 0, 2, 0, '扬州市', '江苏省扬州市', '225000', '', 'yzs', 'Y', 0);
INSERT INTO `tp_city` VALUES (2671, 2670, 0, 3, 0, '江都区', '江苏省扬州市江都区', '225200', '', 'jdq', 'J', 0);
INSERT INTO `tp_city` VALUES (2672, 2670, 0, 3, 0, '经济开发区', '江苏省扬州市经济开发区', '', '', 'jjkfq', 'J', 0);
INSERT INTO `tp_city` VALUES (2673, 2670, 0, 3, 0, '其它区', '江苏省扬州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2674, 2670, 0, 3, 0, '高邮市', '江苏省扬州市高邮市', '225600', '', 'gys', 'G', 0);
INSERT INTO `tp_city` VALUES (2675, 2670, 0, 3, 0, '仪征市', '江苏省扬州市仪征市', '211400', '', 'yzs', 'Y', 0);
INSERT INTO `tp_city` VALUES (2676, 2670, 0, 3, 0, '宝应县', '江苏省扬州市宝应县', '225800', '', 'byx', 'B', 0);
INSERT INTO `tp_city` VALUES (2677, 2670, 0, 3, 0, '维扬区', '江苏省扬州市维扬区', '225002', '', 'wyq', 'W', 0);
INSERT INTO `tp_city` VALUES (2678, 2670, 0, 3, 0, '邗江区', '江苏省扬州市邗江区', '225100', '', 'jq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2679, 2670, 0, 3, 0, '广陵区', '江苏省扬州市广陵区', '225002', '', 'glq', 'G', 0);
INSERT INTO `tp_city` VALUES (2680, 2646, 0, 2, 0, '盐城市', '江苏省盐城市', '224000', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (2681, 2680, 0, 3, 0, '东台市', '江苏省盐城市东台市', '224200', '', 'dts', 'D', 0);
INSERT INTO `tp_city` VALUES (2682, 2680, 0, 3, 0, '大丰市', '江苏省盐城市大丰市', '224100', '', 'dfs', 'D', 0);
INSERT INTO `tp_city` VALUES (2683, 2680, 0, 3, 0, '其它区', '江苏省盐城市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2684, 2680, 0, 3, 0, '响水县', '江苏省盐城市响水县', '224600', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (2685, 2680, 0, 3, 0, '滨海县', '江苏省盐城市滨海县', '224500', '', 'bhx', 'B', 0);
INSERT INTO `tp_city` VALUES (2686, 2680, 0, 3, 0, '阜宁县', '江苏省盐城市阜宁县', '224400', '', 'fnx', 'F', 0);
INSERT INTO `tp_city` VALUES (2687, 2680, 0, 3, 0, '射阳县', '江苏省盐城市射阳县', '224300', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (2688, 2680, 0, 3, 0, '建湖县', '江苏省盐城市建湖县', '224700', '', 'jhx', 'J', 0);
INSERT INTO `tp_city` VALUES (2689, 2680, 0, 3, 0, '盐都区', '江苏省盐城市盐都区', '224055', '', 'ydq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2690, 2680, 0, 3, 0, '亭湖区', '江苏省盐城市亭湖区', '224005', '', 'thq', 'T', 0);
INSERT INTO `tp_city` VALUES (2691, 2646, 0, 2, 0, '淮安市', '江苏省淮安市', '223200', '', 'has', 'H', 0);
INSERT INTO `tp_city` VALUES (2692, 2691, 0, 3, 0, '其它区', '江苏省淮安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2693, 2691, 0, 3, 0, '涟水县', '江苏省淮安市涟水县', '223400', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (2694, 2691, 0, 3, 0, '金湖县', '江苏省淮安市金湖县', '211600', '', 'jhx', 'J', 0);
INSERT INTO `tp_city` VALUES (2695, 2691, 0, 3, 0, '盱眙县', '江苏省淮安市盱眙县', '211700', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (2696, 2691, 0, 3, 0, '洪泽县', '江苏省淮安市洪泽县', '223100', '', 'hzx', 'H', 0);
INSERT INTO `tp_city` VALUES (2697, 2691, 0, 3, 0, '清河区', '江苏省淮安市清河区', '223001', '', 'qhq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2698, 2691, 0, 3, 0, '淮安区', '江苏省淮安市淮安区', '223200', '', 'haq', 'H', 0);
INSERT INTO `tp_city` VALUES (2699, 2691, 0, 3, 0, '淮阴区', '江苏省淮安市淮阴区', '223000', '', 'hyq', 'H', 0);
INSERT INTO `tp_city` VALUES (2700, 2691, 0, 3, 0, '清浦区', '江苏省淮安市清浦区', '223002', '', 'qpq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2701, 2646, 0, 2, 0, '连云港市', '江苏省连云港市', '222000', '', 'lygs', 'L', 0);
INSERT INTO `tp_city` VALUES (2702, 2701, 0, 3, 0, '海州区', '江苏省连云港市海州区', '222023', '', 'hzq', 'H', 0);
INSERT INTO `tp_city` VALUES (2703, 2701, 0, 3, 0, '新浦区', '江苏省连云港市新浦区', '222003', '', 'xpq', 'X', 0);
INSERT INTO `tp_city` VALUES (2704, 2701, 0, 3, 0, '灌南县', '江苏省连云港市灌南县', '222500', '', 'gnx', 'G', 0);
INSERT INTO `tp_city` VALUES (2705, 2701, 0, 3, 0, '其它区', '江苏省连云港市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2706, 2701, 0, 3, 0, '东海县', '江苏省连云港市东海县', '222300', '', 'dhx', 'D', 0);
INSERT INTO `tp_city` VALUES (2707, 2701, 0, 3, 0, '灌云县', '江苏省连云港市灌云县', '222200', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (2708, 2701, 0, 3, 0, '赣榆县', '江苏省连云港市赣榆县', '222100', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (2709, 2701, 0, 3, 0, '连云区', '江苏省连云港市连云区', '222042', '', 'lyq', 'L', 0);
INSERT INTO `tp_city` VALUES (2710, 2646, 0, 2, 0, '南通市', '江苏省南通市', '226000', '', 'nts', 'N', 0);
INSERT INTO `tp_city` VALUES (2711, 2710, 0, 3, 0, '启东市', '江苏省南通市启东市', '226200', '', 'qds', 'Q', 0);
INSERT INTO `tp_city` VALUES (2712, 2710, 0, 3, 0, '通州市', '江苏省南通市通州市', '226300', '', 'tzs', 'T', 0);
INSERT INTO `tp_city` VALUES (2713, 2710, 0, 3, 0, '如皋市', '江苏省南通市如皋市', '226500', '', 'rgs', 'R', 0);
INSERT INTO `tp_city` VALUES (2714, 2710, 0, 3, 0, '海门市', '江苏省南通市海门市', '226100', '', 'hms', 'H', 0);
INSERT INTO `tp_city` VALUES (2715, 2710, 0, 3, 0, '开发区', '江苏省南通市开发区', '', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (2716, 2710, 0, 3, 0, '其它区', '江苏省南通市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2717, 2710, 0, 3, 0, '崇川区', '江苏省南通市崇川区', '226001', '', 'ccq', 'C', 0);
INSERT INTO `tp_city` VALUES (2718, 2710, 0, 3, 0, '通州区', '江苏省南通市通州区', '226321', '', 'tzq', 'T', 0);
INSERT INTO `tp_city` VALUES (2719, 2710, 0, 3, 0, '港闸区', '江苏省南通市港闸区', '226001', '', 'gzq', 'G', 0);
INSERT INTO `tp_city` VALUES (2720, 2710, 0, 3, 0, '海安县', '江苏省南通市海安县', '226600', '', 'hax', 'H', 0);
INSERT INTO `tp_city` VALUES (2721, 2710, 0, 3, 0, '如东县', '江苏省南通市如东县', '226400', '', 'rdx', 'R', 0);
INSERT INTO `tp_city` VALUES (2722, 2646, 0, 2, 0, '常州市', '江苏省常州市', '213000', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (2723, 2722, 0, 3, 0, '钟楼区', '江苏省常州市钟楼区', '213002', '', 'zlq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2724, 2722, 0, 3, 0, '戚墅堰区', '江苏省常州市戚墅堰区', '213011', '', 'qsyq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2725, 2722, 0, 3, 0, '天宁区', '江苏省常州市天宁区', '213003', '', 'tnq', 'T', 0);
INSERT INTO `tp_city` VALUES (2726, 2722, 0, 3, 0, '武进区', '江苏省常州市武进区', '213161', '', 'wjq', 'W', 0);
INSERT INTO `tp_city` VALUES (2727, 2722, 0, 3, 0, '新北区', '江苏省常州市新北区', '213001', '', 'xbq', 'X', 0);
INSERT INTO `tp_city` VALUES (2728, 2722, 0, 3, 0, '其它区', '江苏省常州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2729, 2722, 0, 3, 0, '金坛市', '江苏省常州市金坛市', '213200', '', 'jts', 'J', 0);
INSERT INTO `tp_city` VALUES (2730, 2722, 0, 3, 0, '溧阳市', '江苏省常州市溧阳市', '213300', '', 'ys', 'Z', 0);
INSERT INTO `tp_city` VALUES (2731, 2646, 0, 2, 0, '苏州市', '江苏省苏州市', '215000', '', 'szs', 'S', 0);
INSERT INTO `tp_city` VALUES (2732, 2731, 0, 3, 0, '张家港市', '江苏省苏州市张家港市', '215600', '', 'zjgs', 'Z', 0);
INSERT INTO `tp_city` VALUES (2733, 2731, 0, 3, 0, '昆山市', '江苏省苏州市昆山市', '215300', '', 'kss', 'K', 0);
INSERT INTO `tp_city` VALUES (2734, 2731, 0, 3, 0, '常熟市', '江苏省苏州市常熟市', '215500', '', 'css', 'C', 0);
INSERT INTO `tp_city` VALUES (2735, 2731, 0, 3, 0, '吴江区', '江苏省苏州市吴江区', '215200', '', 'wjq', 'W', 0);
INSERT INTO `tp_city` VALUES (2736, 2731, 0, 3, 0, '太仓市', '江苏省苏州市太仓市', '215400', '', 'tcs', 'T', 0);
INSERT INTO `tp_city` VALUES (2737, 2731, 0, 3, 0, '其它区', '江苏省苏州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2738, 2731, 0, 3, 0, '园区', '江苏省苏州市园区', '', '', 'yq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2739, 2731, 0, 3, 0, '新区', '江苏省苏州市新区', '', '', 'xq', 'X', 0);
INSERT INTO `tp_city` VALUES (2740, 2731, 0, 3, 0, '沧浪区', '江苏省苏州市沧浪区', '215006', '', 'clq', 'C', 0);
INSERT INTO `tp_city` VALUES (2741, 2731, 0, 3, 0, '平江区', '江苏省苏州市平江区', '215005', '', 'pjq', 'P', 0);
INSERT INTO `tp_city` VALUES (2742, 2731, 0, 3, 0, '吴中区', '江苏省苏州市吴中区', '215128', '', 'wzq', 'W', 0);
INSERT INTO `tp_city` VALUES (2743, 2731, 0, 3, 0, '相城区', '江苏省苏州市相城区', '215131', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (2744, 2731, 0, 3, 0, '金阊区', '江苏省苏州市金阊区', '215008', '', 'jq', 'J', 0);
INSERT INTO `tp_city` VALUES (2745, 2731, 0, 3, 0, '虎丘区', '江苏省苏州市虎丘区', '215004', '', 'hqq', 'H', 0);
INSERT INTO `tp_city` VALUES (2746, 2731, 0, 3, 0, '姑苏区', '江苏省苏州市姑苏区', '', '', 'gsq', 'G', 0);
INSERT INTO `tp_city` VALUES (2747, 2646, 0, 2, 0, '徐州市', '江苏省徐州市', '221000', '', 'xzs', 'X', 0);
INSERT INTO `tp_city` VALUES (2748, 2747, 0, 3, 0, '泉山区', '江苏省徐州市泉山区', '220006', '', 'qsq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2749, 2747, 0, 3, 0, '贾汪区', '江苏省徐州市贾汪区', '220011', '', 'jwq', 'J', 0);
INSERT INTO `tp_city` VALUES (2750, 2747, 0, 3, 0, '九里区', '江苏省徐州市九里区', '220040', '', 'jlq', 'J', 0);
INSERT INTO `tp_city` VALUES (2751, 2747, 0, 3, 0, '鼓楼区', '江苏省徐州市鼓楼区', '220005', '', 'glq', 'G', 0);
INSERT INTO `tp_city` VALUES (2752, 2747, 0, 3, 0, '云龙区', '江苏省徐州市云龙区', '220009', '', 'ylq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2753, 2747, 0, 3, 0, '其它区', '江苏省徐州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2754, 2747, 0, 3, 0, '邳州市', '江苏省徐州市邳州市', '221300', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (2755, 2747, 0, 3, 0, '新沂市', '江苏省徐州市新沂市', '221400', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (2756, 2747, 0, 3, 0, '丰县', '江苏省徐州市丰县', '221700', '', 'fx', 'F', 0);
INSERT INTO `tp_city` VALUES (2757, 2747, 0, 3, 0, '沛县', '江苏省徐州市沛县', '221600', '', 'px', 'P', 0);
INSERT INTO `tp_city` VALUES (2758, 2747, 0, 3, 0, '铜山区', '江苏省徐州市铜山区', '221112', '', 'tsq', 'T', 0);
INSERT INTO `tp_city` VALUES (2759, 2747, 0, 3, 0, '睢宁县', '江苏省徐州市睢宁县', '221200', '', 'nx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2760, 2646, 0, 2, 0, '无锡市', '江苏省无锡市', '214000', '', 'wxs', 'W', 0);
INSERT INTO `tp_city` VALUES (2761, 2760, 0, 3, 0, '新区', '江苏省无锡市新区', '', '', 'xq', 'X', 0);
INSERT INTO `tp_city` VALUES (2762, 2760, 0, 3, 0, '其它区', '江苏省无锡市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2763, 2760, 0, 3, 0, '江阴市', '江苏省无锡市江阴市', '214400', '', 'jys', 'J', 0);
INSERT INTO `tp_city` VALUES (2764, 2760, 0, 3, 0, '宜兴市', '江苏省无锡市宜兴市', '214200', '', 'yxs', 'Y', 0);
INSERT INTO `tp_city` VALUES (2765, 2760, 0, 3, 0, '南长区', '江苏省无锡市南长区', '214021', '', 'ncq', 'N', 0);
INSERT INTO `tp_city` VALUES (2766, 2760, 0, 3, 0, '崇安区', '江苏省无锡市崇安区', '214002', '', 'caq', 'C', 0);
INSERT INTO `tp_city` VALUES (2767, 2760, 0, 3, 0, '惠山区', '江苏省无锡市惠山区', '214187', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (2768, 2760, 0, 3, 0, '锡山区', '江苏省无锡市锡山区', '214101', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (2769, 2760, 0, 3, 0, '北塘区', '江苏省无锡市北塘区', '214044', '', 'btq', 'B', 0);
INSERT INTO `tp_city` VALUES (2770, 2760, 0, 3, 0, '滨湖区', '江苏省无锡市滨湖区', '214062', '', 'bhq', 'B', 0);
INSERT INTO `tp_city` VALUES (2771, 2646, 0, 2, 0, '南京市', '江苏省南京市', '210000', '', 'njs', 'N', 0);
INSERT INTO `tp_city` VALUES (2772, 2771, 0, 3, 0, '秦淮区', '江苏省南京市秦淮区', '210001', '', 'qhq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2773, 2771, 0, 3, 0, '建邺区', '江苏省南京市建邺区', '210004', '', 'jq', 'J', 0);
INSERT INTO `tp_city` VALUES (2774, 2771, 0, 3, 0, '鼓楼区', '江苏省南京市鼓楼区', '210009', '', 'glq', 'G', 0);
INSERT INTO `tp_city` VALUES (2775, 2771, 0, 3, 0, '下关区', '江苏省南京市下关区', '210011', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (2776, 2771, 0, 3, 0, '浦口区', '江苏省南京市浦口区', '211800', '', 'pkq', 'P', 0);
INSERT INTO `tp_city` VALUES (2777, 2771, 0, 3, 0, '玄武区', '江苏省南京市玄武区', '210018', '', 'xwq', 'X', 0);
INSERT INTO `tp_city` VALUES (2778, 2771, 0, 3, 0, '白下区', '江苏省南京市白下区', '210002', '', 'bxq', 'B', 0);
INSERT INTO `tp_city` VALUES (2779, 2771, 0, 3, 0, '高淳区', '江苏省南京市高淳区', '211300', '', 'gcq', 'G', 0);
INSERT INTO `tp_city` VALUES (2780, 2771, 0, 3, 0, '溧水区', '江苏省南京市溧水区', '211200', '', 'sq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2781, 2771, 0, 3, 0, '其它区', '江苏省南京市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2782, 2771, 0, 3, 0, '栖霞区', '江苏省南京市栖霞区', '210046', '', 'qxq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2783, 2771, 0, 3, 0, '江宁区', '江苏省南京市江宁区', '211100', '', 'jnq', 'J', 0);
INSERT INTO `tp_city` VALUES (2784, 2771, 0, 3, 0, '雨花台区', '江苏省南京市雨花台区', '210012', '', 'yhtq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2785, 2771, 0, 3, 0, '六合区', '江苏省南京市六合区', '211500', '', 'lhq', 'L', 0);
INSERT INTO `tp_city` VALUES (2786, 0, 0, 1, 0, '西藏自治区', '西藏自治区', '', '', 'xczzq', 'X', 0);
INSERT INTO `tp_city` VALUES (2787, 2786, 0, 2, 0, '拉萨市', '西藏自治区拉萨市', '850000', '', 'lss', 'L', 0);
INSERT INTO `tp_city` VALUES (2788, 2787, 0, 3, 0, '其它区', '西藏自治区拉萨市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2789, 2787, 0, 3, 0, '城关区', '西藏自治区拉萨市城关区', '850000', '', 'cgq', 'C', 0);
INSERT INTO `tp_city` VALUES (2790, 2787, 0, 3, 0, '曲水县', '西藏自治区拉萨市曲水县', '850600', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2791, 2787, 0, 3, 0, '堆龙德庆县', '西藏自治区拉萨市堆龙德庆县', '851400', '', 'dldqx', 'D', 0);
INSERT INTO `tp_city` VALUES (2792, 2787, 0, 3, 0, '达孜县', '西藏自治区拉萨市达孜县', '850100', '', 'dzx', 'D', 0);
INSERT INTO `tp_city` VALUES (2793, 2787, 0, 3, 0, '墨竹工卡县', '西藏自治区拉萨市墨竹工卡县', '850200', '', 'mzgkx', 'M', 0);
INSERT INTO `tp_city` VALUES (2794, 2787, 0, 3, 0, '林周县', '西藏自治区拉萨市林周县', '851600', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2795, 2787, 0, 3, 0, '当雄县', '西藏自治区拉萨市当雄县', '851500', '', 'dxx', 'D', 0);
INSERT INTO `tp_city` VALUES (2796, 2787, 0, 3, 0, '尼木县', '西藏自治区拉萨市尼木县', '851300', '', 'nmx', 'N', 0);
INSERT INTO `tp_city` VALUES (2797, 2786, 0, 2, 0, '山南地区', '西藏自治区山南地区', '', '', 'sndq', 'S', 0);
INSERT INTO `tp_city` VALUES (2798, 2797, 0, 3, 0, '乃东县', '西藏自治区山南地区乃东县', '856100', '', 'ndx', 'N', 0);
INSERT INTO `tp_city` VALUES (2799, 2797, 0, 3, 0, '贡嘎县', '西藏自治区山南地区贡嘎县', '850700', '', 'ggx', 'G', 0);
INSERT INTO `tp_city` VALUES (2800, 2797, 0, 3, 0, '扎囊县', '西藏自治区山南地区扎囊县', '850800', '', 'znx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2801, 2797, 0, 3, 0, '桑日县', '西藏自治区山南地区桑日县', '856200', '', 'srx', 'S', 0);
INSERT INTO `tp_city` VALUES (2802, 2797, 0, 3, 0, '琼结县', '西藏自治区山南地区琼结县', '856800', '', 'qjx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2803, 2797, 0, 3, 0, '曲松县', '西藏自治区山南地区曲松县', '856300', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2804, 2797, 0, 3, 0, '措美县', '西藏自治区山南地区措美县', '856900', '', 'cmx', 'C', 0);
INSERT INTO `tp_city` VALUES (2805, 2797, 0, 3, 0, '洛扎县', '西藏自治区山南地区洛扎县', '851200', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2806, 2797, 0, 3, 0, '加查县', '西藏自治区山南地区加查县', '856400', '', 'jcx', 'J', 0);
INSERT INTO `tp_city` VALUES (2807, 2797, 0, 3, 0, '隆子县', '西藏自治区山南地区隆子县', '856600', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2808, 2797, 0, 3, 0, '错那县', '西藏自治区山南地区错那县', '856700', '', 'cnx', 'C', 0);
INSERT INTO `tp_city` VALUES (2809, 2797, 0, 3, 0, '浪卡子县', '西藏自治区山南地区浪卡子县', '851100', '', 'lkzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2810, 2797, 0, 3, 0, '其它区', '西藏自治区山南地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2811, 2786, 0, 2, 0, '昌都地区', '西藏自治区昌都地区', '', '', 'cddq', 'C', 0);
INSERT INTO `tp_city` VALUES (2812, 2811, 0, 3, 0, '边坝县', '西藏自治区昌都地区边坝县', '855500', '', 'bbx', 'B', 0);
INSERT INTO `tp_city` VALUES (2813, 2811, 0, 3, 0, '洛隆县', '西藏自治区昌都地区洛隆县', '855400', '', 'llx', 'L', 0);
INSERT INTO `tp_city` VALUES (2814, 2811, 0, 3, 0, '其它区', '西藏自治区昌都地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2815, 2811, 0, 3, 0, '芒康县', '西藏自治区昌都地区芒康县', '854500', '', 'mkx', 'M', 0);
INSERT INTO `tp_city` VALUES (2816, 2811, 0, 3, 0, '左贡县', '西藏自治区昌都地区左贡县', '854400', '', 'zgx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2817, 2811, 0, 3, 0, '类乌齐县', '西藏自治区昌都地区类乌齐县', '855600', '', 'lwqx', 'L', 0);
INSERT INTO `tp_city` VALUES (2818, 2811, 0, 3, 0, '丁青县', '西藏自治区昌都地区丁青县', '855700', '', 'dqx', 'D', 0);
INSERT INTO `tp_city` VALUES (2819, 2811, 0, 3, 0, '察雅县', '西藏自治区昌都地区察雅县', '854300', '', 'cyx', 'C', 0);
INSERT INTO `tp_city` VALUES (2820, 2811, 0, 3, 0, '八宿县', '西藏自治区昌都地区八宿县', '854600', '', 'bsx', 'B', 0);
INSERT INTO `tp_city` VALUES (2821, 2811, 0, 3, 0, '昌都县', '西藏自治区昌都地区昌都县', '854000', '', 'cdx', 'C', 0);
INSERT INTO `tp_city` VALUES (2822, 2811, 0, 3, 0, '江达县', '西藏自治区昌都地区江达县', '854100', '', 'jdx', 'J', 0);
INSERT INTO `tp_city` VALUES (2823, 2811, 0, 3, 0, '贡觉县', '西藏自治区昌都地区贡觉县', '854200', '', 'gjx', 'G', 0);
INSERT INTO `tp_city` VALUES (2824, 2786, 0, 2, 0, '日喀则地区', '西藏自治区日喀则地区', '', '', 'rkzdq', 'R', 0);
INSERT INTO `tp_city` VALUES (2825, 2824, 0, 3, 0, '拉孜县', '西藏自治区日喀则地区拉孜县', '858100', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2826, 2824, 0, 3, 0, '昂仁县', '西藏自治区日喀则地区昂仁县', '858500', '', 'arx', 'A', 0);
INSERT INTO `tp_city` VALUES (2827, 2824, 0, 3, 0, '定日县', '西藏自治区日喀则地区定日县', '858200', '', 'drx', 'D', 0);
INSERT INTO `tp_city` VALUES (2828, 2824, 0, 3, 0, '萨迦县', '西藏自治区日喀则地区萨迦县', '857800', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (2829, 2824, 0, 3, 0, '南木林县', '西藏自治区日喀则地区南木林县', '857100', '', 'nmlx', 'N', 0);
INSERT INTO `tp_city` VALUES (2830, 2824, 0, 3, 0, '江孜县', '西藏自治区日喀则地区江孜县', '857400', '', 'jzx', 'J', 0);
INSERT INTO `tp_city` VALUES (2831, 2824, 0, 3, 0, '亚东县', '西藏自治区日喀则地区亚东县', '857600', '', 'ydx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2832, 2824, 0, 3, 0, '吉隆县', '西藏自治区日喀则地区吉隆县', '858700', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (2833, 2824, 0, 3, 0, '定结县', '西藏自治区日喀则地区定结县', '857900', '', 'djx', 'D', 0);
INSERT INTO `tp_city` VALUES (2834, 2824, 0, 3, 0, '仲巴县', '西藏自治区日喀则地区仲巴县', '858800', '', 'zbx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2835, 2824, 0, 3, 0, '仁布县', '西藏自治区日喀则地区仁布县', '857200', '', 'rbx', 'R', 0);
INSERT INTO `tp_city` VALUES (2836, 2824, 0, 3, 0, '康马县', '西藏自治区日喀则地区康马县', '857500', '', 'kmx', 'K', 0);
INSERT INTO `tp_city` VALUES (2837, 2824, 0, 3, 0, '谢通门县', '西藏自治区日喀则地区谢通门县', '858900', '', 'xtmx', 'X', 0);
INSERT INTO `tp_city` VALUES (2838, 2824, 0, 3, 0, '白朗县', '西藏自治区日喀则地区白朗县', '857300', '', 'blx', 'B', 0);
INSERT INTO `tp_city` VALUES (2839, 2824, 0, 3, 0, '日喀则市', '西藏自治区日喀则地区日喀则市', '857000', '', 'rkzs', 'R', 0);
INSERT INTO `tp_city` VALUES (2840, 2824, 0, 3, 0, '聂拉木县', '西藏自治区日喀则地区聂拉木县', '858300', '', 'nlmx', 'N', 0);
INSERT INTO `tp_city` VALUES (2841, 2824, 0, 3, 0, '萨嘎县', '西藏自治区日喀则地区萨嘎县', '858600', '', 'sgx', 'S', 0);
INSERT INTO `tp_city` VALUES (2842, 2824, 0, 3, 0, '岗巴县', '西藏自治区日喀则地区岗巴县', '857700', '', 'gbx', 'G', 0);
INSERT INTO `tp_city` VALUES (2843, 2824, 0, 3, 0, '其它区', '西藏自治区日喀则地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2844, 2786, 0, 2, 0, '那曲地区', '西藏自治区那曲地区', '', '', 'nqdq', 'N', 0);
INSERT INTO `tp_city` VALUES (2845, 2844, 0, 3, 0, '双湖县', '西藏自治区那曲地区双湖县', '', '', 'shx', 'S', 0);
INSERT INTO `tp_city` VALUES (2846, 2844, 0, 3, 0, '巴青县', '西藏自治区那曲地区巴青县', '852100', '', 'bqx', 'B', 0);
INSERT INTO `tp_city` VALUES (2847, 2844, 0, 3, 0, '班戈县', '西藏自治区那曲地区班戈县', '852500', '', 'bgx', 'B', 0);
INSERT INTO `tp_city` VALUES (2848, 2844, 0, 3, 0, '其它区', '西藏自治区那曲地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2849, 2844, 0, 3, 0, '尼玛县', '西藏自治区那曲地区尼玛县', '852600', '', 'nmx', 'N', 0);
INSERT INTO `tp_city` VALUES (2850, 2844, 0, 3, 0, '安多县', '西藏自治区那曲地区安多县', '853400', '', 'adx', 'A', 0);
INSERT INTO `tp_city` VALUES (2851, 2844, 0, 3, 0, '聂荣县', '西藏自治区那曲地区聂荣县', '853500', '', 'nrx', 'N', 0);
INSERT INTO `tp_city` VALUES (2852, 2844, 0, 3, 0, '索县', '西藏自治区那曲地区索县', '852200', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (2853, 2844, 0, 3, 0, '申扎县', '西藏自治区那曲地区申扎县', '853100', '', 'szx', 'S', 0);
INSERT INTO `tp_city` VALUES (2854, 2844, 0, 3, 0, '那曲县', '西藏自治区那曲地区那曲县', '852000', '', 'nqx', 'N', 0);
INSERT INTO `tp_city` VALUES (2855, 2844, 0, 3, 0, '比如县', '西藏自治区那曲地区比如县', '852300', '', 'brx', 'B', 0);
INSERT INTO `tp_city` VALUES (2856, 2844, 0, 3, 0, '嘉黎县', '西藏自治区那曲地区嘉黎县', '852400', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (2857, 2786, 0, 2, 0, '阿里地区', '西藏自治区阿里地区', '', '', 'aldq', 'A', 0);
INSERT INTO `tp_city` VALUES (2858, 2857, 0, 3, 0, '其它区', '西藏自治区阿里地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2859, 2857, 0, 3, 0, '普兰县', '西藏自治区阿里地区普兰县', '859500', '', 'plx', 'P', 0);
INSERT INTO `tp_city` VALUES (2860, 2857, 0, 3, 0, '札达县', '西藏自治区阿里地区札达县', '859600', '', 'zdx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2861, 2857, 0, 3, 0, '噶尔县', '西藏自治区阿里地区噶尔县', '859400', '', 'gex', 'G', 0);
INSERT INTO `tp_city` VALUES (2862, 2857, 0, 3, 0, '日土县', '西藏自治区阿里地区日土县', '859700', '', 'rtx', 'R', 0);
INSERT INTO `tp_city` VALUES (2863, 2857, 0, 3, 0, '革吉县', '西藏自治区阿里地区革吉县', '859100', '', 'gjx', 'G', 0);
INSERT INTO `tp_city` VALUES (2864, 2857, 0, 3, 0, '改则县', '西藏自治区阿里地区改则县', '859200', '', 'gzx', 'G', 0);
INSERT INTO `tp_city` VALUES (2865, 2857, 0, 3, 0, '措勤县', '西藏自治区阿里地区措勤县', '859300', '', 'cqx', 'C', 0);
INSERT INTO `tp_city` VALUES (2866, 2786, 0, 2, 0, '林芝地区', '西藏自治区林芝地区', '', '', 'lzdq', 'L', 0);
INSERT INTO `tp_city` VALUES (2867, 2866, 0, 3, 0, '墨脱县', '西藏自治区林芝地区墨脱县', '860700', '', 'mtx', 'M', 0);
INSERT INTO `tp_city` VALUES (2868, 2866, 0, 3, 0, '波密县', '西藏自治区林芝地区波密县', '860300', '', 'bmx', 'B', 0);
INSERT INTO `tp_city` VALUES (2869, 2866, 0, 3, 0, '察隅县', '西藏自治区林芝地区察隅县', '860600', '', 'cyx', 'C', 0);
INSERT INTO `tp_city` VALUES (2870, 2866, 0, 3, 0, '朗县', '西藏自治区林芝地区朗县', '860400', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (2871, 2866, 0, 3, 0, '其它区', '西藏自治区林芝地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2872, 2866, 0, 3, 0, '米林县', '西藏自治区林芝地区米林县', '860500', '', 'mlx', 'M', 0);
INSERT INTO `tp_city` VALUES (2873, 2866, 0, 3, 0, '工布江达县', '西藏自治区林芝地区工布江达县', '860200', '', 'gbjdx', 'G', 0);
INSERT INTO `tp_city` VALUES (2874, 2866, 0, 3, 0, '林芝县', '西藏自治区林芝地区林芝县', '860100', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2875, 0, 0, 1, 0, '北京', '北京', '', '', 'bj', 'B', 0);
INSERT INTO `tp_city` VALUES (2876, 2875, 0, 2, 0, '北京市', '北京北京市', '100000', '', 'bjs', 'B', 0);
INSERT INTO `tp_city` VALUES (2877, 2876, 0, 3, 0, '其它区', '北京北京市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2878, 2876, 0, 3, 0, '延庆县', '北京北京市延庆县', '102100', '', 'yqx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2879, 2876, 0, 3, 0, '密云县', '北京北京市密云县', '101500', '', 'myx', 'M', 0);
INSERT INTO `tp_city` VALUES (2880, 2876, 0, 3, 0, '平谷区', '北京北京市平谷区', '101200', '', 'pgq', 'P', 0);
INSERT INTO `tp_city` VALUES (2881, 2876, 0, 3, 0, '怀柔区', '北京北京市怀柔区', '101400', '', 'hrq', 'H', 0);
INSERT INTO `tp_city` VALUES (2882, 2876, 0, 3, 0, '顺义区', '北京北京市顺义区', '101300', '', 'syq', 'S', 0);
INSERT INTO `tp_city` VALUES (2883, 2876, 0, 3, 0, '通州区', '北京北京市通州区', '101100', '', 'tzq', 'T', 0);
INSERT INTO `tp_city` VALUES (2884, 2876, 0, 3, 0, '大兴区', '北京北京市大兴区', '102600', '', 'dxq', 'D', 0);
INSERT INTO `tp_city` VALUES (2885, 2876, 0, 3, 0, '昌平区', '北京北京市昌平区', '102200', '', 'cpq', 'C', 0);
INSERT INTO `tp_city` VALUES (2886, 2876, 0, 3, 0, '西城区', '北京北京市西城区', '100032', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (2887, 2876, 0, 3, 0, '崇文区', '北京北京市崇文区', '100061', '', 'cwq', 'C', 0);
INSERT INTO `tp_city` VALUES (2888, 2876, 0, 3, 0, '东城区', '北京北京市东城区', '100010', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (2889, 2876, 0, 3, 0, '房山区', '北京北京市房山区', '102488', '', 'fsq', 'F', 0);
INSERT INTO `tp_city` VALUES (2890, 2876, 0, 3, 0, '海淀区', '北京北京市海淀区', '100091', '', 'hdq', 'H', 0);
INSERT INTO `tp_city` VALUES (2891, 2876, 0, 3, 0, '门头沟区', '北京北京市门头沟区', '102300', '', 'mtgq', 'M', 0);
INSERT INTO `tp_city` VALUES (2892, 2876, 0, 3, 0, '丰台区', '北京北京市丰台区', '100071', '', 'ftq', 'F', 0);
INSERT INTO `tp_city` VALUES (2893, 2876, 0, 3, 0, '石景山区', '北京北京市石景山区', '100071', '', 'sjsq', 'S', 0);
INSERT INTO `tp_city` VALUES (2894, 2876, 0, 3, 0, '宣武区', '北京北京市宣武区', '100054', '', 'xwq', 'X', 0);
INSERT INTO `tp_city` VALUES (2895, 2876, 0, 3, 0, '朝阳区', '北京北京市朝阳区', '100011', '', 'cyq', 'C', 0);
INSERT INTO `tp_city` VALUES (2896, 0, 0, 1, 0, '四川省', '四川省', '', '', 'scs', 'S', 0);
INSERT INTO `tp_city` VALUES (2897, 2896, 1, 2, 0, '资阳市', '四川省资阳市', '641300', '', 'zys', 'Z', 0);
INSERT INTO `tp_city` VALUES (2898, 2897, 0, 3, 0, '其它区', '四川省资阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2899, 2897, 0, 3, 0, '简阳市', '四川省资阳市简阳市', '641400', '', 'jys', 'J', 0);
INSERT INTO `tp_city` VALUES (2900, 2897, 0, 3, 0, '乐至县', '四川省资阳市乐至县', '641500', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (2901, 2897, 0, 3, 0, '安岳县', '四川省资阳市安岳县', '642350', '', 'ayx', 'A', 0);
INSERT INTO `tp_city` VALUES (2902, 2897, 0, 3, 0, '雁江区', '四川省资阳市雁江区', '641300', '', 'yjq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2903, 2896, 1, 2, 0, '阿坝藏族羌族自治州', '四川省阿坝藏族羌族自治州', '', '', 'abczqzzzz', 'A', 0);
INSERT INTO `tp_city` VALUES (2904, 2903, 0, 3, 0, '其它区', '四川省阿坝藏族羌族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2905, 2903, 0, 3, 0, '若尔盖县', '四川省阿坝藏族羌族自治州若尔盖县', '624500', '', 'regx', 'R', 0);
INSERT INTO `tp_city` VALUES (2906, 2903, 0, 3, 0, '红原县', '四川省阿坝藏族羌族自治州红原县', '624400', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (2907, 2903, 0, 3, 0, '阿坝县', '四川省阿坝藏族羌族自治州阿坝县', '624600', '', 'abx', 'A', 0);
INSERT INTO `tp_city` VALUES (2908, 2903, 0, 3, 0, '壤塘县', '四川省阿坝藏族羌族自治州壤塘县', '624300', '', 'rtx', 'R', 0);
INSERT INTO `tp_city` VALUES (2909, 2903, 0, 3, 0, '马尔康县', '四川省阿坝藏族羌族自治州马尔康县', '624000', '', 'mekx', 'M', 0);
INSERT INTO `tp_city` VALUES (2910, 2903, 0, 3, 0, '黑水县', '四川省阿坝藏族羌族自治州黑水县', '623500', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (2911, 2903, 0, 3, 0, '小金县', '四川省阿坝藏族羌族自治州小金县', '624200', '', 'xjx', 'X', 0);
INSERT INTO `tp_city` VALUES (2912, 2903, 0, 3, 0, '金川县', '四川省阿坝藏族羌族自治州金川县', '624100', '', 'jcx', 'J', 0);
INSERT INTO `tp_city` VALUES (2913, 2903, 0, 3, 0, '九寨沟县', '四川省阿坝藏族羌族自治州九寨沟县', '623400', '', 'jzgx', 'J', 0);
INSERT INTO `tp_city` VALUES (2914, 2903, 0, 3, 0, '松潘县', '四川省阿坝藏族羌族自治州松潘县', '623300', '', 'spx', 'S', 0);
INSERT INTO `tp_city` VALUES (2915, 2903, 0, 3, 0, '茂县', '四川省阿坝藏族羌族自治州茂县', '623200', '', 'mx', 'M', 0);
INSERT INTO `tp_city` VALUES (2916, 2903, 0, 3, 0, '理县', '四川省阿坝藏族羌族自治州理县', '632100', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (2917, 2903, 0, 3, 0, '汶川县', '四川省阿坝藏族羌族自治州汶川县', '623000', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2918, 2896, 1, 2, 0, '甘孜藏族自治州', '四川省甘孜藏族自治州', '', '', 'gzczzzz', 'G', 0);
INSERT INTO `tp_city` VALUES (2919, 2918, 0, 3, 0, '泸定县', '四川省甘孜藏族自治州泸定县', '626100', '', 'dx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2920, 2918, 0, 3, 0, '丹巴县', '四川省甘孜藏族自治州丹巴县', '626300', '', 'dbx', 'D', 0);
INSERT INTO `tp_city` VALUES (2921, 2918, 0, 3, 0, '康定县', '四川省甘孜藏族自治州康定县', '626000', '', 'kdx', 'K', 0);
INSERT INTO `tp_city` VALUES (2922, 2918, 0, 3, 0, '道孚县', '四川省甘孜藏族自治州道孚县', '626400', '', 'dx', 'D', 0);
INSERT INTO `tp_city` VALUES (2923, 2918, 0, 3, 0, '炉霍县', '四川省甘孜藏族自治州炉霍县', '626500', '', 'lhx', 'L', 0);
INSERT INTO `tp_city` VALUES (2924, 2918, 0, 3, 0, '九龙县', '四川省甘孜藏族自治州九龙县', '626200', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (2925, 2918, 0, 3, 0, '雅江县', '四川省甘孜藏族自治州雅江县', '627450', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2926, 2918, 0, 3, 0, '白玉县', '四川省甘孜藏族自治州白玉县', '627150', '', 'byx', 'B', 0);
INSERT INTO `tp_city` VALUES (2927, 2918, 0, 3, 0, '德格县', '四川省甘孜藏族自治州德格县', '627250', '', 'dgx', 'D', 0);
INSERT INTO `tp_city` VALUES (2928, 2918, 0, 3, 0, '新龙县', '四川省甘孜藏族自治州新龙县', '626800', '', 'xlx', 'X', 0);
INSERT INTO `tp_city` VALUES (2929, 2918, 0, 3, 0, '甘孜县', '四川省甘孜藏族自治州甘孜县', '626700', '', 'gzx', 'G', 0);
INSERT INTO `tp_city` VALUES (2930, 2918, 0, 3, 0, '巴塘县', '四川省甘孜藏族自治州巴塘县', '627650', '', 'btx', 'B', 0);
INSERT INTO `tp_city` VALUES (2931, 2918, 0, 3, 0, '理塘县', '四川省甘孜藏族自治州理塘县', '627550', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (2932, 2918, 0, 3, 0, '色达县', '四川省甘孜藏族自治州色达县', '626600', '', 'sdx', 'S', 0);
INSERT INTO `tp_city` VALUES (2933, 2918, 0, 3, 0, '石渠县', '四川省甘孜藏族自治州石渠县', '627350', '', 'sqx', 'S', 0);
INSERT INTO `tp_city` VALUES (2934, 2918, 0, 3, 0, '其它区', '四川省甘孜藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2935, 2918, 0, 3, 0, '得荣县', '四川省甘孜藏族自治州得荣县', '627950', '', 'drx', 'D', 0);
INSERT INTO `tp_city` VALUES (2936, 2918, 0, 3, 0, '稻城县', '四川省甘孜藏族自治州稻城县', '627750', '', 'dcx', 'D', 0);
INSERT INTO `tp_city` VALUES (2937, 2918, 0, 3, 0, '乡城县', '四川省甘孜藏族自治州乡城县', '627850', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (2938, 2896, 1, 2, 0, '凉山彝族自治州', '四川省凉山彝族自治州', '', '', 'lsyzzzz', 'L', 0);
INSERT INTO `tp_city` VALUES (2939, 2938, 0, 3, 0, '盐源县', '四川省凉山彝族自治州盐源县', '615700', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2940, 2938, 0, 3, 0, '木里藏族自治县', '四川省凉山彝族自治州木里藏族自治县', '615800', '', 'mlczzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (2941, 2938, 0, 3, 0, '喜德县', '四川省凉山彝族自治州喜德县', '616750', '', 'xdx', 'X', 0);
INSERT INTO `tp_city` VALUES (2942, 2938, 0, 3, 0, '冕宁县', '四川省凉山彝族自治州冕宁县', '615600', '', 'mnx', 'M', 0);
INSERT INTO `tp_city` VALUES (2943, 2938, 0, 3, 0, '越西县', '四川省凉山彝族自治州越西县', '616650', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2944, 2938, 0, 3, 0, '甘洛县', '四川省凉山彝族自治州甘洛县', '616850', '', 'glx', 'G', 0);
INSERT INTO `tp_city` VALUES (2945, 2938, 0, 3, 0, '美姑县', '四川省凉山彝族自治州美姑县', '616450', '', 'mgx', 'M', 0);
INSERT INTO `tp_city` VALUES (2946, 2938, 0, 3, 0, '雷波县', '四川省凉山彝族自治州雷波县', '616550', '', 'lbx', 'L', 0);
INSERT INTO `tp_city` VALUES (2947, 2938, 0, 3, 0, '其它区', '四川省凉山彝族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2948, 2938, 0, 3, 0, '德昌县', '四川省凉山彝族自治州德昌县', '615500', '', 'dcx', 'D', 0);
INSERT INTO `tp_city` VALUES (2949, 2938, 0, 3, 0, '会理县', '四川省凉山彝族自治州会理县', '615100', '', 'hlx', 'H', 0);
INSERT INTO `tp_city` VALUES (2950, 2938, 0, 3, 0, '会东县', '四川省凉山彝族自治州会东县', '615200', '', 'hdx', 'H', 0);
INSERT INTO `tp_city` VALUES (2951, 2938, 0, 3, 0, '宁南县', '四川省凉山彝族自治州宁南县', '615400', '', 'nnx', 'N', 0);
INSERT INTO `tp_city` VALUES (2952, 2938, 0, 3, 0, '普格县', '四川省凉山彝族自治州普格县', '615300', '', 'pgx', 'P', 0);
INSERT INTO `tp_city` VALUES (2953, 2938, 0, 3, 0, '布拖县', '四川省凉山彝族自治州布拖县', '616350', '', 'btx', 'B', 0);
INSERT INTO `tp_city` VALUES (2954, 2938, 0, 3, 0, '金阳县', '四川省凉山彝族自治州金阳县', '616250', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (2955, 2938, 0, 3, 0, '昭觉县', '四川省凉山彝族自治州昭觉县', '616150', '', 'zjx', 'Z', 0);
INSERT INTO `tp_city` VALUES (2956, 2938, 0, 3, 0, '西昌市', '四川省凉山彝族自治州西昌市', '615000', '', 'xcs', 'X', 0);
INSERT INTO `tp_city` VALUES (2957, 2896, 1, 2, 0, '广元市', '四川省广元市', '628000', '', 'gys', 'G', 0);
INSERT INTO `tp_city` VALUES (2958, 2957, 0, 3, 0, '昭化区', '四川省广元市昭化区', '628021', '', 'zhq', 'Z', 0);
INSERT INTO `tp_city` VALUES (2959, 2957, 0, 3, 0, '朝天区', '四川省广元市朝天区', '628012', '', 'ctq', 'C', 0);
INSERT INTO `tp_city` VALUES (2960, 2957, 0, 3, 0, '利州区', '四川省广元市利州区', '628017', '', 'lzq', 'L', 0);
INSERT INTO `tp_city` VALUES (2961, 2957, 0, 3, 0, '其它区', '四川省广元市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2962, 2957, 0, 3, 0, '苍溪县', '四川省广元市苍溪县', '628400', '', 'cxx', 'C', 0);
INSERT INTO `tp_city` VALUES (2963, 2957, 0, 3, 0, '剑阁县', '四川省广元市剑阁县', '628300', '', 'jgx', 'J', 0);
INSERT INTO `tp_city` VALUES (2964, 2957, 0, 3, 0, '青川县', '四川省广元市青川县', '628100', '', 'qcx', 'Q', 0);
INSERT INTO `tp_city` VALUES (2965, 2957, 0, 3, 0, '旺苍县', '四川省广元市旺苍县', '628200', '', 'wcx', 'W', 0);
INSERT INTO `tp_city` VALUES (2966, 2896, 1, 2, 0, '遂宁市', '四川省遂宁市', '629000', '', 'sns', 'S', 0);
INSERT INTO `tp_city` VALUES (2967, 2966, 0, 3, 0, '蓬溪县', '四川省遂宁市蓬溪县', '629100', '', 'pxx', 'P', 0);
INSERT INTO `tp_city` VALUES (2968, 2966, 0, 3, 0, '射洪县', '四川省遂宁市射洪县', '629200', '', 'shx', 'S', 0);
INSERT INTO `tp_city` VALUES (2969, 2966, 0, 3, 0, '大英县', '四川省遂宁市大英县', '629300', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (2970, 2966, 0, 3, 0, '其它区', '四川省遂宁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2971, 2966, 0, 3, 0, '船山区', '四川省遂宁市船山区', '629000', '', 'csq', 'C', 0);
INSERT INTO `tp_city` VALUES (2972, 2966, 0, 3, 0, '安居区', '四川省遂宁市安居区', '629000', '', 'ajq', 'A', 0);
INSERT INTO `tp_city` VALUES (2973, 2896, 1, 2, 0, '泸州市', '四川省泸州市', '646000', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (2974, 2973, 0, 3, 0, '龙马潭区', '四川省泸州市龙马潭区', '646000', '', 'lmtq', 'L', 0);
INSERT INTO `tp_city` VALUES (2975, 2973, 0, 3, 0, '纳溪区', '四川省泸州市纳溪区', '646300', '', 'nxq', 'N', 0);
INSERT INTO `tp_city` VALUES (2976, 2973, 0, 3, 0, '江阳区', '四川省泸州市江阳区', '646000', '', 'jyq', 'J', 0);
INSERT INTO `tp_city` VALUES (2977, 2973, 0, 3, 0, '叙永县', '四川省泸州市叙永县', '646400', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (2978, 2973, 0, 3, 0, '古蔺县', '四川省泸州市古蔺县', '646500', '', 'gx', 'G', 0);
INSERT INTO `tp_city` VALUES (2979, 2973, 0, 3, 0, '其它区', '四川省泸州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2980, 2973, 0, 3, 0, '泸县', '四川省泸州市泸县', '646100', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (2981, 2973, 0, 3, 0, '合江县', '四川省泸州市合江县', '646200', '', 'hjx', 'H', 0);
INSERT INTO `tp_city` VALUES (2982, 2896, 1, 2, 0, '绵阳市', '四川省绵阳市', '621000', '', 'mys', 'M', 0);
INSERT INTO `tp_city` VALUES (2983, 2982, 0, 3, 0, '高新区', '四川省绵阳市高新区', '', '', 'gxq', 'G', 0);
INSERT INTO `tp_city` VALUES (2984, 2982, 0, 3, 0, '梓潼县', '四川省绵阳市梓潼县', '622150', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (2985, 2982, 0, 3, 0, '安县', '四川省绵阳市安县', '622650', '', 'ax', 'A', 0);
INSERT INTO `tp_city` VALUES (2986, 2982, 0, 3, 0, '平武县', '四川省绵阳市平武县', '621550', '', 'pwx', 'P', 0);
INSERT INTO `tp_city` VALUES (2987, 2982, 0, 3, 0, '北川羌族自治县', '四川省绵阳市北川羌族自治县', '622750', '', 'bcqzzzx', 'B', 0);
INSERT INTO `tp_city` VALUES (2988, 2982, 0, 3, 0, '盐亭县', '四川省绵阳市盐亭县', '621600', '', 'ytx', 'Y', 0);
INSERT INTO `tp_city` VALUES (2989, 2982, 0, 3, 0, '三台县', '四川省绵阳市三台县', '621100', '', 'stx', 'S', 0);
INSERT INTO `tp_city` VALUES (2990, 2982, 0, 3, 0, '其它区', '四川省绵阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2991, 2982, 0, 3, 0, '江油市', '四川省绵阳市江油市', '621700', '', 'jys', 'J', 0);
INSERT INTO `tp_city` VALUES (2992, 2982, 0, 3, 0, '涪城区', '四川省绵阳市涪城区', '621000', '', 'fcq', 'F', 0);
INSERT INTO `tp_city` VALUES (2993, 2982, 0, 3, 0, '游仙区', '四川省绵阳市游仙区', '621022', '', 'yxq', 'Y', 0);
INSERT INTO `tp_city` VALUES (2994, 2896, 1, 2, 0, '德阳市', '四川省德阳市', '618000', '', 'dys', 'D', 0);
INSERT INTO `tp_city` VALUES (2995, 2994, 0, 3, 0, '绵竹市', '四川省德阳市绵竹市', '618200', '', 'mzs', 'M', 0);
INSERT INTO `tp_city` VALUES (2996, 2994, 0, 3, 0, '什邡市', '四川省德阳市什邡市', '618400', '', 'ss', 'S', 0);
INSERT INTO `tp_city` VALUES (2997, 2994, 0, 3, 0, '广汉市', '四川省德阳市广汉市', '618300', '', 'ghs', 'G', 0);
INSERT INTO `tp_city` VALUES (2998, 2994, 0, 3, 0, '其它区', '四川省德阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (2999, 2994, 0, 3, 0, '旌阳区', '四川省德阳市旌阳区', '618000', '', 'yq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3000, 2994, 0, 3, 0, '中江县', '四川省德阳市中江县', '618300', '', 'zjx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3001, 2994, 0, 3, 0, '罗江县', '四川省德阳市罗江县', '618500', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (3002, 2896, 1, 2, 0, '自贡市', '四川省自贡市', '643000', '', 'zgs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3003, 3002, 0, 3, 0, '富顺县', '四川省自贡市富顺县', '643200', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (3004, 3002, 0, 3, 0, '其它区', '四川省自贡市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3005, 3002, 0, 3, 0, '荣县', '四川省自贡市荣县', '643100', '', 'rx', 'R', 0);
INSERT INTO `tp_city` VALUES (3006, 3002, 0, 3, 0, '沿滩区', '四川省自贡市沿滩区', '643030', '', 'ytq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3007, 3002, 0, 3, 0, '大安区', '四川省自贡市大安区', '643010', '', 'daq', 'D', 0);
INSERT INTO `tp_city` VALUES (3008, 3002, 0, 3, 0, '自流井区', '四川省自贡市自流井区', '643000', '', 'zljq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3009, 3002, 0, 3, 0, '贡井区', '四川省自贡市贡井区', '643020', '', 'gjq', 'G', 0);
INSERT INTO `tp_city` VALUES (3010, 2896, 1, 2, 0, '攀枝花市', '四川省攀枝花市', '617000', '', 'pzhs', 'P', 0);
INSERT INTO `tp_city` VALUES (3011, 3010, 0, 3, 0, '米易县', '四川省攀枝花市米易县', '617200', '', 'myx', 'M', 0);
INSERT INTO `tp_city` VALUES (3012, 3010, 0, 3, 0, '其它区', '四川省攀枝花市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3013, 3010, 0, 3, 0, '盐边县', '四川省攀枝花市盐边县', '617100', '', 'ybx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3014, 3010, 0, 3, 0, '东区', '四川省攀枝花市东区', '617067', '', 'dq', 'D', 0);
INSERT INTO `tp_city` VALUES (3015, 3010, 0, 3, 0, '西区', '四川省攀枝花市西区', '617012', '', 'xq', 'X', 0);
INSERT INTO `tp_city` VALUES (3016, 3010, 0, 3, 0, '仁和区', '四川省攀枝花市仁和区', '617061', '', 'rhq', 'R', 0);
INSERT INTO `tp_city` VALUES (3017, 2896, 1, 2, 0, '成都市', '四川省成都市', '610000', '', 'cds', 'C', 0);
INSERT INTO `tp_city` VALUES (3018, 3017, 0, 3, 0, '都江堰市', '四川省成都市都江堰市', '611830', '', 'djys', 'D', 0);
INSERT INTO `tp_city` VALUES (3019, 3017, 0, 3, 0, '彭州市', '四川省成都市彭州市', '611930', '', 'pzs', 'P', 0);
INSERT INTO `tp_city` VALUES (3020, 3017, 0, 3, 0, '邛崃市', '四川省成都市邛崃市', '611530', '', 's', 'Z', 0);
INSERT INTO `tp_city` VALUES (3021, 3017, 0, 3, 0, '崇州市', '四川省成都市崇州市', '611230', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (3022, 3017, 0, 3, 0, '其它区', '四川省成都市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3023, 3017, 0, 3, 0, '龙泉驿区', '四川省成都市龙泉驿区', '610100', '', 'lqq', 'L', 0);
INSERT INTO `tp_city` VALUES (3024, 3017, 0, 3, 0, '青白江区', '四川省成都市青白江区', '610300', '', 'qbjq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3025, 3017, 0, 3, 0, '新都区', '四川省成都市新都区', '610500', '', 'xdq', 'X', 0);
INSERT INTO `tp_city` VALUES (3026, 3017, 0, 3, 0, '温江区', '四川省成都市温江区', '611130', '', 'wjq', 'W', 0);
INSERT INTO `tp_city` VALUES (3027, 3017, 0, 3, 0, '金堂县', '四川省成都市金堂县', '610400', '', 'jtx', 'J', 0);
INSERT INTO `tp_city` VALUES (3028, 3017, 0, 3, 0, '双流县', '四川省成都市双流县', '610200', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (3029, 3017, 0, 3, 0, '郫县', '四川省成都市郫县', '611730', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (3030, 3017, 0, 3, 0, '大邑县', '四川省成都市大邑县', '611330', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (3031, 3017, 0, 3, 0, '蒲江县', '四川省成都市蒲江县', '611630', '', 'pjx', 'P', 0);
INSERT INTO `tp_city` VALUES (3032, 3017, 0, 3, 0, '新津县', '四川省成都市新津县', '611430', '', 'xjx', 'X', 0);
INSERT INTO `tp_city` VALUES (3033, 3017, 0, 3, 0, '武侯区', '四川省成都市武侯区', '610041', '', 'whq', 'W', 0);
INSERT INTO `tp_city` VALUES (3034, 3017, 0, 3, 0, '金牛区', '四川省成都市金牛区', '610036', '', 'jnq', 'J', 0);
INSERT INTO `tp_city` VALUES (3035, 3017, 0, 3, 0, '青羊区', '四川省成都市青羊区', '610031', '', 'qyq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3036, 3017, 0, 3, 0, '锦江区', '四川省成都市锦江区', '610011', '', 'jjq', 'J', 0);
INSERT INTO `tp_city` VALUES (3037, 3017, 0, 3, 0, '成华区', '四川省成都市成华区', '610066', '', 'chq', 'C', 0);
INSERT INTO `tp_city` VALUES (3038, 2896, 1, 2, 0, '雅安市', '四川省雅安市', '625000', '', 'yas', 'Y', 0);
INSERT INTO `tp_city` VALUES (3039, 3038, 0, 3, 0, '雨城区', '四川省雅安市雨城区', '625000', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3040, 3038, 0, 3, 0, '石棉县', '四川省雅安市石棉县', '625400', '', 'smx', 'S', 0);
INSERT INTO `tp_city` VALUES (3041, 3038, 0, 3, 0, '天全县', '四川省雅安市天全县', '625500', '', 'tqx', 'T', 0);
INSERT INTO `tp_city` VALUES (3042, 3038, 0, 3, 0, '芦山县', '四川省雅安市芦山县', '625600', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (3043, 3038, 0, 3, 0, '宝兴县', '四川省雅安市宝兴县', '625700', '', 'bxx', 'B', 0);
INSERT INTO `tp_city` VALUES (3044, 3038, 0, 3, 0, '其它区', '四川省雅安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3045, 3038, 0, 3, 0, '名山区', '四川省雅安市名山区', '625100', '', 'msq', 'M', 0);
INSERT INTO `tp_city` VALUES (3046, 3038, 0, 3, 0, '汉源县', '四川省雅安市汉源县', '625300', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (3047, 3038, 0, 3, 0, '荥经县', '四川省雅安市荥经县', '625200', '', 'jx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3048, 2896, 1, 2, 0, '巴中市', '四川省巴中市', '636000', '', 'bzs', 'B', 0);
INSERT INTO `tp_city` VALUES (3049, 3048, 0, 3, 0, '恩阳区', '四川省巴中市恩阳区', '', '', 'eyq', 'E', 0);
INSERT INTO `tp_city` VALUES (3050, 3048, 0, 3, 0, '巴州区', '四川省巴中市巴州区', '636601', '', 'bzq', 'B', 0);
INSERT INTO `tp_city` VALUES (3051, 3048, 0, 3, 0, '其它区', '四川省巴中市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3052, 3048, 0, 3, 0, '平昌县', '四川省巴中市平昌县', '636400', '', 'pcx', 'P', 0);
INSERT INTO `tp_city` VALUES (3053, 3048, 0, 3, 0, '南江县', '四川省巴中市南江县', '636600', '', 'njx', 'N', 0);
INSERT INTO `tp_city` VALUES (3054, 3048, 0, 3, 0, '通江县', '四川省巴中市通江县', '636700', '', 'tjx', 'T', 0);
INSERT INTO `tp_city` VALUES (3055, 2896, 1, 2, 0, '宜宾市', '四川省宜宾市', '644000', '', 'ybs', 'Y', 0);
INSERT INTO `tp_city` VALUES (3056, 3055, 0, 3, 0, '翠屏区', '四川省宜宾市翠屏区', '644000', '', 'cpq', 'C', 0);
INSERT INTO `tp_city` VALUES (3057, 3055, 0, 3, 0, '高县', '四川省宜宾市高县', '645150', '', 'gx', 'G', 0);
INSERT INTO `tp_city` VALUES (3058, 3055, 0, 3, 0, '长宁县', '四川省宜宾市长宁县', '644300', '', 'cnx', 'C', 0);
INSERT INTO `tp_city` VALUES (3059, 3055, 0, 3, 0, '筠连县', '四川省宜宾市筠连县', '645250', '', 'lx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3060, 3055, 0, 3, 0, '珙县', '四川省宜宾市珙县', '644500', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (3061, 3055, 0, 3, 0, '宜宾县', '四川省宜宾市宜宾县', '644600', '', 'ybx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3062, 3055, 0, 3, 0, '江安县', '四川省宜宾市江安县', '644200', '', 'jax', 'J', 0);
INSERT INTO `tp_city` VALUES (3063, 3055, 0, 3, 0, '南溪区', '四川省宜宾市南溪区', '644100', '', 'nxq', 'N', 0);
INSERT INTO `tp_city` VALUES (3064, 3055, 0, 3, 0, '屏山县', '四川省宜宾市屏山县', '645350', '', 'psx', 'P', 0);
INSERT INTO `tp_city` VALUES (3065, 3055, 0, 3, 0, '兴文县', '四川省宜宾市兴文县', '644400', '', 'xwx', 'X', 0);
INSERT INTO `tp_city` VALUES (3066, 3055, 0, 3, 0, '其它区', '四川省宜宾市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3067, 2896, 1, 2, 0, '广安市', '四川省广安市', '638000', '', 'gas', 'G', 0);
INSERT INTO `tp_city` VALUES (3068, 3067, 0, 3, 0, '广安区', '四川省广安市广安区', '638550', '', 'gaq', 'G', 0);
INSERT INTO `tp_city` VALUES (3069, 3067, 0, 3, 0, '前锋区', '四川省广安市前锋区', '', '', 'qfq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3070, 3067, 0, 3, 0, '武胜县', '四川省广安市武胜县', '638420', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (3071, 3067, 0, 3, 0, '邻水县', '四川省广安市邻水县', '638520', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (3072, 3067, 0, 3, 0, '岳池县', '四川省广安市岳池县', '638300', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3073, 3067, 0, 3, 0, '市辖区', '四川省广安市市辖区', '', '', 'sxq', 'S', 0);
INSERT INTO `tp_city` VALUES (3074, 3067, 0, 3, 0, '其它区', '四川省广安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3075, 3067, 0, 3, 0, '华蓥市', '四川省广安市华蓥市', '638650', '', 'hs', 'H', 0);
INSERT INTO `tp_city` VALUES (3076, 2896, 1, 2, 0, '达州市', '四川省达州市', '635000', '', 'dzs', 'D', 0);
INSERT INTO `tp_city` VALUES (3077, 3076, 0, 3, 0, '其它区', '四川省达州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3078, 3076, 0, 3, 0, '万源市', '四川省达州市万源市', '636350', '', 'wys', 'W', 0);
INSERT INTO `tp_city` VALUES (3079, 3076, 0, 3, 0, '通川区', '四川省达州市通川区', '635000', '', 'tcq', 'T', 0);
INSERT INTO `tp_city` VALUES (3080, 3076, 0, 3, 0, '达川区', '四川省达州市达川区', '635006', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (3081, 3076, 0, 3, 0, '宣汉县', '四川省达州市宣汉县', '636150', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (3082, 3076, 0, 3, 0, '开江县', '四川省达州市开江县', '636250', '', 'kjx', 'K', 0);
INSERT INTO `tp_city` VALUES (3083, 3076, 0, 3, 0, '大竹县', '四川省达州市大竹县', '635100', '', 'dzx', 'D', 0);
INSERT INTO `tp_city` VALUES (3084, 3076, 0, 3, 0, '渠县', '四川省达州市渠县', '635200', '', 'qx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3085, 2896, 1, 2, 0, '南充市', '四川省南充市', '637000', '', 'ncs', 'N', 0);
INSERT INTO `tp_city` VALUES (3086, 3085, 0, 3, 0, '仪陇县', '四川省南充市仪陇县', '637600', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3087, 3085, 0, 3, 0, '西充县', '四川省南充市西充县', '637200', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (3088, 3085, 0, 3, 0, '南部县', '四川省南充市南部县', '637300', '', 'nbx', 'N', 0);
INSERT INTO `tp_city` VALUES (3089, 3085, 0, 3, 0, '营山县', '四川省南充市营山县', '638150', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3090, 3085, 0, 3, 0, '蓬安县', '四川省南充市蓬安县', '638250', '', 'pax', 'P', 0);
INSERT INTO `tp_city` VALUES (3091, 3085, 0, 3, 0, '高坪区', '四川省南充市高坪区', '637100', '', 'gpq', 'G', 0);
INSERT INTO `tp_city` VALUES (3092, 3085, 0, 3, 0, '顺庆区', '四川省南充市顺庆区', '637500', '', 'sqq', 'S', 0);
INSERT INTO `tp_city` VALUES (3093, 3085, 0, 3, 0, '嘉陵区', '四川省南充市嘉陵区', '637900', '', 'jlq', 'J', 0);
INSERT INTO `tp_city` VALUES (3094, 3085, 0, 3, 0, '阆中市', '四川省南充市阆中市', '637400', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3095, 3085, 0, 3, 0, '其它区', '四川省南充市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3096, 2896, 1, 2, 0, '眉山市', '四川省眉山市', '620000', '', 'mss', 'M', 0);
INSERT INTO `tp_city` VALUES (3097, 3096, 0, 3, 0, '洪雅县', '四川省眉山市洪雅县', '620360', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (3098, 3096, 0, 3, 0, '彭山县', '四川省眉山市彭山县', '620860', '', 'psx', 'P', 0);
INSERT INTO `tp_city` VALUES (3099, 3096, 0, 3, 0, '仁寿县', '四川省眉山市仁寿县', '620500', '', 'rsx', 'R', 0);
INSERT INTO `tp_city` VALUES (3100, 3096, 0, 3, 0, '东坡区', '四川省眉山市东坡区', '620010', '', 'dpq', 'D', 0);
INSERT INTO `tp_city` VALUES (3101, 3096, 0, 3, 0, '丹棱县', '四川省眉山市丹棱县', '620200', '', 'dlx', 'D', 0);
INSERT INTO `tp_city` VALUES (3102, 3096, 0, 3, 0, '青神县', '四川省眉山市青神县', '620460', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3103, 3096, 0, 3, 0, '其它区', '四川省眉山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3104, 2896, 1, 2, 0, '内江市', '四川省内江市', '641000', '', 'njs', 'N', 0);
INSERT INTO `tp_city` VALUES (3105, 3104, 0, 3, 0, '东兴区', '四川省内江市东兴区', '641100', '', 'dxq', 'D', 0);
INSERT INTO `tp_city` VALUES (3106, 3104, 0, 3, 0, '威远县', '四川省内江市威远县', '642450', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (3107, 3104, 0, 3, 0, '资中县', '四川省内江市资中县', '641200', '', 'zzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3108, 3104, 0, 3, 0, '隆昌县', '四川省内江市隆昌县', '642150', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (3109, 3104, 0, 3, 0, '其它区', '四川省内江市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3110, 3104, 0, 3, 0, '市中区', '四川省内江市市中区', '641000', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (3111, 2896, 1, 2, 0, '乐山市', '四川省乐山市', '614000', '', 'lss', 'L', 0);
INSERT INTO `tp_city` VALUES (3112, 3111, 0, 3, 0, '市中区', '四川省乐山市市中区', '614000', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (3113, 3111, 0, 3, 0, '五通桥区', '四川省乐山市五通桥区', '614800', '', 'wtqq', 'W', 0);
INSERT INTO `tp_city` VALUES (3114, 3111, 0, 3, 0, '金口河区', '四川省乐山市金口河区', '614700', '', 'jkhq', 'J', 0);
INSERT INTO `tp_city` VALUES (3115, 3111, 0, 3, 0, '沙湾区', '四川省乐山市沙湾区', '614900', '', 'swq', 'S', 0);
INSERT INTO `tp_city` VALUES (3116, 3111, 0, 3, 0, '沐川县', '四川省乐山市沐川县', '614500', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3117, 3111, 0, 3, 0, '马边彝族自治县', '四川省乐山市马边彝族自治县', '614600', '', 'mbyzzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (3118, 3111, 0, 3, 0, '峨边彝族自治县', '四川省乐山市峨边彝族自治县', '614300', '', 'ebyzzzx', 'E', 0);
INSERT INTO `tp_city` VALUES (3119, 3111, 0, 3, 0, '犍为县', '四川省乐山市犍为县', '614400', '', 'wx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3120, 3111, 0, 3, 0, '夹江县', '四川省乐山市夹江县', '614100', '', 'jjx', 'J', 0);
INSERT INTO `tp_city` VALUES (3121, 3111, 0, 3, 0, '井研县', '四川省乐山市井研县', '613100', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (3122, 3111, 0, 3, 0, '其它区', '四川省乐山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3123, 3111, 0, 3, 0, '峨眉山市', '四川省乐山市峨眉山市', '614200', '', 'emss', 'E', 0);
INSERT INTO `tp_city` VALUES (3124, 0, 0, 1, 0, '黑龙江省', '黑龙江省', '', '', 'hljs', 'H', 0);
INSERT INTO `tp_city` VALUES (3125, 3124, 0, 2, 0, '大兴安岭地区', '黑龙江省大兴安岭地区', '165000', '', 'dxaldq', 'D', 0);
INSERT INTO `tp_city` VALUES (3126, 3125, 0, 3, 0, '呼玛县', '黑龙江省大兴安岭地区呼玛县', '165100', '', 'hmx', 'H', 0);
INSERT INTO `tp_city` VALUES (3127, 3125, 0, 3, 0, '塔河县', '黑龙江省大兴安岭地区塔河县', '165200', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (3128, 3125, 0, 3, 0, '漠河县', '黑龙江省大兴安岭地区漠河县', '165300', '', 'mhx', 'M', 0);
INSERT INTO `tp_city` VALUES (3129, 3125, 0, 3, 0, '加格达奇区', '黑龙江省大兴安岭地区加格达奇区', '165300', '', 'jgdqq', 'J', 0);
INSERT INTO `tp_city` VALUES (3130, 3125, 0, 3, 0, '其它区', '黑龙江省大兴安岭地区其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3131, 3125, 0, 3, 0, '呼中区', '黑龙江省大兴安岭地区呼中区', '', '', 'hzq', 'H', 0);
INSERT INTO `tp_city` VALUES (3132, 3125, 0, 3, 0, '新林区', '黑龙江省大兴安岭地区新林区', '', '', 'xlq', 'X', 0);
INSERT INTO `tp_city` VALUES (3133, 3125, 0, 3, 0, '松岭区', '黑龙江省大兴安岭地区松岭区', '', '', 'slq', 'S', 0);
INSERT INTO `tp_city` VALUES (3134, 3124, 0, 2, 0, '绥化市', '黑龙江省绥化市', '152000', '', 'shs', 'S', 0);
INSERT INTO `tp_city` VALUES (3135, 3134, 0, 3, 0, '肇东市', '黑龙江省绥化市肇东市', '151100', '', 'zds', 'Z', 0);
INSERT INTO `tp_city` VALUES (3136, 3134, 0, 3, 0, '海伦市', '黑龙江省绥化市海伦市', '152300', '', 'hls', 'H', 0);
INSERT INTO `tp_city` VALUES (3137, 3134, 0, 3, 0, '安达市', '黑龙江省绥化市安达市', '151400', '', 'ads', 'A', 0);
INSERT INTO `tp_city` VALUES (3138, 3134, 0, 3, 0, '其它区', '黑龙江省绥化市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3139, 3134, 0, 3, 0, '北林区', '黑龙江省绥化市北林区', '152000', '', 'blq', 'B', 0);
INSERT INTO `tp_city` VALUES (3140, 3134, 0, 3, 0, '兰西县', '黑龙江省绥化市兰西县', '151500', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (3141, 3134, 0, 3, 0, '青冈县', '黑龙江省绥化市青冈县', '151600', '', 'qgx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3142, 3134, 0, 3, 0, '望奎县', '黑龙江省绥化市望奎县', '152100', '', 'wkx', 'W', 0);
INSERT INTO `tp_city` VALUES (3143, 3134, 0, 3, 0, '绥棱县', '黑龙江省绥化市绥棱县', '152200', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (3144, 3134, 0, 3, 0, '庆安县', '黑龙江省绥化市庆安县', '152400', '', 'qax', 'Q', 0);
INSERT INTO `tp_city` VALUES (3145, 3134, 0, 3, 0, '明水县', '黑龙江省绥化市明水县', '151700', '', 'msx', 'M', 0);
INSERT INTO `tp_city` VALUES (3146, 3124, 0, 2, 0, '牡丹江市', '黑龙江省牡丹江市', '157000', '', 'mdjs', 'M', 0);
INSERT INTO `tp_city` VALUES (3147, 3146, 0, 3, 0, '东安区', '黑龙江省牡丹江市东安区', '157000', '', 'daq', 'D', 0);
INSERT INTO `tp_city` VALUES (3148, 3146, 0, 3, 0, '阳明区', '黑龙江省牡丹江市阳明区', '157013', '', 'ymq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3149, 3146, 0, 3, 0, '爱民区', '黑龙江省牡丹江市爱民区', '157009', '', 'amq', 'A', 0);
INSERT INTO `tp_city` VALUES (3150, 3146, 0, 3, 0, '西安区', '黑龙江省牡丹江市西安区', '157000', '', 'xaq', 'X', 0);
INSERT INTO `tp_city` VALUES (3151, 3146, 0, 3, 0, '东宁县', '黑龙江省牡丹江市东宁县', '157200', '', 'dnx', 'D', 0);
INSERT INTO `tp_city` VALUES (3152, 3146, 0, 3, 0, '林口县', '黑龙江省牡丹江市林口县', '157600', '', 'lkx', 'L', 0);
INSERT INTO `tp_city` VALUES (3153, 3146, 0, 3, 0, '宁安市', '黑龙江省牡丹江市宁安市', '157400', '', 'nas', 'N', 0);
INSERT INTO `tp_city` VALUES (3154, 3146, 0, 3, 0, '穆棱市', '黑龙江省牡丹江市穆棱市', '157500', '', 'mls', 'M', 0);
INSERT INTO `tp_city` VALUES (3155, 3146, 0, 3, 0, '其它区', '黑龙江省牡丹江市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3156, 3146, 0, 3, 0, '绥芬河市', '黑龙江省牡丹江市绥芬河市', '157300', '', 'sfhs', 'S', 0);
INSERT INTO `tp_city` VALUES (3157, 3146, 0, 3, 0, '海林市', '黑龙江省牡丹江市海林市', '157100', '', 'hls', 'H', 0);
INSERT INTO `tp_city` VALUES (3158, 3124, 0, 2, 0, '黑河市', '黑龙江省黑河市', '164300', '', 'hhs', 'H', 0);
INSERT INTO `tp_city` VALUES (3159, 3158, 0, 3, 0, '北安市', '黑龙江省黑河市北安市', '164000', '', 'bas', 'B', 0);
INSERT INTO `tp_city` VALUES (3160, 3158, 0, 3, 0, '其它区', '黑龙江省黑河市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3161, 3158, 0, 3, 0, '五大连池市', '黑龙江省黑河市五大连池市', '164100', '', 'wdlcs', 'W', 0);
INSERT INTO `tp_city` VALUES (3162, 3158, 0, 3, 0, '逊克县', '黑龙江省黑河市逊克县', '164400', '', 'xkx', 'X', 0);
INSERT INTO `tp_city` VALUES (3163, 3158, 0, 3, 0, '嫩江县', '黑龙江省黑河市嫩江县', '161400', '', 'njx', 'N', 0);
INSERT INTO `tp_city` VALUES (3164, 3158, 0, 3, 0, '孙吴县', '黑龙江省黑河市孙吴县', '164200', '', 'swx', 'S', 0);
INSERT INTO `tp_city` VALUES (3165, 3158, 0, 3, 0, '爱辉区', '黑龙江省黑河市爱辉区', '164300', '', 'ahq', 'A', 0);
INSERT INTO `tp_city` VALUES (3166, 3124, 0, 2, 0, '伊春市', '黑龙江省伊春市', '153000', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (3167, 3166, 0, 3, 0, '其它区', '黑龙江省伊春市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3168, 3166, 0, 3, 0, '铁力市', '黑龙江省伊春市铁力市', '152500', '', 'tls', 'T', 0);
INSERT INTO `tp_city` VALUES (3169, 3166, 0, 3, 0, '嘉荫县', '黑龙江省伊春市嘉荫县', '153200', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (3170, 3166, 0, 3, 0, '南岔区', '黑龙江省伊春市南岔区', '153100', '', 'ncq', 'N', 0);
INSERT INTO `tp_city` VALUES (3171, 3166, 0, 3, 0, '伊春区', '黑龙江省伊春市伊春区', '153000', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3172, 3166, 0, 3, 0, '翠峦区', '黑龙江省伊春市翠峦区', '153013', '', 'clq', 'C', 0);
INSERT INTO `tp_city` VALUES (3173, 3166, 0, 3, 0, '新青区', '黑龙江省伊春市新青区', '153036', '', 'xqq', 'X', 0);
INSERT INTO `tp_city` VALUES (3174, 3166, 0, 3, 0, '友好区', '黑龙江省伊春市友好区', '153031', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3175, 3166, 0, 3, 0, '西林区', '黑龙江省伊春市西林区', '153025', '', 'xlq', 'X', 0);
INSERT INTO `tp_city` VALUES (3176, 3166, 0, 3, 0, '五营区', '黑龙江省伊春市五营区', '153033', '', 'wyq', 'W', 0);
INSERT INTO `tp_city` VALUES (3177, 3166, 0, 3, 0, '乌马河区', '黑龙江省伊春市乌马河区', '153011', '', 'wmhq', 'W', 0);
INSERT INTO `tp_city` VALUES (3178, 3166, 0, 3, 0, '美溪区', '黑龙江省伊春市美溪区', '153021', '', 'mxq', 'M', 0);
INSERT INTO `tp_city` VALUES (3179, 3166, 0, 3, 0, '金山屯区', '黑龙江省伊春市金山屯区', '152026', '', 'jstq', 'J', 0);
INSERT INTO `tp_city` VALUES (3180, 3166, 0, 3, 0, '乌伊岭区', '黑龙江省伊春市乌伊岭区', '153038', '', 'wylq', 'W', 0);
INSERT INTO `tp_city` VALUES (3181, 3166, 0, 3, 0, '红星区', '黑龙江省伊春市红星区', '153035', '', 'hxq', 'H', 0);
INSERT INTO `tp_city` VALUES (3182, 3166, 0, 3, 0, '汤旺河区', '黑龙江省伊春市汤旺河区', '153037', '', 'twhq', 'T', 0);
INSERT INTO `tp_city` VALUES (3183, 3166, 0, 3, 0, '带岭区', '黑龙江省伊春市带岭区', '153106', '', 'dlq', 'D', 0);
INSERT INTO `tp_city` VALUES (3184, 3166, 0, 3, 0, '上甘岭区', '黑龙江省伊春市上甘岭区', '153032', '', 'sglq', 'S', 0);
INSERT INTO `tp_city` VALUES (3185, 3124, 0, 2, 0, '七台河市', '黑龙江省七台河市', '154600', '', 'qths', 'Q', 0);
INSERT INTO `tp_city` VALUES (3186, 3185, 0, 3, 0, '其它区', '黑龙江省七台河市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3187, 3185, 0, 3, 0, '勃利县', '黑龙江省七台河市勃利县', '154500', '', 'blx', 'B', 0);
INSERT INTO `tp_city` VALUES (3188, 3185, 0, 3, 0, '茄子河区', '黑龙江省七台河市茄子河区', '154622', '', 'qzhq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3189, 3185, 0, 3, 0, '桃山区', '黑龙江省七台河市桃山区', '154600', '', 'tsq', 'T', 0);
INSERT INTO `tp_city` VALUES (3190, 3185, 0, 3, 0, '新兴区', '黑龙江省七台河市新兴区', '154604', '', 'xxq', 'X', 0);
INSERT INTO `tp_city` VALUES (3191, 3124, 0, 2, 0, '佳木斯市', '黑龙江省佳木斯市', '154000', '', 'jmss', 'J', 0);
INSERT INTO `tp_city` VALUES (3192, 3191, 0, 3, 0, '富锦市', '黑龙江省佳木斯市富锦市', '156100', '', 'fjs', 'F', 0);
INSERT INTO `tp_city` VALUES (3193, 3191, 0, 3, 0, '其它区', '黑龙江省佳木斯市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3194, 3191, 0, 3, 0, '同江市', '黑龙江省佳木斯市同江市', '156400', '', 'tjs', 'T', 0);
INSERT INTO `tp_city` VALUES (3195, 3191, 0, 3, 0, '桦川县', '黑龙江省佳木斯市桦川县', '154300', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3196, 3191, 0, 3, 0, '汤原县', '黑龙江省佳木斯市汤原县', '154700', '', 'tyx', 'T', 0);
INSERT INTO `tp_city` VALUES (3197, 3191, 0, 3, 0, '桦南县', '黑龙江省佳木斯市桦南县', '154400', '', 'nx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3198, 3191, 0, 3, 0, '抚远县', '黑龙江省佳木斯市抚远县', '156500', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (3199, 3191, 0, 3, 0, '郊区', '黑龙江省佳木斯市郊区', '154004', '', 'jq', 'J', 0);
INSERT INTO `tp_city` VALUES (3200, 3191, 0, 3, 0, '向阳区', '黑龙江省佳木斯市向阳区', '154002', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (3201, 3191, 0, 3, 0, '永红区', '黑龙江省佳木斯市永红区', '154003', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3202, 3191, 0, 3, 0, '东风区', '黑龙江省佳木斯市东风区', '154005', '', 'dfq', 'D', 0);
INSERT INTO `tp_city` VALUES (3203, 3191, 0, 3, 0, '前进区', '黑龙江省佳木斯市前进区', '154002', '', 'qjq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3204, 3124, 0, 2, 0, '双鸭山市', '黑龙江省双鸭山市', '155100', '', 'syss', 'S', 0);
INSERT INTO `tp_city` VALUES (3205, 3204, 0, 3, 0, '饶河县', '黑龙江省双鸭山市饶河县', '155700', '', 'rhx', 'R', 0);
INSERT INTO `tp_city` VALUES (3206, 3204, 0, 3, 0, '其它区', '黑龙江省双鸭山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3207, 3204, 0, 3, 0, '集贤县', '黑龙江省双鸭山市集贤县', '155900', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (3208, 3204, 0, 3, 0, '友谊县', '黑龙江省双鸭山市友谊县', '155800', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3209, 3204, 0, 3, 0, '宝清县', '黑龙江省双鸭山市宝清县', '155600', '', 'bqx', 'B', 0);
INSERT INTO `tp_city` VALUES (3210, 3204, 0, 3, 0, '岭东区', '黑龙江省双鸭山市岭东区', '155120', '', 'ldq', 'L', 0);
INSERT INTO `tp_city` VALUES (3211, 3204, 0, 3, 0, '尖山区', '黑龙江省双鸭山市尖山区', '155100', '', 'jsq', 'J', 0);
INSERT INTO `tp_city` VALUES (3212, 3204, 0, 3, 0, '四方台区', '黑龙江省双鸭山市四方台区', '155130', '', 'sftq', 'S', 0);
INSERT INTO `tp_city` VALUES (3213, 3204, 0, 3, 0, '宝山区', '黑龙江省双鸭山市宝山区', '155131', '', 'bsq', 'B', 0);
INSERT INTO `tp_city` VALUES (3214, 3124, 0, 2, 0, '鹤岗市', '黑龙江省鹤岗市', '154100', '', 'hgs', 'H', 0);
INSERT INTO `tp_city` VALUES (3215, 3214, 0, 3, 0, '绥滨县', '黑龙江省鹤岗市绥滨县', '156200', '', 'sbx', 'S', 0);
INSERT INTO `tp_city` VALUES (3216, 3214, 0, 3, 0, '其它区', '黑龙江省鹤岗市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3217, 3214, 0, 3, 0, '萝北县', '黑龙江省鹤岗市萝北县', '154200', '', 'lbx', 'L', 0);
INSERT INTO `tp_city` VALUES (3218, 3214, 0, 3, 0, '工农区', '黑龙江省鹤岗市工农区', '154101', '', 'gnq', 'G', 0);
INSERT INTO `tp_city` VALUES (3219, 3214, 0, 3, 0, '向阳区', '黑龙江省鹤岗市向阳区', '154100', '', 'xyq', 'X', 0);
INSERT INTO `tp_city` VALUES (3220, 3214, 0, 3, 0, '兴山区', '黑龙江省鹤岗市兴山区', '154105', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (3221, 3214, 0, 3, 0, '东山区', '黑龙江省鹤岗市东山区', '154106', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (3222, 3214, 0, 3, 0, '兴安区', '黑龙江省鹤岗市兴安区', '154102', '', 'xaq', 'X', 0);
INSERT INTO `tp_city` VALUES (3223, 3214, 0, 3, 0, '南山区', '黑龙江省鹤岗市南山区', '154104', '', 'nsq', 'N', 0);
INSERT INTO `tp_city` VALUES (3224, 3124, 0, 2, 0, '大庆市', '黑龙江省大庆市', '163000', '', 'dqs', 'D', 0);
INSERT INTO `tp_city` VALUES (3225, 3224, 0, 3, 0, '杜尔伯特蒙古族自治县', '黑龙江省大庆市杜尔伯特蒙古族自治县', '166200', '', 'debtmgzzzx', 'D', 0);
INSERT INTO `tp_city` VALUES (3226, 3224, 0, 3, 0, '其它区', '黑龙江省大庆市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3227, 3224, 0, 3, 0, '林甸县', '黑龙江省大庆市林甸县', '166300', '', 'ldx', 'L', 0);
INSERT INTO `tp_city` VALUES (3228, 3224, 0, 3, 0, '肇源县', '黑龙江省大庆市肇源县', '166500', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3229, 3224, 0, 3, 0, '肇州县', '黑龙江省大庆市肇州县', '166400', '', 'zzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3230, 3224, 0, 3, 0, '大同区', '黑龙江省大庆市大同区', '163814', '', 'dtq', 'D', 0);
INSERT INTO `tp_city` VALUES (3231, 3224, 0, 3, 0, '让胡路区', '黑龙江省大庆市让胡路区', '163453', '', 'rhlq', 'R', 0);
INSERT INTO `tp_city` VALUES (3232, 3224, 0, 3, 0, '红岗区', '黑龙江省大庆市红岗区', '163512', '', 'hgq', 'H', 0);
INSERT INTO `tp_city` VALUES (3233, 3224, 0, 3, 0, '萨尔图区', '黑龙江省大庆市萨尔图区', '163311', '', 'setq', 'S', 0);
INSERT INTO `tp_city` VALUES (3234, 3224, 0, 3, 0, '龙凤区', '黑龙江省大庆市龙凤区', '163711', '', 'lfq', 'L', 0);
INSERT INTO `tp_city` VALUES (3235, 3124, 0, 2, 0, '齐齐哈尔市', '黑龙江省齐齐哈尔市', '161000', '', 'qqhes', 'Q', 0);
INSERT INTO `tp_city` VALUES (3236, 3235, 0, 3, 0, '富拉尔基区', '黑龙江省齐齐哈尔市富拉尔基区', '161041', '', 'flejq', 'F', 0);
INSERT INTO `tp_city` VALUES (3237, 3235, 0, 3, 0, '碾子山区', '黑龙江省齐齐哈尔市碾子山区', '161046', '', 'nzsq', 'N', 0);
INSERT INTO `tp_city` VALUES (3238, 3235, 0, 3, 0, '铁锋区', '黑龙江省齐齐哈尔市铁锋区', '161000', '', 'tfq', 'T', 0);
INSERT INTO `tp_city` VALUES (3239, 3235, 0, 3, 0, '昂昂溪区', '黑龙江省齐齐哈尔市昂昂溪区', '161031', '', 'aaxq', 'A', 0);
INSERT INTO `tp_city` VALUES (3240, 3235, 0, 3, 0, '龙沙区', '黑龙江省齐齐哈尔市龙沙区', '161000', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (3241, 3235, 0, 3, 0, '建华区', '黑龙江省齐齐哈尔市建华区', '161006', '', 'jhq', 'J', 0);
INSERT INTO `tp_city` VALUES (3242, 3235, 0, 3, 0, '龙江县', '黑龙江省齐齐哈尔市龙江县', '161100', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (3243, 3235, 0, 3, 0, '依安县', '黑龙江省齐齐哈尔市依安县', '161500', '', 'yax', 'Y', 0);
INSERT INTO `tp_city` VALUES (3244, 3235, 0, 3, 0, '梅里斯达斡尔族区', '黑龙江省齐齐哈尔市梅里斯达斡尔族区', '161021', '', 'mlsdwezq', 'M', 0);
INSERT INTO `tp_city` VALUES (3245, 3235, 0, 3, 0, '泰来县', '黑龙江省齐齐哈尔市泰来县', '162400', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (3246, 3235, 0, 3, 0, '甘南县', '黑龙江省齐齐哈尔市甘南县', '162100', '', 'gnx', 'G', 0);
INSERT INTO `tp_city` VALUES (3247, 3235, 0, 3, 0, '富裕县', '黑龙江省齐齐哈尔市富裕县', '161200', '', 'fyx', 'F', 0);
INSERT INTO `tp_city` VALUES (3248, 3235, 0, 3, 0, '克山县', '黑龙江省齐齐哈尔市克山县', '161600', '', 'ksx', 'K', 0);
INSERT INTO `tp_city` VALUES (3249, 3235, 0, 3, 0, '克东县', '黑龙江省齐齐哈尔市克东县', '164800', '', 'kdx', 'K', 0);
INSERT INTO `tp_city` VALUES (3250, 3235, 0, 3, 0, '拜泉县', '黑龙江省齐齐哈尔市拜泉县', '164700', '', 'bqx', 'B', 0);
INSERT INTO `tp_city` VALUES (3251, 3235, 0, 3, 0, '讷河市', '黑龙江省齐齐哈尔市讷河市', '161300', '', 'hs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3252, 3235, 0, 3, 0, '其它区', '黑龙江省齐齐哈尔市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3253, 3124, 0, 2, 0, '鸡西市', '黑龙江省鸡西市', '158100', '', 'jxs', 'J', 0);
INSERT INTO `tp_city` VALUES (3254, 3253, 0, 3, 0, '恒山区', '黑龙江省鸡西市恒山区', '158130', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (3255, 3253, 0, 3, 0, '鸡冠区', '黑龙江省鸡西市鸡冠区', '158100', '', 'jgq', 'J', 0);
INSERT INTO `tp_city` VALUES (3256, 3253, 0, 3, 0, '城子河区', '黑龙江省鸡西市城子河区', '158170', '', 'czhq', 'C', 0);
INSERT INTO `tp_city` VALUES (3257, 3253, 0, 3, 0, '麻山区', '黑龙江省鸡西市麻山区', '158180', '', 'msq', 'M', 0);
INSERT INTO `tp_city` VALUES (3258, 3253, 0, 3, 0, '滴道区', '黑龙江省鸡西市滴道区', '158150', '', 'ddq', 'D', 0);
INSERT INTO `tp_city` VALUES (3259, 3253, 0, 3, 0, '梨树区', '黑龙江省鸡西市梨树区', '158160', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (3260, 3253, 0, 3, 0, '鸡东县', '黑龙江省鸡西市鸡东县', '158200', '', 'jdx', 'J', 0);
INSERT INTO `tp_city` VALUES (3261, 3253, 0, 3, 0, '密山市', '黑龙江省鸡西市密山市', '158300', '', 'mss', 'M', 0);
INSERT INTO `tp_city` VALUES (3262, 3253, 0, 3, 0, '其它区', '黑龙江省鸡西市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3263, 3253, 0, 3, 0, '虎林市', '黑龙江省鸡西市虎林市', '158400', '', 'hls', 'H', 0);
INSERT INTO `tp_city` VALUES (3264, 3124, 0, 2, 0, '哈尔滨市', '黑龙江省哈尔滨市', '150000', '', 'hebs', 'H', 0);
INSERT INTO `tp_city` VALUES (3265, 3264, 0, 3, 0, '其它区', '黑龙江省哈尔滨市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3266, 3264, 0, 3, 0, '阿城市', '黑龙江省哈尔滨市阿城市', '150300', '', 'acs', 'A', 0);
INSERT INTO `tp_city` VALUES (3267, 3264, 0, 3, 0, '五常市', '黑龙江省哈尔滨市五常市', '150200', '', 'wcs', 'W', 0);
INSERT INTO `tp_city` VALUES (3268, 3264, 0, 3, 0, '尚志市', '黑龙江省哈尔滨市尚志市', '150600', '', 'szs', 'S', 0);
INSERT INTO `tp_city` VALUES (3269, 3264, 0, 3, 0, '双城市', '黑龙江省哈尔滨市双城市', '150100', '', 'scs', 'S', 0);
INSERT INTO `tp_city` VALUES (3270, 3264, 0, 3, 0, '阿城区', '黑龙江省哈尔滨市阿城区', '150300', '', 'acq', 'A', 0);
INSERT INTO `tp_city` VALUES (3271, 3264, 0, 3, 0, '南岗区', '黑龙江省哈尔滨市南岗区', '150006', '', 'ngq', 'N', 0);
INSERT INTO `tp_city` VALUES (3272, 3264, 0, 3, 0, '道里区', '黑龙江省哈尔滨市道里区', '150010', '', 'dlq', 'D', 0);
INSERT INTO `tp_city` VALUES (3273, 3264, 0, 3, 0, '动力区', '黑龙江省哈尔滨市动力区', '150040', '', 'dlq', 'D', 0);
INSERT INTO `tp_city` VALUES (3274, 3264, 0, 3, 0, '香坊区', '黑龙江省哈尔滨市香坊区', '150036', '', 'xfq', 'X', 0);
INSERT INTO `tp_city` VALUES (3275, 3264, 0, 3, 0, '道外区', '黑龙江省哈尔滨市道外区', '150026', '', 'dwq', 'D', 0);
INSERT INTO `tp_city` VALUES (3276, 3264, 0, 3, 0, '呼兰区', '黑龙江省哈尔滨市呼兰区', '150500', '', 'hlq', 'H', 0);
INSERT INTO `tp_city` VALUES (3277, 3264, 0, 3, 0, '松北区', '黑龙江省哈尔滨市松北区', '150028', '', 'sbq', 'S', 0);
INSERT INTO `tp_city` VALUES (3278, 3264, 0, 3, 0, '平房区', '黑龙江省哈尔滨市平房区', '150060', '', 'pfq', 'P', 0);
INSERT INTO `tp_city` VALUES (3279, 3264, 0, 3, 0, '延寿县', '黑龙江省哈尔滨市延寿县', '150700', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3280, 3264, 0, 3, 0, '通河县', '黑龙江省哈尔滨市通河县', '150900', '', 'thx', 'T', 0);
INSERT INTO `tp_city` VALUES (3281, 3264, 0, 3, 0, '依兰县', '黑龙江省哈尔滨市依兰县', '154800', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3282, 3264, 0, 3, 0, '方正县', '黑龙江省哈尔滨市方正县', '150800', '', 'fzx', 'F', 0);
INSERT INTO `tp_city` VALUES (3283, 3264, 0, 3, 0, '宾县', '黑龙江省哈尔滨市宾县', '150400', '', 'bx', 'B', 0);
INSERT INTO `tp_city` VALUES (3284, 3264, 0, 3, 0, '巴彦县', '黑龙江省哈尔滨市巴彦县', '151800', '', 'byx', 'B', 0);
INSERT INTO `tp_city` VALUES (3285, 3264, 0, 3, 0, '木兰县', '黑龙江省哈尔滨市木兰县', '151900', '', 'mlx', 'M', 0);
INSERT INTO `tp_city` VALUES (3286, 0, 0, 1, 0, '广西壮族自治区', '广西壮族自治区', '', '', 'gxzzzzq', 'G', 0);
INSERT INTO `tp_city` VALUES (3287, 3286, 0, 2, 0, '崇左市', '广西壮族自治区崇左市', '532200', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (3288, 3287, 0, 3, 0, '其它区', '广西壮族自治区崇左市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3289, 3287, 0, 3, 0, '凭祥市', '广西壮族自治区崇左市凭祥市', '532600', '', 'pxs', 'P', 0);
INSERT INTO `tp_city` VALUES (3290, 3287, 0, 3, 0, '龙州县', '广西壮族自治区崇左市龙州县', '532400', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (3291, 3287, 0, 3, 0, '宁明县', '广西壮族自治区崇左市宁明县', '532500', '', 'nmx', 'N', 0);
INSERT INTO `tp_city` VALUES (3292, 3287, 0, 3, 0, '扶绥县', '广西壮族自治区崇左市扶绥县', '532100', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (3293, 3287, 0, 3, 0, '江州区', '广西壮族自治区崇左市江州区', '532200', '', 'jzq', 'J', 0);
INSERT INTO `tp_city` VALUES (3294, 3287, 0, 3, 0, '大新县', '广西壮族自治区崇左市大新县', '532300', '', 'dxx', 'D', 0);
INSERT INTO `tp_city` VALUES (3295, 3287, 0, 3, 0, '天等县', '广西壮族自治区崇左市天等县', '532800', '', 'tdx', 'T', 0);
INSERT INTO `tp_city` VALUES (3296, 3286, 0, 2, 0, '河池市', '广西壮族自治区河池市', '547000', '', 'hcs', 'H', 0);
INSERT INTO `tp_city` VALUES (3297, 3296, 0, 3, 0, '金城江区', '广西壮族自治区河池市金城江区', '547000', '', 'jcjq', 'J', 0);
INSERT INTO `tp_city` VALUES (3298, 3296, 0, 3, 0, '南丹县', '广西壮族自治区河池市南丹县', '547200', '', 'ndx', 'N', 0);
INSERT INTO `tp_city` VALUES (3299, 3296, 0, 3, 0, '天峨县', '广西壮族自治区河池市天峨县', '547300', '', 'tex', 'T', 0);
INSERT INTO `tp_city` VALUES (3300, 3296, 0, 3, 0, '凤山县', '广西壮族自治区河池市凤山县', '547600', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (3301, 3296, 0, 3, 0, '都安瑶族自治县', '广西壮族自治区河池市都安瑶族自治县', '530700', '', 'dayzzzx', 'D', 0);
INSERT INTO `tp_city` VALUES (3302, 3296, 0, 3, 0, '大化瑶族自治县', '广西壮族自治区河池市大化瑶族自治县', '530800', '', 'dhyzzzx', 'D', 0);
INSERT INTO `tp_city` VALUES (3303, 3296, 0, 3, 0, '东兰县', '广西壮族自治区河池市东兰县', '547400', '', 'dlx', 'D', 0);
INSERT INTO `tp_city` VALUES (3304, 3296, 0, 3, 0, '罗城仫佬族自治县', '广西壮族自治区河池市罗城仫佬族自治县', '546400', '', 'lclzzzx', 'L', 0);
INSERT INTO `tp_city` VALUES (3305, 3296, 0, 3, 0, '环江毛南族自治县', '广西壮族自治区河池市环江毛南族自治县', '547100', '', 'hjmnzzzx', 'H', 0);
INSERT INTO `tp_city` VALUES (3306, 3296, 0, 3, 0, '巴马瑶族自治县', '广西壮族自治区河池市巴马瑶族自治县', '547500', '', 'bmyzzzx', 'B', 0);
INSERT INTO `tp_city` VALUES (3307, 3296, 0, 3, 0, '宜州市', '广西壮族自治区河池市宜州市', '546300', '', 'yzs', 'Y', 0);
INSERT INTO `tp_city` VALUES (3308, 3296, 0, 3, 0, '其它区', '广西壮族自治区河池市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3309, 3286, 0, 2, 0, '来宾市', '广西壮族自治区来宾市', '546100', '', 'lbs', 'L', 0);
INSERT INTO `tp_city` VALUES (3310, 3309, 0, 3, 0, '合山市', '广西壮族自治区来宾市合山市', '546500', '', 'hss', 'H', 0);
INSERT INTO `tp_city` VALUES (3311, 3309, 0, 3, 0, '其它区', '广西壮族自治区来宾市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3312, 3309, 0, 3, 0, '兴宾区', '广西壮族自治区来宾市兴宾区', '546100', '', 'xbq', 'X', 0);
INSERT INTO `tp_city` VALUES (3313, 3309, 0, 3, 0, '象州县', '广西壮族自治区来宾市象州县', '545800', '', 'xzx', 'X', 0);
INSERT INTO `tp_city` VALUES (3314, 3309, 0, 3, 0, '武宣县', '广西壮族自治区来宾市武宣县', '545900', '', 'wxx', 'W', 0);
INSERT INTO `tp_city` VALUES (3315, 3309, 0, 3, 0, '忻城县', '广西壮族自治区来宾市忻城县', '546200', '', 'xcx', 'X', 0);
INSERT INTO `tp_city` VALUES (3316, 3309, 0, 3, 0, '金秀瑶族自治县', '广西壮族自治区来宾市金秀瑶族自治县', '545700', '', 'jxyzzzx', 'J', 0);
INSERT INTO `tp_city` VALUES (3317, 3286, 0, 2, 0, '贺州市', '广西壮族自治区贺州市', '542800', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (3318, 3317, 0, 3, 0, '八步区', '广西壮族自治区贺州市八步区', '542800', '', 'bbq', 'B', 0);
INSERT INTO `tp_city` VALUES (3319, 3317, 0, 3, 0, '平桂管理区', '广西壮族自治区贺州市平桂管理区', '', '', 'pgglq', 'P', 0);
INSERT INTO `tp_city` VALUES (3320, 3317, 0, 3, 0, '其它区', '广西壮族自治区贺州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3321, 3317, 0, 3, 0, '富川瑶族自治县', '广西壮族自治区贺州市富川瑶族自治县', '542700', '', 'fcyzzzx', 'F', 0);
INSERT INTO `tp_city` VALUES (3322, 3317, 0, 3, 0, '钟山县', '广西壮族自治区贺州市钟山县', '542600', '', 'zsx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3323, 3317, 0, 3, 0, '昭平县', '广西壮族自治区贺州市昭平县', '546800', '', 'zpx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3324, 3286, 0, 2, 0, '百色市', '广西壮族自治区百色市', '533000', '', 'bss', 'B', 0);
INSERT INTO `tp_city` VALUES (3325, 3324, 0, 3, 0, '右江区', '广西壮族自治区百色市右江区', '533000', '', 'yjq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3326, 3324, 0, 3, 0, '西林县', '广西壮族自治区百色市西林县', '533500', '', 'xlx', 'X', 0);
INSERT INTO `tp_city` VALUES (3327, 3324, 0, 3, 0, '隆林各族自治县', '广西壮族自治区百色市隆林各族自治县', '533400', '', 'llgzzzx', 'L', 0);
INSERT INTO `tp_city` VALUES (3328, 3324, 0, 3, 0, '乐业县', '广西壮族自治区百色市乐业县', '533200', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (3329, 3324, 0, 3, 0, '田林县', '广西壮族自治区百色市田林县', '533300', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (3330, 3324, 0, 3, 0, '那坡县', '广西壮族自治区百色市那坡县', '533900', '', 'npx', 'N', 0);
INSERT INTO `tp_city` VALUES (3331, 3324, 0, 3, 0, '凌云县', '广西壮族自治区百色市凌云县', '533100', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (3332, 3324, 0, 3, 0, '德保县', '广西壮族自治区百色市德保县', '533700', '', 'dbx', 'D', 0);
INSERT INTO `tp_city` VALUES (3333, 3324, 0, 3, 0, '靖西县', '广西壮族自治区百色市靖西县', '533800', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (3334, 3324, 0, 3, 0, '其它区', '广西壮族自治区百色市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3335, 3324, 0, 3, 0, '平果县', '广西壮族自治区百色市平果县', '531400', '', 'pgx', 'P', 0);
INSERT INTO `tp_city` VALUES (3336, 3324, 0, 3, 0, '田东县', '广西壮族自治区百色市田东县', '531500', '', 'tdx', 'T', 0);
INSERT INTO `tp_city` VALUES (3337, 3324, 0, 3, 0, '田阳县', '广西壮族自治区百色市田阳县', '533600', '', 'tyx', 'T', 0);
INSERT INTO `tp_city` VALUES (3338, 3286, 0, 2, 0, '玉林市', '广西壮族自治区玉林市', '537000', '', 'yls', 'Y', 0);
INSERT INTO `tp_city` VALUES (3339, 3338, 0, 3, 0, '北流市', '广西壮族自治区玉林市北流市', '537400', '', 'bls', 'B', 0);
INSERT INTO `tp_city` VALUES (3340, 3338, 0, 3, 0, '其它区', '广西壮族自治区玉林市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3341, 3338, 0, 3, 0, '兴业县', '广西壮族自治区玉林市兴业县', '537800', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (3342, 3338, 0, 3, 0, '容县', '广西壮族自治区玉林市容县', '537500', '', 'rx', 'R', 0);
INSERT INTO `tp_city` VALUES (3343, 3338, 0, 3, 0, '陆川县', '广西壮族自治区玉林市陆川县', '537700', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (3344, 3338, 0, 3, 0, '博白县', '广西壮族自治区玉林市博白县', '537600', '', 'bbx', 'B', 0);
INSERT INTO `tp_city` VALUES (3345, 3338, 0, 3, 0, '福绵区', '广西壮族自治区玉林市福绵区', '', '', 'fmq', 'F', 0);
INSERT INTO `tp_city` VALUES (3346, 3338, 0, 3, 0, '玉州区', '广西壮族自治区玉林市玉州区', '537000', '', 'yzq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3347, 3286, 0, 2, 0, '钦州市', '广西壮族自治区钦州市', '535000', '', 'qzs', 'Q', 0);
INSERT INTO `tp_city` VALUES (3348, 3347, 0, 3, 0, '其它区', '广西壮族自治区钦州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3349, 3347, 0, 3, 0, '浦北县', '广西壮族自治区钦州市浦北县', '535300', '', 'pbx', 'P', 0);
INSERT INTO `tp_city` VALUES (3350, 3347, 0, 3, 0, '灵山县', '广西壮族自治区钦州市灵山县', '535400', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (3351, 3347, 0, 3, 0, '钦北区', '广西壮族自治区钦州市钦北区', '535000', '', 'qbq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3352, 3347, 0, 3, 0, '钦南区', '广西壮族自治区钦州市钦南区', '535000', '', 'qnq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3353, 3286, 0, 2, 0, '贵港市', '广西壮族自治区贵港市', '537100', '', 'ggs', 'G', 0);
INSERT INTO `tp_city` VALUES (3354, 3353, 0, 3, 0, '平南县', '广西壮族自治区贵港市平南县', '537300', '', 'pnx', 'P', 0);
INSERT INTO `tp_city` VALUES (3355, 3353, 0, 3, 0, '其它区', '广西壮族自治区贵港市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3356, 3353, 0, 3, 0, '桂平市', '广西壮族自治区贵港市桂平市', '537200', '', 'gps', 'G', 0);
INSERT INTO `tp_city` VALUES (3357, 3353, 0, 3, 0, '覃塘区', '广西壮族自治区贵港市覃塘区', '537121', '', 'tq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3358, 3353, 0, 3, 0, '港北区', '广西壮族自治区贵港市港北区', '537100', '', 'gbq', 'G', 0);
INSERT INTO `tp_city` VALUES (3359, 3353, 0, 3, 0, '港南区', '广西壮族自治区贵港市港南区', '537132', '', 'gnq', 'G', 0);
INSERT INTO `tp_city` VALUES (3360, 3286, 0, 2, 0, '防城港市', '广西壮族自治区防城港市', '538000', '', 'fcgs', 'F', 0);
INSERT INTO `tp_city` VALUES (3361, 3360, 0, 3, 0, '港口区', '广西壮族自治区防城港市港口区', '538001', '', 'gkq', 'G', 0);
INSERT INTO `tp_city` VALUES (3362, 3360, 0, 3, 0, '防城区', '广西壮族自治区防城港市防城区', '538021', '', 'fcq', 'F', 0);
INSERT INTO `tp_city` VALUES (3363, 3360, 0, 3, 0, '上思县', '广西壮族自治区防城港市上思县', '535500', '', 'ssx', 'S', 0);
INSERT INTO `tp_city` VALUES (3364, 3360, 0, 3, 0, '其它区', '广西壮族自治区防城港市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3365, 3360, 0, 3, 0, '东兴市', '广西壮族自治区防城港市东兴市', '538100', '', 'dxs', 'D', 0);
INSERT INTO `tp_city` VALUES (3366, 3286, 0, 2, 0, '南宁市', '广西壮族自治区南宁市', '530000', '', 'nns', 'N', 0);
INSERT INTO `tp_city` VALUES (3367, 3366, 0, 3, 0, '兴宁区', '广西壮族自治区南宁市兴宁区', '530012', '', 'xnq', 'X', 0);
INSERT INTO `tp_city` VALUES (3368, 3366, 0, 3, 0, '青秀区', '广西壮族自治区南宁市青秀区', '530022', '', 'qxq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3369, 3366, 0, 3, 0, '良庆区', '广西壮族自治区南宁市良庆区', '530200', '', 'lqq', 'L', 0);
INSERT INTO `tp_city` VALUES (3370, 3366, 0, 3, 0, '邕宁区', '广西壮族自治区南宁市邕宁区', '530200', '', 'nq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3371, 3366, 0, 3, 0, '江南区', '广西壮族自治区南宁市江南区', '530031', '', 'jnq', 'J', 0);
INSERT INTO `tp_city` VALUES (3372, 3366, 0, 3, 0, '西乡塘区', '广西壮族自治区南宁市西乡塘区', '530001', '', 'xxtq', 'X', 0);
INSERT INTO `tp_city` VALUES (3373, 3366, 0, 3, 0, '其它区', '广西壮族自治区南宁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3374, 3366, 0, 3, 0, '隆安县', '广西壮族自治区南宁市隆安县', '532700', '', 'lax', 'L', 0);
INSERT INTO `tp_city` VALUES (3375, 3366, 0, 3, 0, '武鸣县', '广西壮族自治区南宁市武鸣县', '530100', '', 'wmx', 'W', 0);
INSERT INTO `tp_city` VALUES (3376, 3366, 0, 3, 0, '横县', '广西壮族自治区南宁市横县', '530300', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (3377, 3366, 0, 3, 0, '宾阳县', '广西壮族自治区南宁市宾阳县', '530400', '', 'byx', 'B', 0);
INSERT INTO `tp_city` VALUES (3378, 3366, 0, 3, 0, '上林县', '广西壮族自治区南宁市上林县', '530500', '', 'slx', 'S', 0);
INSERT INTO `tp_city` VALUES (3379, 3366, 0, 3, 0, '马山县', '广西壮族自治区南宁市马山县', '530600', '', 'msx', 'M', 0);
INSERT INTO `tp_city` VALUES (3380, 3286, 0, 2, 0, '柳州市', '广西壮族自治区柳州市', '545000', '', 'lzs', 'L', 0);
INSERT INTO `tp_city` VALUES (3381, 3380, 0, 3, 0, '融水苗族自治县', '广西壮族自治区柳州市融水苗族自治县', '545300', '', 'rsmzzzx', 'R', 0);
INSERT INTO `tp_city` VALUES (3382, 3380, 0, 3, 0, '融安县', '广西壮族自治区柳州市融安县', '545400', '', 'rax', 'R', 0);
INSERT INTO `tp_city` VALUES (3383, 3380, 0, 3, 0, '其它区', '广西壮族自治区柳州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3384, 3380, 0, 3, 0, '三江侗族自治县', '广西壮族自治区柳州市三江侗族自治县', '545500', '', 'sjdzzzx', 'S', 0);
INSERT INTO `tp_city` VALUES (3385, 3380, 0, 3, 0, '柳江县', '广西壮族自治区柳州市柳江县', '545100', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (3386, 3380, 0, 3, 0, '柳城县', '广西壮族自治区柳州市柳城县', '545200', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (3387, 3380, 0, 3, 0, '鹿寨县', '广西壮族自治区柳州市鹿寨县', '545600', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (3388, 3380, 0, 3, 0, '柳北区', '广西壮族自治区柳州市柳北区', '545001', '', 'lbq', 'L', 0);
INSERT INTO `tp_city` VALUES (3389, 3380, 0, 3, 0, '柳南区', '广西壮族自治区柳州市柳南区', '545005', '', 'lnq', 'L', 0);
INSERT INTO `tp_city` VALUES (3390, 3380, 0, 3, 0, '鱼峰区', '广西壮族自治区柳州市鱼峰区', '545005', '', 'yfq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3391, 3380, 0, 3, 0, '城中区', '广西壮族自治区柳州市城中区', '545001', '', 'czq', 'C', 0);
INSERT INTO `tp_city` VALUES (3392, 3286, 0, 2, 0, '桂林市', '广西壮族自治区桂林市', '541000', '', 'gls', 'G', 0);
INSERT INTO `tp_city` VALUES (3393, 3392, 0, 3, 0, '叠彩区', '广西壮族自治区桂林市叠彩区', '541001', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (3394, 3392, 0, 3, 0, '秀峰区', '广西壮族自治区桂林市秀峰区', '541001', '', 'xfq', 'X', 0);
INSERT INTO `tp_city` VALUES (3395, 3392, 0, 3, 0, '雁山区', '广西壮族自治区桂林市雁山区', '541006', '', 'ysq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3396, 3392, 0, 3, 0, '七星区', '广西壮族自治区桂林市七星区', '541004', '', 'qxq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3397, 3392, 0, 3, 0, '象山区', '广西壮族自治区桂林市象山区', '541002', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (3398, 3392, 0, 3, 0, '全州县', '广西壮族自治区桂林市全州县', '541500', '', 'qzx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3399, 3392, 0, 3, 0, '兴安县', '广西壮族自治区桂林市兴安县', '541300', '', 'xax', 'X', 0);
INSERT INTO `tp_city` VALUES (3400, 3392, 0, 3, 0, '永福县', '广西壮族自治区桂林市永福县', '541800', '', 'yfx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3401, 3392, 0, 3, 0, '灌阳县', '广西壮族自治区桂林市灌阳县', '541600', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (3402, 3392, 0, 3, 0, '阳朔县', '广西壮族自治区桂林市阳朔县', '541900', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3403, 3392, 0, 3, 0, '临桂区', '广西壮族自治区桂林市临桂区', '541100', '', 'lgq', 'L', 0);
INSERT INTO `tp_city` VALUES (3404, 3392, 0, 3, 0, '灵川县', '广西壮族自治区桂林市灵川县', '541200', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (3405, 3392, 0, 3, 0, '恭城瑶族自治县', '广西壮族自治区桂林市恭城瑶族自治县', '542500', '', 'gcyzzzx', 'G', 0);
INSERT INTO `tp_city` VALUES (3406, 3392, 0, 3, 0, '其它区', '广西壮族自治区桂林市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3407, 3392, 0, 3, 0, '龙胜各族自治县', '广西壮族自治区桂林市龙胜各族自治县', '541700', '', 'lsgzzzx', 'L', 0);
INSERT INTO `tp_city` VALUES (3408, 3392, 0, 3, 0, '资源县', '广西壮族自治区桂林市资源县', '541400', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3409, 3392, 0, 3, 0, '平乐县', '广西壮族自治区桂林市平乐县', '542400', '', 'plx', 'P', 0);
INSERT INTO `tp_city` VALUES (3410, 3392, 0, 3, 0, '荔浦县', '广西壮族自治区桂林市荔浦县', '546600', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (3411, 3286, 0, 2, 0, '梧州市', '广西壮族自治区梧州市', '543000', '', 'wzs', 'W', 0);
INSERT INTO `tp_city` VALUES (3412, 3411, 0, 3, 0, '万秀区', '广西壮族自治区梧州市万秀区', '543000', '', 'wxq', 'W', 0);
INSERT INTO `tp_city` VALUES (3413, 3411, 0, 3, 0, '龙圩区', '广西壮族自治区梧州市龙圩区', '', '', 'lq', 'L', 0);
INSERT INTO `tp_city` VALUES (3414, 3411, 0, 3, 0, '长洲区', '广西壮族自治区梧州市长洲区', '543002', '', 'czq', 'C', 0);
INSERT INTO `tp_city` VALUES (3415, 3411, 0, 3, 0, '蝶山区', '广西壮族自治区梧州市蝶山区', '543002', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (3416, 3411, 0, 3, 0, '藤县', '广西壮族自治区梧州市藤县', '543300', '', 'tx', 'T', 0);
INSERT INTO `tp_city` VALUES (3417, 3411, 0, 3, 0, '蒙山县', '广西壮族自治区梧州市蒙山县', '546700', '', 'msx', 'M', 0);
INSERT INTO `tp_city` VALUES (3418, 3411, 0, 3, 0, '苍梧县', '广西壮族自治区梧州市苍梧县', '543100', '', 'cwx', 'C', 0);
INSERT INTO `tp_city` VALUES (3419, 3411, 0, 3, 0, '其它区', '广西壮族自治区梧州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3420, 3411, 0, 3, 0, '岑溪市', '广西壮族自治区梧州市岑溪市', '543200', '', 'xs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3421, 3286, 0, 2, 0, '北海市', '广西壮族自治区北海市', '536000', '', 'bhs', 'B', 0);
INSERT INTO `tp_city` VALUES (3422, 3421, 0, 3, 0, '海城区', '广西壮族自治区北海市海城区', '536000', '', 'hcq', 'H', 0);
INSERT INTO `tp_city` VALUES (3423, 3421, 0, 3, 0, '银海区', '广西壮族自治区北海市银海区', '536000', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3424, 3421, 0, 3, 0, '合浦县', '广西壮族自治区北海市合浦县', '536100', '', 'hpx', 'H', 0);
INSERT INTO `tp_city` VALUES (3425, 3421, 0, 3, 0, '其它区', '广西壮族自治区北海市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3426, 3421, 0, 3, 0, '铁山港区', '广西壮族自治区北海市铁山港区', '536017', '', 'tsgq', 'T', 0);
INSERT INTO `tp_city` VALUES (3427, 0, 0, 1, 0, '陕西省', '陕西省', '', '', 'sxs', 'S', 0);
INSERT INTO `tp_city` VALUES (3428, 3427, 0, 2, 0, '宝鸡市', '陕西省宝鸡市', '721000', '', 'bjs', 'B', 0);
INSERT INTO `tp_city` VALUES (3429, 3428, 0, 3, 0, '渭滨区', '陕西省宝鸡市渭滨区', '721000', '', 'wbq', 'W', 0);
INSERT INTO `tp_city` VALUES (3430, 3428, 0, 3, 0, '金台区', '陕西省宝鸡市金台区', '721001', '', 'jtq', 'J', 0);
INSERT INTO `tp_city` VALUES (3431, 3428, 0, 3, 0, '其它区', '陕西省宝鸡市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3432, 3428, 0, 3, 0, '千阳县', '陕西省宝鸡市千阳县', '721100', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3433, 3428, 0, 3, 0, '麟游县', '陕西省宝鸡市麟游县', '721500', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3434, 3428, 0, 3, 0, '凤县', '陕西省宝鸡市凤县', '721700', '', 'fx', 'F', 0);
INSERT INTO `tp_city` VALUES (3435, 3428, 0, 3, 0, '太白县', '陕西省宝鸡市太白县', '721600', '', 'tbx', 'T', 0);
INSERT INTO `tp_city` VALUES (3436, 3428, 0, 3, 0, '扶风县', '陕西省宝鸡市扶风县', '722200', '', 'ffx', 'F', 0);
INSERT INTO `tp_city` VALUES (3437, 3428, 0, 3, 0, '眉县', '陕西省宝鸡市眉县', '722300', '', 'mx', 'M', 0);
INSERT INTO `tp_city` VALUES (3438, 3428, 0, 3, 0, '陇县', '陕西省宝鸡市陇县', '721200', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (3439, 3428, 0, 3, 0, '凤翔县', '陕西省宝鸡市凤翔县', '721400', '', 'fxx', 'F', 0);
INSERT INTO `tp_city` VALUES (3440, 3428, 0, 3, 0, '岐山县', '陕西省宝鸡市岐山县', '722400', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3441, 3428, 0, 3, 0, '陈仓区', '陕西省宝鸡市陈仓区', '721300', '', 'ccq', 'C', 0);
INSERT INTO `tp_city` VALUES (3442, 3427, 0, 2, 0, '铜川市', '陕西省铜川市', '727000', '', 'tcs', 'T', 0);
INSERT INTO `tp_city` VALUES (3443, 3442, 0, 3, 0, '其它区', '陕西省铜川市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3444, 3442, 0, 3, 0, '宜君县', '陕西省铜川市宜君县', '727200', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3445, 3442, 0, 3, 0, '王益区', '陕西省铜川市王益区', '727000', '', 'wyq', 'W', 0);
INSERT INTO `tp_city` VALUES (3446, 3442, 0, 3, 0, '印台区', '陕西省铜川市印台区', '727007', '', 'ytq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3447, 3442, 0, 3, 0, '耀州区', '陕西省铜川市耀州区', '727100', '', 'yzq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3448, 3427, 0, 2, 0, '西安市', '陕西省西安市', '710000', '', 'xas', 'X', 0);
INSERT INTO `tp_city` VALUES (3449, 3448, 0, 3, 0, '长安区', '陕西省西安市长安区', '710100', '', 'caq', 'C', 0);
INSERT INTO `tp_city` VALUES (3450, 3448, 0, 3, 0, '阎良区', '陕西省西安市阎良区', '710089', '', 'ylq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3451, 3448, 0, 3, 0, '临潼区', '陕西省西安市临潼区', '710600', '', 'lq', 'L', 0);
INSERT INTO `tp_city` VALUES (3452, 3448, 0, 3, 0, '未央区', '陕西省西安市未央区', '710016', '', 'wyq', 'W', 0);
INSERT INTO `tp_city` VALUES (3453, 3448, 0, 3, 0, '雁塔区', '陕西省西安市雁塔区', '710061', '', 'ytq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3454, 3448, 0, 3, 0, '高陵县', '陕西省西安市高陵县', '710200', '', 'glx', 'G', 0);
INSERT INTO `tp_city` VALUES (3455, 3448, 0, 3, 0, '其它区', '陕西省西安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3456, 3448, 0, 3, 0, '周至县', '陕西省西安市周至县', '710400', '', 'zzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3457, 3448, 0, 3, 0, '户县', '陕西省西安市户县', '710300', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (3458, 3448, 0, 3, 0, '蓝田县', '陕西省西安市蓝田县', '710500', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (3459, 3448, 0, 3, 0, '碑林区', '陕西省西安市碑林区', '710001', '', 'blq', 'B', 0);
INSERT INTO `tp_city` VALUES (3460, 3448, 0, 3, 0, '新城区', '陕西省西安市新城区', '710005', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (3461, 3448, 0, 3, 0, '莲湖区', '陕西省西安市莲湖区', '710003', '', 'lhq', 'L', 0);
INSERT INTO `tp_city` VALUES (3462, 3448, 0, 3, 0, '灞桥区', '陕西省西安市灞桥区', '710038', '', 'qq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3463, 3427, 0, 2, 0, '安康市', '陕西省安康市', '725000', '', 'aks', 'A', 0);
INSERT INTO `tp_city` VALUES (3464, 3463, 0, 3, 0, '汉滨区', '陕西省安康市汉滨区', '725000', '', 'hbq', 'H', 0);
INSERT INTO `tp_city` VALUES (3465, 3463, 0, 3, 0, '其它区', '陕西省安康市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3466, 3463, 0, 3, 0, '旬阳县', '陕西省安康市旬阳县', '725700', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (3467, 3463, 0, 3, 0, '白河县', '陕西省安康市白河县', '725800', '', 'bhx', 'B', 0);
INSERT INTO `tp_city` VALUES (3468, 3463, 0, 3, 0, '镇坪县', '陕西省安康市镇坪县', '725600', '', 'zpx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3469, 3463, 0, 3, 0, '平利县', '陕西省安康市平利县', '725500', '', 'plx', 'P', 0);
INSERT INTO `tp_city` VALUES (3470, 3463, 0, 3, 0, '岚皋县', '陕西省安康市岚皋县', '725400', '', 'gx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3471, 3463, 0, 3, 0, '紫阳县', '陕西省安康市紫阳县', '725300', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3472, 3463, 0, 3, 0, '宁陕县', '陕西省安康市宁陕县', '711600', '', 'nsx', 'N', 0);
INSERT INTO `tp_city` VALUES (3473, 3463, 0, 3, 0, '石泉县', '陕西省安康市石泉县', '725200', '', 'sqx', 'S', 0);
INSERT INTO `tp_city` VALUES (3474, 3463, 0, 3, 0, '汉阴县', '陕西省安康市汉阴县', '725100', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (3475, 3427, 0, 2, 0, '商洛市', '陕西省商洛市', '726000', '', 'sls', 'S', 0);
INSERT INTO `tp_city` VALUES (3476, 3475, 0, 3, 0, '商州区', '陕西省商洛市商州区', '726000', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (3477, 3475, 0, 3, 0, '镇安县', '陕西省商洛市镇安县', '711500', '', 'zax', 'Z', 0);
INSERT INTO `tp_city` VALUES (3478, 3475, 0, 3, 0, '山阳县', '陕西省商洛市山阳县', '726400', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (3479, 3475, 0, 3, 0, '其它区', '陕西省商洛市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3480, 3475, 0, 3, 0, '柞水县', '陕西省商洛市柞水县', '711400', '', 'zsx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3481, 3475, 0, 3, 0, '洛南县', '陕西省商洛市洛南县', '726100', '', 'lnx', 'L', 0);
INSERT INTO `tp_city` VALUES (3482, 3475, 0, 3, 0, '丹凤县', '陕西省商洛市丹凤县', '726200', '', 'dfx', 'D', 0);
INSERT INTO `tp_city` VALUES (3483, 3475, 0, 3, 0, '商南县', '陕西省商洛市商南县', '726300', '', 'snx', 'S', 0);
INSERT INTO `tp_city` VALUES (3484, 3427, 0, 2, 0, '延安市', '陕西省延安市', '716000', '', 'yas', 'Y', 0);
INSERT INTO `tp_city` VALUES (3485, 3484, 0, 3, 0, '宝塔区', '陕西省延安市宝塔区', '716000', '', 'btq', 'B', 0);
INSERT INTO `tp_city` VALUES (3486, 3484, 0, 3, 0, '延长县', '陕西省延安市延长县', '717100', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3487, 3484, 0, 3, 0, '延川县', '陕西省延安市延川县', '717200', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3488, 3484, 0, 3, 0, '子长县', '陕西省延安市子长县', '717300', '', 'zcx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3489, 3484, 0, 3, 0, '其它区', '陕西省延安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3490, 3484, 0, 3, 0, '黄陵县', '陕西省延安市黄陵县', '727300', '', 'hlx', 'H', 0);
INSERT INTO `tp_city` VALUES (3491, 3484, 0, 3, 0, '甘泉县', '陕西省延安市甘泉县', '716100', '', 'gqx', 'G', 0);
INSERT INTO `tp_city` VALUES (3492, 3484, 0, 3, 0, '吴起县', '陕西省延安市吴起县', '717600', '', 'wqx', 'W', 0);
INSERT INTO `tp_city` VALUES (3493, 3484, 0, 3, 0, '志丹县', '陕西省延安市志丹县', '717500', '', 'zdx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3494, 3484, 0, 3, 0, '安塞县', '陕西省延安市安塞县', '717400', '', 'asx', 'A', 0);
INSERT INTO `tp_city` VALUES (3495, 3484, 0, 3, 0, '黄龙县', '陕西省延安市黄龙县', '715700', '', 'hlx', 'H', 0);
INSERT INTO `tp_city` VALUES (3496, 3484, 0, 3, 0, '宜川县', '陕西省延安市宜川县', '716200', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3497, 3484, 0, 3, 0, '洛川县', '陕西省延安市洛川县', '727400', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (3498, 3484, 0, 3, 0, '富县', '陕西省延安市富县', '727500', '', 'fx', 'F', 0);
INSERT INTO `tp_city` VALUES (3499, 3427, 0, 2, 0, '汉中市', '陕西省汉中市', '723000', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (3500, 3499, 0, 3, 0, '西乡县', '陕西省汉中市西乡县', '723500', '', 'xxx', 'X', 0);
INSERT INTO `tp_city` VALUES (3501, 3499, 0, 3, 0, '勉县', '陕西省汉中市勉县', '724200', '', 'mx', 'M', 0);
INSERT INTO `tp_city` VALUES (3502, 3499, 0, 3, 0, '宁强县', '陕西省汉中市宁强县', '724400', '', 'nqx', 'N', 0);
INSERT INTO `tp_city` VALUES (3503, 3499, 0, 3, 0, '略阳县', '陕西省汉中市略阳县', '724300', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (3504, 3499, 0, 3, 0, '南郑县', '陕西省汉中市南郑县', '723100', '', 'nzx', 'N', 0);
INSERT INTO `tp_city` VALUES (3505, 3499, 0, 3, 0, '城固县', '陕西省汉中市城固县', '723200', '', 'cgx', 'C', 0);
INSERT INTO `tp_city` VALUES (3506, 3499, 0, 3, 0, '洋县', '陕西省汉中市洋县', '723300', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3507, 3499, 0, 3, 0, '镇巴县', '陕西省汉中市镇巴县', '723600', '', 'zbx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3508, 3499, 0, 3, 0, '留坝县', '陕西省汉中市留坝县', '724100', '', 'lbx', 'L', 0);
INSERT INTO `tp_city` VALUES (3509, 3499, 0, 3, 0, '佛坪县', '陕西省汉中市佛坪县', '723400', '', 'fpx', 'F', 0);
INSERT INTO `tp_city` VALUES (3510, 3499, 0, 3, 0, '其它区', '陕西省汉中市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3511, 3499, 0, 3, 0, '汉台区', '陕西省汉中市汉台区', '723000', '', 'htq', 'H', 0);
INSERT INTO `tp_city` VALUES (3512, 3427, 0, 2, 0, '榆林市', '陕西省榆林市', '719000', '', 'yls', 'Y', 0);
INSERT INTO `tp_city` VALUES (3513, 3512, 0, 3, 0, '其它区', '陕西省榆林市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3514, 3512, 0, 3, 0, '定边县', '陕西省榆林市定边县', '718600', '', 'dbx', 'D', 0);
INSERT INTO `tp_city` VALUES (3515, 3512, 0, 3, 0, '靖边县', '陕西省榆林市靖边县', '718500', '', 'jbx', 'J', 0);
INSERT INTO `tp_city` VALUES (3516, 3512, 0, 3, 0, '米脂县', '陕西省榆林市米脂县', '718100', '', 'mzx', 'M', 0);
INSERT INTO `tp_city` VALUES (3517, 3512, 0, 3, 0, '绥德县', '陕西省榆林市绥德县', '718000', '', 'sdx', 'S', 0);
INSERT INTO `tp_city` VALUES (3518, 3512, 0, 3, 0, '吴堡县', '陕西省榆林市吴堡县', '718200', '', 'wbx', 'W', 0);
INSERT INTO `tp_city` VALUES (3519, 3512, 0, 3, 0, '佳县', '陕西省榆林市佳县', '719200', '', 'jx', 'J', 0);
INSERT INTO `tp_city` VALUES (3520, 3512, 0, 3, 0, '子洲县', '陕西省榆林市子洲县', '718400', '', 'zzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3521, 3512, 0, 3, 0, '清涧县', '陕西省榆林市清涧县', '718300', '', 'qjx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3522, 3512, 0, 3, 0, '神木县', '陕西省榆林市神木县', '719300', '', 'smx', 'S', 0);
INSERT INTO `tp_city` VALUES (3523, 3512, 0, 3, 0, '横山县', '陕西省榆林市横山县', '719100', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (3524, 3512, 0, 3, 0, '府谷县', '陕西省榆林市府谷县', '719400', '', 'fgx', 'F', 0);
INSERT INTO `tp_city` VALUES (3525, 3512, 0, 3, 0, '榆阳区', '陕西省榆林市榆阳区', '719000', '', 'yyq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3526, 3427, 0, 2, 0, '咸阳市', '陕西省咸阳市', '712000', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (3527, 3526, 0, 3, 0, '永寿县', '陕西省咸阳市永寿县', '713400', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3528, 3526, 0, 3, 0, '彬县', '陕西省咸阳市彬县', '713500', '', 'bx', 'B', 0);
INSERT INTO `tp_city` VALUES (3529, 3526, 0, 3, 0, '乾县', '陕西省咸阳市乾县', '713300', '', 'qx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3530, 3526, 0, 3, 0, '礼泉县', '陕西省咸阳市礼泉县', '713200', '', 'lqx', 'L', 0);
INSERT INTO `tp_city` VALUES (3531, 3526, 0, 3, 0, '淳化县', '陕西省咸阳市淳化县', '711200', '', 'chx', 'C', 0);
INSERT INTO `tp_city` VALUES (3532, 3526, 0, 3, 0, '武功县', '陕西省咸阳市武功县', '712200', '', 'wgx', 'W', 0);
INSERT INTO `tp_city` VALUES (3533, 3526, 0, 3, 0, '长武县', '陕西省咸阳市长武县', '713600', '', 'cwx', 'C', 0);
INSERT INTO `tp_city` VALUES (3534, 3526, 0, 3, 0, '旬邑县', '陕西省咸阳市旬邑县', '711300', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (3535, 3526, 0, 3, 0, '三原县', '陕西省咸阳市三原县', '713800', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (3536, 3526, 0, 3, 0, '泾阳县', '陕西省咸阳市泾阳县', '713700', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3537, 3526, 0, 3, 0, '杨陵区', '陕西省咸阳市杨陵区', '712100', '', 'ylq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3538, 3526, 0, 3, 0, '秦都区', '陕西省咸阳市秦都区', '712000', '', 'qdq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3539, 3526, 0, 3, 0, '渭城区', '陕西省咸阳市渭城区', '712000', '', 'wcq', 'W', 0);
INSERT INTO `tp_city` VALUES (3540, 3526, 0, 3, 0, '其它区', '陕西省咸阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3541, 3526, 0, 3, 0, '兴平市', '陕西省咸阳市兴平市', '713100', '', 'xps', 'X', 0);
INSERT INTO `tp_city` VALUES (3542, 3427, 0, 2, 0, '渭南市', '陕西省渭南市', '714000', '', 'wns', 'W', 0);
INSERT INTO `tp_city` VALUES (3543, 3542, 0, 3, 0, '华阴市', '陕西省渭南市华阴市', '714200', '', 'hys', 'H', 0);
INSERT INTO `tp_city` VALUES (3544, 3542, 0, 3, 0, '其它区', '陕西省渭南市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3545, 3542, 0, 3, 0, '韩城市', '陕西省渭南市韩城市', '715400', '', 'hcs', 'H', 0);
INSERT INTO `tp_city` VALUES (3546, 3542, 0, 3, 0, '富平县', '陕西省渭南市富平县', '711700', '', 'fpx', 'F', 0);
INSERT INTO `tp_city` VALUES (3547, 3542, 0, 3, 0, '华县', '陕西省渭南市华县', '714100', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (3548, 3542, 0, 3, 0, '大荔县', '陕西省渭南市大荔县', '715100', '', 'dlx', 'D', 0);
INSERT INTO `tp_city` VALUES (3549, 3542, 0, 3, 0, '潼关县', '陕西省渭南市潼关县', '714300', '', 'gx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3550, 3542, 0, 3, 0, '澄城县', '陕西省渭南市澄城县', '715200', '', 'ccx', 'C', 0);
INSERT INTO `tp_city` VALUES (3551, 3542, 0, 3, 0, '合阳县', '陕西省渭南市合阳县', '715300', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (3552, 3542, 0, 3, 0, '白水县', '陕西省渭南市白水县', '715600', '', 'bsx', 'B', 0);
INSERT INTO `tp_city` VALUES (3553, 3542, 0, 3, 0, '蒲城县', '陕西省渭南市蒲城县', '715500', '', 'pcx', 'P', 0);
INSERT INTO `tp_city` VALUES (3554, 3542, 0, 3, 0, '临渭区', '陕西省渭南市临渭区', '714000', '', 'lwq', 'L', 0);
INSERT INTO `tp_city` VALUES (3555, 0, 0, 1, 0, '天津', '天津', '', '', 'tj', 'T', 0);
INSERT INTO `tp_city` VALUES (3556, 3555, 0, 2, 0, '天津市', '天津天津市', '300000', '', 'tjs', 'T', 0);
INSERT INTO `tp_city` VALUES (3557, 3556, 0, 3, 0, '蓟县', '天津天津市蓟县', '301900', '', 'jx', 'J', 0);
INSERT INTO `tp_city` VALUES (3558, 3556, 0, 3, 0, '其它区', '天津天津市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3559, 3556, 0, 3, 0, '静海县', '天津天津市静海县', '301600', '', 'jhx', 'J', 0);
INSERT INTO `tp_city` VALUES (3560, 3556, 0, 3, 0, '宁河县', '天津天津市宁河县', '301500', '', 'nhx', 'N', 0);
INSERT INTO `tp_city` VALUES (3561, 3556, 0, 3, 0, '和平区', '天津天津市和平区', '300041', '', 'hpq', 'H', 0);
INSERT INTO `tp_city` VALUES (3562, 3556, 0, 3, 0, '河东区', '天津天津市河东区', '300171', '', 'hdq', 'H', 0);
INSERT INTO `tp_city` VALUES (3563, 3556, 0, 3, 0, '河西区', '天津天津市河西区', '300202', '', 'hxq', 'H', 0);
INSERT INTO `tp_city` VALUES (3564, 3556, 0, 3, 0, '汉沽区', '天津天津市汉沽区', '300480', '', 'hgq', 'H', 0);
INSERT INTO `tp_city` VALUES (3565, 3556, 0, 3, 0, '大港区', '天津天津市大港区', '300270', '', 'dgq', 'D', 0);
INSERT INTO `tp_city` VALUES (3566, 3556, 0, 3, 0, '东丽区', '天津天津市东丽区', '300300', '', 'dlq', 'D', 0);
INSERT INTO `tp_city` VALUES (3567, 3556, 0, 3, 0, '西青区', '天津天津市西青区', '300380', '', 'xqq', 'X', 0);
INSERT INTO `tp_city` VALUES (3568, 3556, 0, 3, 0, '南开区', '天津天津市南开区', '300100', '', 'nkq', 'N', 0);
INSERT INTO `tp_city` VALUES (3569, 3556, 0, 3, 0, '河北区', '天津天津市河北区', '300143', '', 'hbq', 'H', 0);
INSERT INTO `tp_city` VALUES (3570, 3556, 0, 3, 0, '红桥区', '天津天津市红桥区', '300131', '', 'hqq', 'H', 0);
INSERT INTO `tp_city` VALUES (3571, 3556, 0, 3, 0, '塘沽区', '天津天津市塘沽区', '300450', '', 'tgq', 'T', 0);
INSERT INTO `tp_city` VALUES (3572, 3556, 0, 3, 0, '滨海新区', '天津天津市滨海新区', '300457', '', 'bhxq', 'B', 0);
INSERT INTO `tp_city` VALUES (3573, 3556, 0, 3, 0, '北辰区', '天津天津市北辰区', '300400', '', 'bcq', 'B', 0);
INSERT INTO `tp_city` VALUES (3574, 3556, 0, 3, 0, '津南区', '天津天津市津南区', '300350', '', 'jnq', 'J', 0);
INSERT INTO `tp_city` VALUES (3575, 3556, 0, 3, 0, '宝坻区', '天津天津市宝坻区', '301800', '', 'bq', 'B', 0);
INSERT INTO `tp_city` VALUES (3576, 3556, 0, 3, 0, '武清区', '天津天津市武清区', '301700', '', 'wqq', 'W', 0);
INSERT INTO `tp_city` VALUES (3577, 0, 0, 1, 0, '广东省', '广东省', '', '', 'gds', 'G', 0);
INSERT INTO `tp_city` VALUES (3578, 3577, 0, 2, 0, '云浮市', '广东省云浮市', '527300', '', 'yfs', 'Y', 0);
INSERT INTO `tp_city` VALUES (3579, 3578, 0, 3, 0, '云城区', '广东省云浮市云城区', '527300', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3580, 3578, 0, 3, 0, '罗定市', '广东省云浮市罗定市', '527200', '', 'lds', 'L', 0);
INSERT INTO `tp_city` VALUES (3581, 3578, 0, 3, 0, '其它区', '广东省云浮市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3582, 3578, 0, 3, 0, '新兴县', '广东省云浮市新兴县', '527400', '', 'xxx', 'X', 0);
INSERT INTO `tp_city` VALUES (3583, 3578, 0, 3, 0, '云安县', '广东省云浮市云安县', '527500', '', 'yax', 'Y', 0);
INSERT INTO `tp_city` VALUES (3584, 3578, 0, 3, 0, '郁南县', '广东省云浮市郁南县', '527100', '', 'ynx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3585, 3577, 0, 2, 0, '揭阳市', '广东省揭阳市', '522000', '', 'jys', 'J', 0);
INSERT INTO `tp_city` VALUES (3586, 3585, 0, 3, 0, '普宁市', '广东省揭阳市普宁市', '515300', '', 'pns', 'P', 0);
INSERT INTO `tp_city` VALUES (3587, 3585, 0, 3, 0, '东山区', '广东省揭阳市东山区', '', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (3588, 3585, 0, 3, 0, '其它区', '广东省揭阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3589, 3585, 0, 3, 0, '榕城区', '广东省揭阳市榕城区', '522095', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3590, 3585, 0, 3, 0, '惠来县', '广东省揭阳市惠来县', '515200', '', 'hlx', 'H', 0);
INSERT INTO `tp_city` VALUES (3591, 3585, 0, 3, 0, '揭西县', '广东省揭阳市揭西县', '515400', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (3592, 3585, 0, 3, 0, '揭东区', '广东省揭阳市揭东区', '515500', '', 'jdq', 'J', 0);
INSERT INTO `tp_city` VALUES (3593, 3577, 0, 2, 0, '潮州市', '广东省潮州市', '521000', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (3594, 3593, 0, 3, 0, '枫溪区', '广东省潮州市枫溪区', '', '', 'fxq', 'F', 0);
INSERT INTO `tp_city` VALUES (3595, 3593, 0, 3, 0, '其它区', '广东省潮州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3596, 3593, 0, 3, 0, '饶平县', '广东省潮州市饶平县', '515700', '', 'rpx', 'R', 0);
INSERT INTO `tp_city` VALUES (3597, 3593, 0, 3, 0, '潮安区', '广东省潮州市潮安区', '515600', '', 'caq', 'C', 0);
INSERT INTO `tp_city` VALUES (3598, 3593, 0, 3, 0, '湘桥区', '广东省潮州市湘桥区', '521000', '', 'xqq', 'X', 0);
INSERT INTO `tp_city` VALUES (3599, 3577, 0, 2, 0, '广州市', '广东省广州市', '510000', '', 'gzs', 'G', 0);
INSERT INTO `tp_city` VALUES (3600, 3599, 0, 3, 0, '增城市', '广东省广州市增城市', '511300', '', 'zcs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3601, 3599, 0, 3, 0, '东山区', '广东省广州市东山区', '', '', 'dsq', 'D', 0);
INSERT INTO `tp_city` VALUES (3602, 3599, 0, 3, 0, '其它区', '广东省广州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3603, 3599, 0, 3, 0, '从化市', '广东省广州市从化市', '510900', '', 'chs', 'C', 0);
INSERT INTO `tp_city` VALUES (3604, 3599, 0, 3, 0, '黄埔区', '广东省广州市黄埔区', '510700', '', 'hpq', 'H', 0);
INSERT INTO `tp_city` VALUES (3605, 3599, 0, 3, 0, '番禺区', '广东省广州市番禺区', '511400', '', 'fq', 'F', 0);
INSERT INTO `tp_city` VALUES (3606, 3599, 0, 3, 0, '花都区', '广东省广州市花都区', '510800', '', 'hdq', 'H', 0);
INSERT INTO `tp_city` VALUES (3607, 3599, 0, 3, 0, '南沙区', '广东省广州市南沙区', '', '', 'nsq', 'N', 0);
INSERT INTO `tp_city` VALUES (3608, 3599, 0, 3, 0, '萝岗区', '广东省广州市萝岗区', '', '', 'lgq', 'L', 0);
INSERT INTO `tp_city` VALUES (3609, 3599, 0, 3, 0, '荔湾区', '广东省广州市荔湾区', '510145', '', 'lwq', 'L', 0);
INSERT INTO `tp_city` VALUES (3610, 3599, 0, 3, 0, '海珠区', '广东省广州市海珠区', '510220', '', 'hzq', 'H', 0);
INSERT INTO `tp_city` VALUES (3611, 3599, 0, 3, 0, '越秀区', '广东省广州市越秀区', '510180', '', 'yxq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3612, 3599, 0, 3, 0, '天河区', '广东省广州市天河区', '510510', '', 'thq', 'T', 0);
INSERT INTO `tp_city` VALUES (3613, 3599, 0, 3, 0, '白云区', '广东省广州市白云区', '510440', '', 'byq', 'B', 0);
INSERT INTO `tp_city` VALUES (3614, 3577, 0, 2, 0, '深圳市', '广东省深圳市', '518000', '', 'ss', 'S', 0);
INSERT INTO `tp_city` VALUES (3615, 3614, 0, 3, 0, '其它区', '广东省深圳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3616, 3614, 0, 3, 0, '盐田区', '广东省深圳市盐田区', '518083', '', 'ytq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3617, 3614, 0, 3, 0, '南山区', '广东省深圳市南山区', '518052', '', 'nsq', 'N', 0);
INSERT INTO `tp_city` VALUES (3618, 3614, 0, 3, 0, '福田区', '广东省深圳市福田区', '518031', '', 'ftq', 'F', 0);
INSERT INTO `tp_city` VALUES (3619, 3614, 0, 3, 0, '龙岗区', '广东省深圳市龙岗区', '518116', '', 'lgq', 'L', 0);
INSERT INTO `tp_city` VALUES (3620, 3614, 0, 3, 0, '宝安区', '广东省深圳市宝安区', '518101', '', 'baq', 'B', 0);
INSERT INTO `tp_city` VALUES (3621, 3614, 0, 3, 0, '罗湖区', '广东省深圳市罗湖区', '518002', '', 'lhq', 'L', 0);
INSERT INTO `tp_city` VALUES (3622, 3614, 0, 3, 0, '坪山新区', '广东省深圳市坪山新区', '518118', '', 'psxq', 'P', 0);
INSERT INTO `tp_city` VALUES (3623, 3614, 0, 3, 0, '光明新区', '广东省深圳市光明新区', '518107', '', 'gmxq', 'G', 0);
INSERT INTO `tp_city` VALUES (3624, 3614, 0, 3, 0, '龙华新区', '广东省深圳市龙华新区', '518131', '', 'lhxq', 'L', 0);
INSERT INTO `tp_city` VALUES (3625, 3614, 0, 3, 0, '大鹏新区', '广东省深圳市大鹏新区', '518108', '', 'dpxq', 'D', 0);
INSERT INTO `tp_city` VALUES (3626, 3577, 0, 2, 0, '韶关市', '广东省韶关市', '512000', '', 'sgs', 'S', 0);
INSERT INTO `tp_city` VALUES (3627, 3626, 0, 3, 0, '其它区', '广东省韶关市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3628, 3626, 0, 3, 0, '南雄市', '广东省韶关市南雄市', '512400', '', 'nxs', 'N', 0);
INSERT INTO `tp_city` VALUES (3629, 3626, 0, 3, 0, '乐昌市', '广东省韶关市乐昌市', '512200', '', 'lcs', 'L', 0);
INSERT INTO `tp_city` VALUES (3630, 3626, 0, 3, 0, '乳源县', '广东省韶关市乳源县', '512700', '', 'ryx', 'R', 0);
INSERT INTO `tp_city` VALUES (3631, 3626, 0, 3, 0, '新丰县', '广东省韶关市新丰县', '511100', '', 'xfx', 'X', 0);
INSERT INTO `tp_city` VALUES (3632, 3626, 0, 3, 0, '仁化县', '广东省韶关市仁化县', '512300', '', 'rhx', 'R', 0);
INSERT INTO `tp_city` VALUES (3633, 3626, 0, 3, 0, '翁源县', '广东省韶关市翁源县', '512600', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (3634, 3626, 0, 3, 0, '始兴县', '广东省韶关市始兴县', '512500', '', 'sxx', 'S', 0);
INSERT INTO `tp_city` VALUES (3635, 3626, 0, 3, 0, '武江区', '广东省韶关市武江区', '512026', '', 'wjq', 'W', 0);
INSERT INTO `tp_city` VALUES (3636, 3626, 0, 3, 0, '浈江区', '广东省韶关市浈江区', '512023', '', 'jq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3637, 3626, 0, 3, 0, '曲江区', '广东省韶关市曲江区', '512100', '', 'qjq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3638, 3577, 0, 2, 0, '中山市', '广东省中山市', '528400', '', 'zss', 'Z', 0);
INSERT INTO `tp_city` VALUES (3639, 3638, 0, 3, 0, '石岐区街道', '广东省中山市石岐区街道', '', '', 'sqjd', 'S', 0);
INSERT INTO `tp_city` VALUES (3640, 3638, 0, 3, 0, '东区街道', '广东省中山市东区街道', '', '', 'dqjd', 'D', 0);
INSERT INTO `tp_city` VALUES (3641, 3638, 0, 3, 0, '火炬开发区街道', '广东省中山市火炬开发区街道', '', '', 'hjkfqjd', 'H', 0);
INSERT INTO `tp_city` VALUES (3642, 3638, 0, 3, 0, '西区街道', '广东省中山市西区街道', '', '', 'xqjd', 'X', 0);
INSERT INTO `tp_city` VALUES (3643, 3638, 0, 3, 0, '南区街道', '广东省中山市南区街道', '', '', 'nqjd', 'N', 0);
INSERT INTO `tp_city` VALUES (3644, 3638, 0, 3, 0, '五桂山街道', '广东省中山市五桂山街道', '', '', 'wgsjd', 'W', 0);
INSERT INTO `tp_city` VALUES (3645, 3638, 0, 3, 0, '小榄镇', '广东省中山市小榄镇', '', '', 'xz', 'X', 0);
INSERT INTO `tp_city` VALUES (3646, 3638, 0, 3, 0, '黄圃镇', '广东省中山市黄圃镇', '', '', 'hpz', 'H', 0);
INSERT INTO `tp_city` VALUES (3647, 3638, 0, 3, 0, '民众镇', '广东省中山市民众镇', '', '', 'mzz', 'M', 0);
INSERT INTO `tp_city` VALUES (3648, 3638, 0, 3, 0, '东凤镇', '广东省中山市东凤镇', '', '', 'dfz', 'D', 0);
INSERT INTO `tp_city` VALUES (3649, 3638, 0, 3, 0, '东升镇', '广东省中山市东升镇', '', '', 'dsz', 'D', 0);
INSERT INTO `tp_city` VALUES (3650, 3638, 0, 3, 0, '古镇镇', '广东省中山市古镇镇', '', '', 'gzz', 'G', 0);
INSERT INTO `tp_city` VALUES (3651, 3638, 0, 3, 0, '沙溪镇', '广东省中山市沙溪镇', '', '', 'sxz', 'S', 0);
INSERT INTO `tp_city` VALUES (3652, 3638, 0, 3, 0, '坦洲镇', '广东省中山市坦洲镇', '', '', 'tzz', 'T', 0);
INSERT INTO `tp_city` VALUES (3653, 3638, 0, 3, 0, '港口镇', '广东省中山市港口镇', '', '', 'gkz', 'G', 0);
INSERT INTO `tp_city` VALUES (3654, 3638, 0, 3, 0, '三角镇', '广东省中山市三角镇', '', '', 'sjz', 'S', 0);
INSERT INTO `tp_city` VALUES (3655, 3638, 0, 3, 0, '横栏镇', '广东省中山市横栏镇', '', '', 'hlz', 'H', 0);
INSERT INTO `tp_city` VALUES (3656, 3638, 0, 3, 0, '南头镇', '广东省中山市南头镇', '', '', 'ntz', 'N', 0);
INSERT INTO `tp_city` VALUES (3657, 3638, 0, 3, 0, '阜沙镇', '广东省中山市阜沙镇', '', '', 'fsz', 'F', 0);
INSERT INTO `tp_city` VALUES (3658, 3638, 0, 3, 0, '南朗镇', '广东省中山市南朗镇', '', '', 'nlz', 'N', 0);
INSERT INTO `tp_city` VALUES (3659, 3638, 0, 3, 0, '三乡镇', '广东省中山市三乡镇', '', '', 'sxz', 'S', 0);
INSERT INTO `tp_city` VALUES (3660, 3638, 0, 3, 0, '板芙镇', '广东省中山市板芙镇', '', '', 'bz', 'B', 0);
INSERT INTO `tp_city` VALUES (3661, 3638, 0, 3, 0, '大涌镇', '广东省中山市大涌镇', '', '', 'dyz', 'D', 0);
INSERT INTO `tp_city` VALUES (3662, 3638, 0, 3, 0, '神湾镇', '广东省中山市神湾镇', '', '', 'swz', 'S', 0);
INSERT INTO `tp_city` VALUES (3663, 3577, 0, 2, 0, '东莞市', '广东省东莞市', '523000', '', 'ds', 'D', 0);
INSERT INTO `tp_city` VALUES (3664, 3663, 0, 3, 0, '东城街道', '广东省东莞市东城街道', '', '', 'dcjd', 'D', 0);
INSERT INTO `tp_city` VALUES (3665, 3663, 0, 3, 0, '南城街道', '广东省东莞市南城街道', '', '', 'ncjd', 'N', 0);
INSERT INTO `tp_city` VALUES (3666, 3663, 0, 3, 0, '万江街道', '广东省东莞市万江街道', '', '', 'wjjd', 'W', 0);
INSERT INTO `tp_city` VALUES (3667, 3663, 0, 3, 0, '莞城街道', '广东省东莞市莞城街道', '', '', 'cjd', 'Z', 0);
INSERT INTO `tp_city` VALUES (3668, 3663, 0, 3, 0, '石碣镇', '广东省东莞市石碣镇', '', '', 'sz', 'S', 0);
INSERT INTO `tp_city` VALUES (3669, 3663, 0, 3, 0, '石龙镇', '广东省东莞市石龙镇', '', '', 'slz', 'S', 0);
INSERT INTO `tp_city` VALUES (3670, 3663, 0, 3, 0, '茶山镇', '广东省东莞市茶山镇', '', '', 'csz', 'C', 0);
INSERT INTO `tp_city` VALUES (3671, 3663, 0, 3, 0, '石排镇', '广东省东莞市石排镇', '', '', 'spz', 'S', 0);
INSERT INTO `tp_city` VALUES (3672, 3663, 0, 3, 0, '企石镇', '广东省东莞市企石镇', '', '', 'qsz', 'Q', 0);
INSERT INTO `tp_city` VALUES (3673, 3663, 0, 3, 0, '横沥镇', '广东省东莞市横沥镇', '', '', 'hlz', 'H', 0);
INSERT INTO `tp_city` VALUES (3674, 3663, 0, 3, 0, '桥头镇', '广东省东莞市桥头镇', '', '', 'qtz', 'Q', 0);
INSERT INTO `tp_city` VALUES (3675, 3663, 0, 3, 0, '谢岗镇', '广东省东莞市谢岗镇', '', '', 'xgz', 'X', 0);
INSERT INTO `tp_city` VALUES (3676, 3663, 0, 3, 0, '东坑镇', '广东省东莞市东坑镇', '', '', 'dkz', 'D', 0);
INSERT INTO `tp_city` VALUES (3677, 3663, 0, 3, 0, '常平镇', '广东省东莞市常平镇', '', '', 'cpz', 'C', 0);
INSERT INTO `tp_city` VALUES (3678, 3663, 0, 3, 0, '寮步镇', '广东省东莞市寮步镇', '', '', 'bz', 'Z', 0);
INSERT INTO `tp_city` VALUES (3679, 3663, 0, 3, 0, '樟木头镇', '广东省东莞市樟木头镇', '', '', 'zmtz', 'Z', 0);
INSERT INTO `tp_city` VALUES (3680, 3663, 0, 3, 0, '大朗镇', '广东省东莞市大朗镇', '', '', 'dlz', 'D', 0);
INSERT INTO `tp_city` VALUES (3681, 3663, 0, 3, 0, '黄江镇', '广东省东莞市黄江镇', '', '', 'hjz', 'H', 0);
INSERT INTO `tp_city` VALUES (3682, 3663, 0, 3, 0, '清溪镇', '广东省东莞市清溪镇', '', '', 'qxz', 'Q', 0);
INSERT INTO `tp_city` VALUES (3683, 3663, 0, 3, 0, '塘厦镇', '广东省东莞市塘厦镇', '', '', 'txz', 'T', 0);
INSERT INTO `tp_city` VALUES (3684, 3663, 0, 3, 0, '凤岗镇', '广东省东莞市凤岗镇', '', '', 'fgz', 'F', 0);
INSERT INTO `tp_city` VALUES (3685, 3663, 0, 3, 0, '大岭山镇', '广东省东莞市大岭山镇', '', '', 'dlsz', 'D', 0);
INSERT INTO `tp_city` VALUES (3686, 3663, 0, 3, 0, '长安镇', '广东省东莞市长安镇', '', '', 'caz', 'C', 0);
INSERT INTO `tp_city` VALUES (3687, 3663, 0, 3, 0, '虎门镇', '广东省东莞市虎门镇', '', '', 'hmz', 'H', 0);
INSERT INTO `tp_city` VALUES (3688, 3663, 0, 3, 0, '厚街镇', '广东省东莞市厚街镇', '', '', 'hjz', 'H', 0);
INSERT INTO `tp_city` VALUES (3689, 3663, 0, 3, 0, '沙田镇', '广东省东莞市沙田镇', '', '', 'stz', 'S', 0);
INSERT INTO `tp_city` VALUES (3690, 3663, 0, 3, 0, '道滘镇', '广东省东莞市道滘镇', '', '', 'dz', 'D', 0);
INSERT INTO `tp_city` VALUES (3691, 3663, 0, 3, 0, '洪梅镇', '广东省东莞市洪梅镇', '', '', 'hmz', 'H', 0);
INSERT INTO `tp_city` VALUES (3692, 3663, 0, 3, 0, '麻涌镇', '广东省东莞市麻涌镇', '', '', 'myz', 'M', 0);
INSERT INTO `tp_city` VALUES (3693, 3663, 0, 3, 0, '望牛墩镇', '广东省东莞市望牛墩镇', '', '', 'wndz', 'W', 0);
INSERT INTO `tp_city` VALUES (3694, 3663, 0, 3, 0, '中堂镇', '广东省东莞市中堂镇', '', '', 'ztz', 'Z', 0);
INSERT INTO `tp_city` VALUES (3695, 3663, 0, 3, 0, '高埗镇', '广东省东莞市高埗镇', '', '', 'gz', 'G', 0);
INSERT INTO `tp_city` VALUES (3696, 3663, 0, 3, 0, '松山湖管委会', '广东省东莞市松山湖管委会', '', '', 'sshgwh', 'S', 0);
INSERT INTO `tp_city` VALUES (3697, 3663, 0, 3, 0, '虎门港管委会', '广东省东莞市虎门港管委会', '', '', 'hmggwh', 'H', 0);
INSERT INTO `tp_city` VALUES (3698, 3663, 0, 3, 0, '东莞生态园', '广东省东莞市东莞生态园', '', '', 'dsty', 'D', 0);
INSERT INTO `tp_city` VALUES (3699, 3577, 0, 2, 0, '汕尾市', '广东省汕尾市', '516600', '', 'sws', 'S', 0);
INSERT INTO `tp_city` VALUES (3700, 3699, 0, 3, 0, '其它区', '广东省汕尾市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3701, 3699, 0, 3, 0, '陆丰市', '广东省汕尾市陆丰市', '516500', '', 'lfs', 'L', 0);
INSERT INTO `tp_city` VALUES (3702, 3699, 0, 3, 0, '城区', '广东省汕尾市城区', '516601', '', 'cq', 'C', 0);
INSERT INTO `tp_city` VALUES (3703, 3699, 0, 3, 0, '陆河县', '广东省汕尾市陆河县', '516700', '', 'lhx', 'L', 0);
INSERT INTO `tp_city` VALUES (3704, 3699, 0, 3, 0, '海丰县', '广东省汕尾市海丰县', '516400', '', 'hfx', 'H', 0);
INSERT INTO `tp_city` VALUES (3705, 3577, 0, 2, 0, '梅州市', '广东省梅州市', '514000', '', 'mzs', 'M', 0);
INSERT INTO `tp_city` VALUES (3706, 3705, 0, 3, 0, '兴宁市', '广东省梅州市兴宁市', '514500', '', 'xns', 'X', 0);
INSERT INTO `tp_city` VALUES (3707, 3705, 0, 3, 0, '其它区', '广东省梅州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3708, 3705, 0, 3, 0, '五华县', '广东省梅州市五华县', '514400', '', 'whx', 'W', 0);
INSERT INTO `tp_city` VALUES (3709, 3705, 0, 3, 0, '平远县', '广东省梅州市平远县', '514600', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (3710, 3705, 0, 3, 0, '蕉岭县', '广东省梅州市蕉岭县', '514100', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (3711, 3705, 0, 3, 0, '梅县', '广东省梅州市梅县', '514700', '', 'mx', 'M', 0);
INSERT INTO `tp_city` VALUES (3712, 3705, 0, 3, 0, '丰顺县', '广东省梅州市丰顺县', '514300', '', 'fsx', 'F', 0);
INSERT INTO `tp_city` VALUES (3713, 3705, 0, 3, 0, '大埔县', '广东省梅州市大埔县', '514200', '', 'dpx', 'D', 0);
INSERT INTO `tp_city` VALUES (3714, 3705, 0, 3, 0, '梅江区', '广东省梅州市梅江区', '514000', '', 'mjq', 'M', 0);
INSERT INTO `tp_city` VALUES (3715, 3577, 0, 2, 0, '清远市', '广东省清远市', '511500', '', 'qys', 'Q', 0);
INSERT INTO `tp_city` VALUES (3716, 3715, 0, 3, 0, '英德市', '广东省清远市英德市', '513000', '', 'yds', 'Y', 0);
INSERT INTO `tp_city` VALUES (3717, 3715, 0, 3, 0, '连州市', '广东省清远市连州市', '513400', '', 'lzs', 'L', 0);
INSERT INTO `tp_city` VALUES (3718, 3715, 0, 3, 0, '其它区', '广东省清远市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3719, 3715, 0, 3, 0, '清城区', '广东省清远市清城区', '511500', '', 'qcq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3720, 3715, 0, 3, 0, '阳山县', '广东省清远市阳山县', '513100', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3721, 3715, 0, 3, 0, '佛冈县', '广东省清远市佛冈县', '511600', '', 'fgx', 'F', 0);
INSERT INTO `tp_city` VALUES (3722, 3715, 0, 3, 0, '连山县', '广东省清远市连山县', '513200', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (3723, 3715, 0, 3, 0, '连南县', '广东省清远市连南县', '513300', '', 'lnx', 'L', 0);
INSERT INTO `tp_city` VALUES (3724, 3715, 0, 3, 0, '清新区', '广东省清远市清新区', '511800', '', 'qxq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3725, 3577, 0, 2, 0, '阳江市', '广东省阳江市', '529500', '', 'yjs', 'Y', 0);
INSERT INTO `tp_city` VALUES (3726, 3725, 0, 3, 0, '阳春市', '广东省阳江市阳春市', '529600', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (3727, 3725, 0, 3, 0, '其它区', '广东省阳江市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3728, 3725, 0, 3, 0, '江城区', '广东省阳江市江城区', '529525', '', 'jcq', 'J', 0);
INSERT INTO `tp_city` VALUES (3729, 3725, 0, 3, 0, '阳西县', '广东省阳江市阳西县', '529800', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3730, 3725, 0, 3, 0, '阳东县', '广东省阳江市阳东县', '529931', '', 'ydx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3731, 3577, 0, 2, 0, '河源市', '广东省河源市', '517000', '', 'hys', 'H', 0);
INSERT INTO `tp_city` VALUES (3732, 3731, 0, 3, 0, '源城区', '广东省河源市源城区', '517000', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3733, 3731, 0, 3, 0, '龙川县', '广东省河源市龙川县', '517300', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (3734, 3731, 0, 3, 0, '连平县', '广东省河源市连平县', '517100', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (3735, 3731, 0, 3, 0, '紫金县', '广东省河源市紫金县', '517400', '', 'zjx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3736, 3731, 0, 3, 0, '其它区', '广东省河源市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3737, 3731, 0, 3, 0, '和平县', '广东省河源市和平县', '517200', '', 'hpx', 'H', 0);
INSERT INTO `tp_city` VALUES (3738, 3731, 0, 3, 0, '东源县', '广东省河源市东源县', '517500', '', 'dyx', 'D', 0);
INSERT INTO `tp_city` VALUES (3739, 3577, 0, 2, 0, '茂名市', '广东省茂名市', '525000', '', 'mms', 'M', 0);
INSERT INTO `tp_city` VALUES (3740, 3739, 0, 3, 0, '高州市', '广东省茂名市高州市', '525200', '', 'gzs', 'G', 0);
INSERT INTO `tp_city` VALUES (3741, 3739, 0, 3, 0, '信宜市', '广东省茂名市信宜市', '525300', '', 'xys', 'X', 0);
INSERT INTO `tp_city` VALUES (3742, 3739, 0, 3, 0, '化州市', '广东省茂名市化州市', '525100', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (3743, 3739, 0, 3, 0, '其它区', '广东省茂名市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3744, 3739, 0, 3, 0, '电白县', '广东省茂名市电白县', '525400', '', 'dbx', 'D', 0);
INSERT INTO `tp_city` VALUES (3745, 3739, 0, 3, 0, '茂港区', '广东省茂名市茂港区', '525027', '', 'mgq', 'M', 0);
INSERT INTO `tp_city` VALUES (3746, 3739, 0, 3, 0, '茂南区', '广东省茂名市茂南区', '525011', '', 'mnq', 'M', 0);
INSERT INTO `tp_city` VALUES (3747, 3577, 0, 2, 0, '惠州市', '广东省惠州市', '516000', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (3748, 3747, 0, 3, 0, '龙门县', '广东省惠州市龙门县', '516800', '', 'lmx', 'L', 0);
INSERT INTO `tp_city` VALUES (3749, 3747, 0, 3, 0, '其它区', '广东省惠州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3750, 3747, 0, 3, 0, '博罗县', '广东省惠州市博罗县', '516100', '', 'blx', 'B', 0);
INSERT INTO `tp_city` VALUES (3751, 3747, 0, 3, 0, '惠东县', '广东省惠州市惠东县', '516300', '', 'hdx', 'H', 0);
INSERT INTO `tp_city` VALUES (3752, 3747, 0, 3, 0, '惠阳区', '广东省惠州市惠阳区', '516200', '', 'hyq', 'H', 0);
INSERT INTO `tp_city` VALUES (3753, 3747, 0, 3, 0, '惠城区', '广东省惠州市惠城区', '516001', '', 'hcq', 'H', 0);
INSERT INTO `tp_city` VALUES (3754, 3577, 0, 2, 0, '肇庆市', '广东省肇庆市', '526000', '', 'zqs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3755, 3754, 0, 3, 0, '广宁县', '广东省肇庆市广宁县', '526300', '', 'gnx', 'G', 0);
INSERT INTO `tp_city` VALUES (3756, 3754, 0, 3, 0, '德庆县', '广东省肇庆市德庆县', '526600', '', 'dqx', 'D', 0);
INSERT INTO `tp_city` VALUES (3757, 3754, 0, 3, 0, '怀集县', '广东省肇庆市怀集县', '526400', '', 'hjx', 'H', 0);
INSERT INTO `tp_city` VALUES (3758, 3754, 0, 3, 0, '封开县', '广东省肇庆市封开县', '526500', '', 'fkx', 'F', 0);
INSERT INTO `tp_city` VALUES (3759, 3754, 0, 3, 0, '四会市', '广东省肇庆市四会市', '526200', '', 'shs', 'S', 0);
INSERT INTO `tp_city` VALUES (3760, 3754, 0, 3, 0, '其它区', '广东省肇庆市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3761, 3754, 0, 3, 0, '高要市', '广东省肇庆市高要市', '526100', '', 'gys', 'G', 0);
INSERT INTO `tp_city` VALUES (3762, 3754, 0, 3, 0, '端州区', '广东省肇庆市端州区', '526040', '', 'dzq', 'D', 0);
INSERT INTO `tp_city` VALUES (3763, 3754, 0, 3, 0, '鼎湖区', '广东省肇庆市鼎湖区', '526070', '', 'dhq', 'D', 0);
INSERT INTO `tp_city` VALUES (3764, 3577, 0, 2, 0, '汕头市', '广东省汕头市', '515000', '', 'sts', 'S', 0);
INSERT INTO `tp_city` VALUES (3765, 3764, 0, 3, 0, '金平区', '广东省汕头市金平区', '515041', '', 'jpq', 'J', 0);
INSERT INTO `tp_city` VALUES (3766, 3764, 0, 3, 0, '龙湖区', '广东省汕头市龙湖区', '515041', '', 'lhq', 'L', 0);
INSERT INTO `tp_city` VALUES (3767, 3764, 0, 3, 0, '濠江区', '广东省汕头市濠江区', '515071', '', 'jq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3768, 3764, 0, 3, 0, '潮阳区', '广东省汕头市潮阳区', '515100', '', 'cyq', 'C', 0);
INSERT INTO `tp_city` VALUES (3769, 3764, 0, 3, 0, '潮南区', '广东省汕头市潮南区', '515144', '', 'cnq', 'C', 0);
INSERT INTO `tp_city` VALUES (3770, 3764, 0, 3, 0, '澄海区', '广东省汕头市澄海区', '515800', '', 'chq', 'C', 0);
INSERT INTO `tp_city` VALUES (3771, 3764, 0, 3, 0, '南澳县', '广东省汕头市南澳县', '515900', '', 'nax', 'N', 0);
INSERT INTO `tp_city` VALUES (3772, 3764, 0, 3, 0, '其它区', '广东省汕头市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3773, 3577, 0, 2, 0, '珠海市', '广东省珠海市', '519000', '', 'zhs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3774, 3773, 0, 3, 0, '金唐区', '广东省珠海市金唐区', '', '', 'jtq', 'J', 0);
INSERT INTO `tp_city` VALUES (3775, 3773, 0, 3, 0, '南湾区', '广东省珠海市南湾区', '', '', 'nwq', 'N', 0);
INSERT INTO `tp_city` VALUES (3776, 3773, 0, 3, 0, '其它区', '广东省珠海市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3777, 3773, 0, 3, 0, '香洲区', '广东省珠海市香洲区', '519000', '', 'xzq', 'X', 0);
INSERT INTO `tp_city` VALUES (3778, 3773, 0, 3, 0, '斗门区', '广东省珠海市斗门区', '519100', '', 'dmq', 'D', 0);
INSERT INTO `tp_city` VALUES (3779, 3773, 0, 3, 0, '金湾区', '广东省珠海市金湾区', '519090', '', 'jwq', 'J', 0);
INSERT INTO `tp_city` VALUES (3780, 3577, 0, 2, 0, '湛江市', '广东省湛江市', '524000', '', 'zjs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3781, 3780, 0, 3, 0, '雷州市', '广东省湛江市雷州市', '524200', '', 'lzs', 'L', 0);
INSERT INTO `tp_city` VALUES (3782, 3780, 0, 3, 0, '吴川市', '广东省湛江市吴川市', '524500', '', 'wcs', 'W', 0);
INSERT INTO `tp_city` VALUES (3783, 3780, 0, 3, 0, '廉江市', '广东省湛江市廉江市', '524400', '', 'ljs', 'L', 0);
INSERT INTO `tp_city` VALUES (3784, 3780, 0, 3, 0, '其它区', '广东省湛江市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3785, 3780, 0, 3, 0, '赤坎区', '广东省湛江市赤坎区', '524033', '', 'ckq', 'C', 0);
INSERT INTO `tp_city` VALUES (3786, 3780, 0, 3, 0, '霞山区', '广东省湛江市霞山区', '524002', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (3787, 3780, 0, 3, 0, '坡头区', '广东省湛江市坡头区', '524057', '', 'ptq', 'P', 0);
INSERT INTO `tp_city` VALUES (3788, 3780, 0, 3, 0, '麻章区', '广东省湛江市麻章区', '524003', '', 'mzq', 'M', 0);
INSERT INTO `tp_city` VALUES (3789, 3780, 0, 3, 0, '遂溪县', '广东省湛江市遂溪县', '524300', '', 'sxx', 'S', 0);
INSERT INTO `tp_city` VALUES (3790, 3780, 0, 3, 0, '徐闻县', '广东省湛江市徐闻县', '524100', '', 'xwx', 'X', 0);
INSERT INTO `tp_city` VALUES (3791, 3577, 0, 2, 0, '佛山市', '广东省佛山市', '528000', '', 'fss', 'F', 0);
INSERT INTO `tp_city` VALUES (3792, 3791, 0, 3, 0, '顺德区', '广东省佛山市顺德区', '528300', '', 'sdq', 'S', 0);
INSERT INTO `tp_city` VALUES (3793, 3791, 0, 3, 0, '三水区', '广东省佛山市三水区', '528100', '', 'ssq', 'S', 0);
INSERT INTO `tp_city` VALUES (3794, 3791, 0, 3, 0, '禅城区', '广东省佛山市禅城区', '528000', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3795, 3791, 0, 3, 0, '南海区', '广东省佛山市南海区', '528200', '', 'nhq', 'N', 0);
INSERT INTO `tp_city` VALUES (3796, 3791, 0, 3, 0, '其它区', '广东省佛山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3797, 3791, 0, 3, 0, '高明区', '广东省佛山市高明区', '528500', '', 'gmq', 'G', 0);
INSERT INTO `tp_city` VALUES (3798, 3577, 0, 2, 0, '江门市', '广东省江门市', '529000', '', 'jms', 'J', 0);
INSERT INTO `tp_city` VALUES (3799, 3798, 0, 3, 0, '江海区', '广东省江门市江海区', '529000', '', 'jhq', 'J', 0);
INSERT INTO `tp_city` VALUES (3800, 3798, 0, 3, 0, '新会区', '广东省江门市新会区', '529100', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (3801, 3798, 0, 3, 0, '开平市', '广东省江门市开平市', '529300', '', 'kps', 'K', 0);
INSERT INTO `tp_city` VALUES (3802, 3798, 0, 3, 0, '台山市', '广东省江门市台山市', '529200', '', 'tss', 'T', 0);
INSERT INTO `tp_city` VALUES (3803, 3798, 0, 3, 0, '其它区', '广东省江门市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3804, 3798, 0, 3, 0, '恩平市', '广东省江门市恩平市', '529400', '', 'eps', 'E', 0);
INSERT INTO `tp_city` VALUES (3805, 3798, 0, 3, 0, '鹤山市', '广东省江门市鹤山市', '529700', '', 'hss', 'H', 0);
INSERT INTO `tp_city` VALUES (3806, 3798, 0, 3, 0, '蓬江区', '广东省江门市蓬江区', '529051', '', 'pjq', 'P', 0);
INSERT INTO `tp_city` VALUES (3807, 0, 0, 1, 0, '重庆', '重庆', '', '', 'zq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3808, 3807, 0, 2, 0, '重庆市', '重庆重庆市', '400000', '', 'zqs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3809, 3808, 0, 3, 0, '涪陵区', '重庆重庆市涪陵区', '408000', '', 'flq', 'F', 0);
INSERT INTO `tp_city` VALUES (3810, 3808, 0, 3, 0, '渝中区', '重庆重庆市渝中区', '400012', '', 'yzq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3811, 3808, 0, 3, 0, '万州区', '重庆重庆市万州区', '404000', '', 'wzq', 'W', 0);
INSERT INTO `tp_city` VALUES (3812, 3808, 0, 3, 0, '万盛区', '重庆重庆市万盛区', '400800', '', 'wsq', 'W', 0);
INSERT INTO `tp_city` VALUES (3813, 3808, 0, 3, 0, '双桥区', '重庆重庆市双桥区', '400900', '', 'sqq', 'S', 0);
INSERT INTO `tp_city` VALUES (3814, 3808, 0, 3, 0, '南岸区', '重庆重庆市南岸区', '400060', '', 'naq', 'N', 0);
INSERT INTO `tp_city` VALUES (3815, 3808, 0, 3, 0, '北碚区', '重庆重庆市北碚区', '400700', '', 'bq', 'B', 0);
INSERT INTO `tp_city` VALUES (3816, 3808, 0, 3, 0, '沙坪坝区', '重庆重庆市沙坪坝区', '400020', '', 'spbq', 'S', 0);
INSERT INTO `tp_city` VALUES (3817, 3808, 0, 3, 0, '九龙坡区', '重庆重庆市九龙坡区', '400039', '', 'jlpq', 'J', 0);
INSERT INTO `tp_city` VALUES (3818, 3808, 0, 3, 0, '大渡口区', '重庆重庆市大渡口区', '400084', '', 'ddkq', 'D', 0);
INSERT INTO `tp_city` VALUES (3819, 3808, 0, 3, 0, '江北区', '重庆重庆市江北区', '400021', '', 'jbq', 'J', 0);
INSERT INTO `tp_city` VALUES (3820, 3808, 0, 3, 0, '长寿区', '重庆重庆市长寿区', '401220', '', 'csq', 'C', 0);
INSERT INTO `tp_city` VALUES (3821, 3808, 0, 3, 0, '黔江区', '重庆重庆市黔江区', '409700', '', 'qjq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3822, 3808, 0, 3, 0, '巴南区', '重庆重庆市巴南区', '401320', '', 'bnq', 'B', 0);
INSERT INTO `tp_city` VALUES (3823, 3808, 0, 3, 0, '渝北区', '重庆重庆市渝北区', '401120', '', 'ybq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3824, 3808, 0, 3, 0, '潼南县', '重庆重庆市潼南县', '402660', '', 'nx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3825, 3808, 0, 3, 0, '綦江区', '重庆重庆市綦江区', '401420', '', 'jq', 'Z', 0);
INSERT INTO `tp_city` VALUES (3826, 3808, 0, 3, 0, '石柱县', '重庆重庆市石柱县', '409100', '', 'szx', 'S', 0);
INSERT INTO `tp_city` VALUES (3827, 3808, 0, 3, 0, '秀山县', '重庆重庆市秀山县', '409900', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (3828, 3808, 0, 3, 0, '酉阳县', '重庆重庆市酉阳县', '409800', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3829, 3808, 0, 3, 0, '彭水县', '重庆重庆市彭水县', '409600', '', 'psx', 'P', 0);
INSERT INTO `tp_city` VALUES (3830, 3808, 0, 3, 0, '忠县', '重庆重庆市忠县', '404300', '', 'zx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3831, 3808, 0, 3, 0, '武隆县', '重庆重庆市武隆县', '408500', '', 'wlx', 'W', 0);
INSERT INTO `tp_city` VALUES (3832, 3808, 0, 3, 0, '云阳县', '重庆重庆市云阳县', '404500', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3833, 3808, 0, 3, 0, '开县', '重庆重庆市开县', '405400', '', 'kx', 'K', 0);
INSERT INTO `tp_city` VALUES (3834, 3808, 0, 3, 0, '巫山县', '重庆重庆市巫山县', '404700', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (3835, 3808, 0, 3, 0, '奉节县', '重庆重庆市奉节县', '404600', '', 'fjx', 'F', 0);
INSERT INTO `tp_city` VALUES (3836, 3808, 0, 3, 0, '巫溪县', '重庆重庆市巫溪县', '405800', '', 'wxx', 'W', 0);
INSERT INTO `tp_city` VALUES (3837, 3808, 0, 3, 0, '大足区', '重庆重庆市大足区', '402360', '', 'dzq', 'D', 0);
INSERT INTO `tp_city` VALUES (3838, 3808, 0, 3, 0, '铜梁县', '重庆重庆市铜梁县', '402560', '', 'tlx', 'T', 0);
INSERT INTO `tp_city` VALUES (3839, 3808, 0, 3, 0, '璧山县', '重庆重庆市璧山县', '402760', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3840, 3808, 0, 3, 0, '荣昌县', '重庆重庆市荣昌县', '402460', '', 'rcx', 'R', 0);
INSERT INTO `tp_city` VALUES (3841, 3808, 0, 3, 0, '城口县', '重庆重庆市城口县', '405900', '', 'ckx', 'C', 0);
INSERT INTO `tp_city` VALUES (3842, 3808, 0, 3, 0, '梁平县', '重庆重庆市梁平县', '405200', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (3843, 3808, 0, 3, 0, '垫江县', '重庆重庆市垫江县', '408300', '', 'djx', 'D', 0);
INSERT INTO `tp_city` VALUES (3844, 3808, 0, 3, 0, '丰都县', '重庆重庆市丰都县', '408200', '', 'fdx', 'F', 0);
INSERT INTO `tp_city` VALUES (3845, 3808, 0, 3, 0, '江津区', '重庆重庆市江津区', '402260', '', 'jjq', 'J', 0);
INSERT INTO `tp_city` VALUES (3846, 3808, 0, 3, 0, '永川区', '重庆重庆市永川区', '402160', '', 'ycq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3847, 3808, 0, 3, 0, '合川区', '重庆重庆市合川区', '401520', '', 'hcq', 'H', 0);
INSERT INTO `tp_city` VALUES (3848, 3808, 0, 3, 0, '南川区', '重庆重庆市南川区', '408400', '', 'ncq', 'N', 0);
INSERT INTO `tp_city` VALUES (3849, 3808, 0, 3, 0, '其它区', '重庆重庆市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3850, 0, 0, 1, 0, '河北省', '河北省', '', '', 'hbs', 'H', 0);
INSERT INTO `tp_city` VALUES (3851, 3850, 0, 2, 0, '衡水市', '河北省衡水市', '053000', '', 'hss', 'H', 0);
INSERT INTO `tp_city` VALUES (3852, 3851, 0, 3, 0, '枣强县', '河北省衡水市枣强县', '053100', '', 'zqx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3853, 3851, 0, 3, 0, '武强县', '河北省衡水市武强县', '053300', '', 'wqx', 'W', 0);
INSERT INTO `tp_city` VALUES (3854, 3851, 0, 3, 0, '武邑县', '河北省衡水市武邑县', '053400', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (3855, 3851, 0, 3, 0, '安平县', '河北省衡水市安平县', '053600', '', 'apx', 'A', 0);
INSERT INTO `tp_city` VALUES (3856, 3851, 0, 3, 0, '饶阳县', '河北省衡水市饶阳县', '053900', '', 'ryx', 'R', 0);
INSERT INTO `tp_city` VALUES (3857, 3851, 0, 3, 0, '景县', '河北省衡水市景县', '053500', '', 'jx', 'J', 0);
INSERT INTO `tp_city` VALUES (3858, 3851, 0, 3, 0, '故城县', '河北省衡水市故城县', '253800', '', 'gcx', 'G', 0);
INSERT INTO `tp_city` VALUES (3859, 3851, 0, 3, 0, '阜城县', '河北省衡水市阜城县', '053700', '', 'fcx', 'F', 0);
INSERT INTO `tp_city` VALUES (3860, 3851, 0, 3, 0, '桃城区', '河北省衡水市桃城区', '053000', '', 'tcq', 'T', 0);
INSERT INTO `tp_city` VALUES (3861, 3851, 0, 3, 0, '冀州市', '河北省衡水市冀州市', '053200', '', 'jzs', 'J', 0);
INSERT INTO `tp_city` VALUES (3862, 3851, 0, 3, 0, '深州市', '河北省衡水市深州市', '053800', '', 'szs', 'S', 0);
INSERT INTO `tp_city` VALUES (3863, 3851, 0, 3, 0, '其它区', '河北省衡水市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3864, 3850, 0, 2, 0, '石家庄市', '河北省石家庄市', '050000', '', 'sjzs', 'S', 0);
INSERT INTO `tp_city` VALUES (3865, 3864, 0, 3, 0, '桥东区', '河北省石家庄市桥东区', '050011', '', 'qdq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3866, 3864, 0, 3, 0, '长安区', '河北省石家庄市长安区', '050011', '', 'caq', 'C', 0);
INSERT INTO `tp_city` VALUES (3867, 3864, 0, 3, 0, '裕华区', '河北省石家庄市裕华区', '050081', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (3868, 3864, 0, 3, 0, '新华区', '河北省石家庄市新华区', '050051', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (3869, 3864, 0, 3, 0, '桥西区', '河北省石家庄市桥西区', '050051', '', 'qxq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3870, 3864, 0, 3, 0, '井陉矿区', '河北省石家庄市井陉矿区', '050100', '', 'jkq', 'J', 0);
INSERT INTO `tp_city` VALUES (3871, 3864, 0, 3, 0, '正定县', '河北省石家庄市正定县', '050800', '', 'zdx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3872, 3864, 0, 3, 0, '井陉县', '河北省石家庄市井陉县', '050300', '', 'jx', 'J', 0);
INSERT INTO `tp_city` VALUES (3873, 3864, 0, 3, 0, '灵寿县', '河北省石家庄市灵寿县', '050500', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (3874, 3864, 0, 3, 0, '高邑县', '河北省石家庄市高邑县', '051330', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (3875, 3864, 0, 3, 0, '栾城县', '河北省石家庄市栾城县', '051430', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3876, 3864, 0, 3, 0, '行唐县', '河北省石家庄市行唐县', '050600', '', 'xtx', 'X', 0);
INSERT INTO `tp_city` VALUES (3877, 3864, 0, 3, 0, '平山县', '河北省石家庄市平山县', '050400', '', 'psx', 'P', 0);
INSERT INTO `tp_city` VALUES (3878, 3864, 0, 3, 0, '无极县', '河北省石家庄市无极县', '052460', '', 'wjx', 'W', 0);
INSERT INTO `tp_city` VALUES (3879, 3864, 0, 3, 0, '赞皇县', '河北省石家庄市赞皇县', '051230', '', 'zhx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3880, 3864, 0, 3, 0, '深泽县', '河北省石家庄市深泽县', '052560', '', 'szx', 'S', 0);
INSERT INTO `tp_city` VALUES (3881, 3864, 0, 3, 0, '赵县', '河北省石家庄市赵县', '051530', '', 'zx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3882, 3864, 0, 3, 0, '元氏县', '河北省石家庄市元氏县', '051130', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3883, 3864, 0, 3, 0, '其它区', '河北省石家庄市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3884, 3864, 0, 3, 0, '鹿泉市', '河北省石家庄市鹿泉市', '050200', '', 'lqs', 'L', 0);
INSERT INTO `tp_city` VALUES (3885, 3864, 0, 3, 0, '新乐市', '河北省石家庄市新乐市', '050700', '', 'xls', 'X', 0);
INSERT INTO `tp_city` VALUES (3886, 3864, 0, 3, 0, '晋州市', '河北省石家庄市晋州市', '052260', '', 'jzs', 'J', 0);
INSERT INTO `tp_city` VALUES (3887, 3864, 0, 3, 0, '藁城市', '河北省石家庄市藁城市', '052160', '', 'cs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3888, 3864, 0, 3, 0, '辛集市', '河北省石家庄市辛集市', '052360', '', 'xjs', 'X', 0);
INSERT INTO `tp_city` VALUES (3889, 3850, 0, 2, 0, '唐山市', '河北省唐山市', '063000', '', 'tss', 'T', 0);
INSERT INTO `tp_city` VALUES (3890, 3889, 0, 3, 0, '滦县', '河北省唐山市滦县', '063700', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (3891, 3889, 0, 3, 0, '丰润区', '河北省唐山市丰润区', '064000', '', 'frq', 'F', 0);
INSERT INTO `tp_city` VALUES (3892, 3889, 0, 3, 0, '玉田县', '河北省唐山市玉田县', '064100', '', 'ytx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3893, 3889, 0, 3, 0, '曹妃甸区', '河北省唐山市曹妃甸区', '063200', '', 'cdq', 'C', 0);
INSERT INTO `tp_city` VALUES (3894, 3889, 0, 3, 0, '滦南县', '河北省唐山市滦南县', '063500', '', 'lnx', 'L', 0);
INSERT INTO `tp_city` VALUES (3895, 3889, 0, 3, 0, '乐亭县', '河北省唐山市乐亭县', '063600', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (3896, 3889, 0, 3, 0, '迁西县', '河北省唐山市迁西县', '064300', '', 'qxx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3897, 3889, 0, 3, 0, '丰南区', '河北省唐山市丰南区', '063300', '', 'fnq', 'F', 0);
INSERT INTO `tp_city` VALUES (3898, 3889, 0, 3, 0, '古冶区', '河北省唐山市古冶区', '063104', '', 'gyq', 'G', 0);
INSERT INTO `tp_city` VALUES (3899, 3889, 0, 3, 0, '开平区', '河北省唐山市开平区', '063021', '', 'kpq', 'K', 0);
INSERT INTO `tp_city` VALUES (3900, 3889, 0, 3, 0, '路南区', '河北省唐山市路南区', '063017', '', 'lnq', 'L', 0);
INSERT INTO `tp_city` VALUES (3901, 3889, 0, 3, 0, '路北区', '河北省唐山市路北区', '063015', '', 'lbq', 'L', 0);
INSERT INTO `tp_city` VALUES (3902, 3889, 0, 3, 0, '遵化市', '河北省唐山市遵化市', '064200', '', 'zhs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3903, 3889, 0, 3, 0, '迁安市', '河北省唐山市迁安市', '064400', '', 'qas', 'Q', 0);
INSERT INTO `tp_city` VALUES (3904, 3889, 0, 3, 0, '其它区', '河北省唐山市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3905, 3850, 0, 2, 0, '秦皇岛市', '河北省秦皇岛市', '066000', '', 'qhds', 'Q', 0);
INSERT INTO `tp_city` VALUES (3906, 3905, 0, 3, 0, '海港区', '河北省秦皇岛市海港区', '066000', '', 'hgq', 'H', 0);
INSERT INTO `tp_city` VALUES (3907, 3905, 0, 3, 0, '山海关区', '河北省秦皇岛市山海关区', '066200', '', 'shgq', 'S', 0);
INSERT INTO `tp_city` VALUES (3908, 3905, 0, 3, 0, '卢龙县', '河北省秦皇岛市卢龙县', '066400', '', 'llx', 'L', 0);
INSERT INTO `tp_city` VALUES (3909, 3905, 0, 3, 0, '青龙县', '河北省秦皇岛市青龙县', '066500', '', 'qlx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3910, 3905, 0, 3, 0, '抚宁县', '河北省秦皇岛市抚宁县', '066300', '', 'fnx', 'F', 0);
INSERT INTO `tp_city` VALUES (3911, 3905, 0, 3, 0, '昌黎县', '河北省秦皇岛市昌黎县', '066600', '', 'clx', 'C', 0);
INSERT INTO `tp_city` VALUES (3912, 3905, 0, 3, 0, '北戴河区', '河北省秦皇岛市北戴河区', '066100', '', 'bdhq', 'B', 0);
INSERT INTO `tp_city` VALUES (3913, 3905, 0, 3, 0, '经济技术开发区', '河北省秦皇岛市经济技术开发区', '', '', 'jjjskfq', 'J', 0);
INSERT INTO `tp_city` VALUES (3914, 3905, 0, 3, 0, '其它区', '河北省秦皇岛市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3915, 3850, 0, 2, 0, '邯郸市', '河北省邯郸市', '056000', '', 'hds', 'H', 0);
INSERT INTO `tp_city` VALUES (3916, 3915, 0, 3, 0, '临漳县', '河北省邯郸市临漳县', '056600', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (3917, 3915, 0, 3, 0, '邯郸县', '河北省邯郸市邯郸县', '056105', '', 'hdx', 'H', 0);
INSERT INTO `tp_city` VALUES (3918, 3915, 0, 3, 0, '磁县', '河北省邯郸市磁县', '056500', '', 'cx', 'C', 0);
INSERT INTO `tp_city` VALUES (3919, 3915, 0, 3, 0, '涉县', '河北省邯郸市涉县', '056400', '', 'sx', 'S', 0);
INSERT INTO `tp_city` VALUES (3920, 3915, 0, 3, 0, '大名县', '河北省邯郸市大名县', '056900', '', 'dmx', 'D', 0);
INSERT INTO `tp_city` VALUES (3921, 3915, 0, 3, 0, '成安县', '河北省邯郸市成安县', '056700', '', 'cax', 'C', 0);
INSERT INTO `tp_city` VALUES (3922, 3915, 0, 3, 0, '鸡泽县', '河北省邯郸市鸡泽县', '057350', '', 'jzx', 'J', 0);
INSERT INTO `tp_city` VALUES (3923, 3915, 0, 3, 0, '邱县', '河北省邯郸市邱县', '057450', '', 'qx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3924, 3915, 0, 3, 0, '永年县', '河北省邯郸市永年县', '057150', '', 'ynx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3925, 3915, 0, 3, 0, '肥乡县', '河北省邯郸市肥乡县', '057550', '', 'fxx', 'F', 0);
INSERT INTO `tp_city` VALUES (3926, 3915, 0, 3, 0, '邯山区', '河北省邯郸市邯山区', '056001', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (3927, 3915, 0, 3, 0, '丛台区', '河北省邯郸市丛台区', '056004', '', 'ctq', 'C', 0);
INSERT INTO `tp_city` VALUES (3928, 3915, 0, 3, 0, '峰峰矿区', '河北省邯郸市峰峰矿区', '056200', '', 'ffkq', 'F', 0);
INSERT INTO `tp_city` VALUES (3929, 3915, 0, 3, 0, '复兴区', '河北省邯郸市复兴区', '056003', '', 'fxq', 'F', 0);
INSERT INTO `tp_city` VALUES (3930, 3915, 0, 3, 0, '其它区', '河北省邯郸市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3931, 3915, 0, 3, 0, '武安市', '河北省邯郸市武安市', '056300', '', 'was', 'W', 0);
INSERT INTO `tp_city` VALUES (3932, 3915, 0, 3, 0, '馆陶县', '河北省邯郸市馆陶县', '057750', '', 'gtx', 'G', 0);
INSERT INTO `tp_city` VALUES (3933, 3915, 0, 3, 0, '广平县', '河北省邯郸市广平县', '057650', '', 'gpx', 'G', 0);
INSERT INTO `tp_city` VALUES (3934, 3915, 0, 3, 0, '曲周县', '河北省邯郸市曲周县', '057250', '', 'qzx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3935, 3915, 0, 3, 0, '魏县', '河北省邯郸市魏县', '056800', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (3936, 3850, 0, 2, 0, '邢台市', '河北省邢台市', '054000', '', 'xts', 'X', 0);
INSERT INTO `tp_city` VALUES (3937, 3936, 0, 3, 0, '广宗县', '河北省邢台市广宗县', '054600', '', 'gzx', 'G', 0);
INSERT INTO `tp_city` VALUES (3938, 3936, 0, 3, 0, '新河县', '河北省邢台市新河县', '055650', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (3939, 3936, 0, 3, 0, '巨鹿县', '河北省邢台市巨鹿县', '055250', '', 'jlx', 'J', 0);
INSERT INTO `tp_city` VALUES (3940, 3936, 0, 3, 0, '宁晋县', '河北省邢台市宁晋县', '055550', '', 'njx', 'N', 0);
INSERT INTO `tp_city` VALUES (3941, 3936, 0, 3, 0, '临西县', '河北省邢台市临西县', '054900', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (3942, 3936, 0, 3, 0, '清河县', '河北省邢台市清河县', '054800', '', 'qhx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3943, 3936, 0, 3, 0, '威县', '河北省邢台市威县', '054700', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (3944, 3936, 0, 3, 0, '平乡县', '河北省邢台市平乡县', '054500', '', 'pxx', 'P', 0);
INSERT INTO `tp_city` VALUES (3945, 3936, 0, 3, 0, '邢台县', '河北省邢台市邢台县', '054001', '', 'xtx', 'X', 0);
INSERT INTO `tp_city` VALUES (3946, 3936, 0, 3, 0, '临城县', '河北省邢台市临城县', '054300', '', 'lcx', 'L', 0);
INSERT INTO `tp_city` VALUES (3947, 3936, 0, 3, 0, '内丘县', '河北省邢台市内丘县', '054200', '', 'nqx', 'N', 0);
INSERT INTO `tp_city` VALUES (3948, 3936, 0, 3, 0, '柏乡县', '河北省邢台市柏乡县', '055450', '', 'bxx', 'B', 0);
INSERT INTO `tp_city` VALUES (3949, 3936, 0, 3, 0, '隆尧县', '河北省邢台市隆尧县', '055350', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (3950, 3936, 0, 3, 0, '任县', '河北省邢台市任县', '055150', '', 'rx', 'R', 0);
INSERT INTO `tp_city` VALUES (3951, 3936, 0, 3, 0, '南和县', '河北省邢台市南和县', '054400', '', 'nhx', 'N', 0);
INSERT INTO `tp_city` VALUES (3952, 3936, 0, 3, 0, '桥西区', '河北省邢台市桥西区', '054000', '', 'qxq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3953, 3936, 0, 3, 0, '桥东区', '河北省邢台市桥东区', '054001', '', 'qdq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3954, 3936, 0, 3, 0, '其它区', '河北省邢台市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3955, 3936, 0, 3, 0, '沙河市', '河北省邢台市沙河市', '054100', '', 'shs', 'S', 0);
INSERT INTO `tp_city` VALUES (3956, 3936, 0, 3, 0, '南宫市', '河北省邢台市南宫市', '055750', '', 'ngs', 'N', 0);
INSERT INTO `tp_city` VALUES (3957, 3850, 0, 2, 0, '保定市', '河北省保定市', '071000', '', 'bds', 'B', 0);
INSERT INTO `tp_city` VALUES (3958, 3957, 0, 3, 0, '新市区', '河北省保定市新市区', '071052', '', 'xsq', 'X', 0);
INSERT INTO `tp_city` VALUES (3959, 3957, 0, 3, 0, '北市区', '河北省保定市北市区', '071000', '', 'bsq', 'B', 0);
INSERT INTO `tp_city` VALUES (3960, 3957, 0, 3, 0, '南市区', '河北省保定市南市区', '071000', '', 'nsq', 'N', 0);
INSERT INTO `tp_city` VALUES (3961, 3957, 0, 3, 0, '满城县', '河北省保定市满城县', '072150', '', 'mcx', 'M', 0);
INSERT INTO `tp_city` VALUES (3962, 3957, 0, 3, 0, '涞水县', '河北省保定市涞水县', '074100', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3963, 3957, 0, 3, 0, '清苑县', '河北省保定市清苑县', '071100', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3964, 3957, 0, 3, 0, '涞源县', '河北省保定市涞源县', '074300', '', 'yx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3965, 3957, 0, 3, 0, '望都县', '河北省保定市望都县', '072450', '', 'wdx', 'W', 0);
INSERT INTO `tp_city` VALUES (3966, 3957, 0, 3, 0, '高阳县', '河北省保定市高阳县', '071500', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (3967, 3957, 0, 3, 0, '容城县', '河北省保定市容城县', '071700', '', 'rcx', 'R', 0);
INSERT INTO `tp_city` VALUES (3968, 3957, 0, 3, 0, '定兴县', '河北省保定市定兴县', '072650', '', 'dxx', 'D', 0);
INSERT INTO `tp_city` VALUES (3969, 3957, 0, 3, 0, '唐县', '河北省保定市唐县', '072350', '', 'tx', 'T', 0);
INSERT INTO `tp_city` VALUES (3970, 3957, 0, 3, 0, '阜平县', '河北省保定市阜平县', '073200', '', 'fpx', 'F', 0);
INSERT INTO `tp_city` VALUES (3971, 3957, 0, 3, 0, '徐水县', '河北省保定市徐水县', '072550', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (3972, 3957, 0, 3, 0, '雄县', '河北省保定市雄县', '071800', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (3973, 3957, 0, 3, 0, '顺平县', '河北省保定市顺平县', '072250', '', 'spx', 'S', 0);
INSERT INTO `tp_city` VALUES (3974, 3957, 0, 3, 0, '博野县', '河北省保定市博野县', '071300', '', 'byx', 'B', 0);
INSERT INTO `tp_city` VALUES (3975, 3957, 0, 3, 0, '曲阳县', '河北省保定市曲阳县', '073100', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (3976, 3957, 0, 3, 0, '蠡县', '河北省保定市蠡县', '071400', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (3977, 3957, 0, 3, 0, '安新县', '河北省保定市安新县', '071600', '', 'axx', 'A', 0);
INSERT INTO `tp_city` VALUES (3978, 3957, 0, 3, 0, '易县', '河北省保定市易县', '074200', '', 'yx', 'Y', 0);
INSERT INTO `tp_city` VALUES (3979, 3957, 0, 3, 0, '高碑店市', '河北省保定市高碑店市', '074000', '', 'gbds', 'G', 0);
INSERT INTO `tp_city` VALUES (3980, 3957, 0, 3, 0, '涿州市', '河北省保定市涿州市', '072750', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (3981, 3957, 0, 3, 0, '安国市', '河北省保定市安国市', '071200', '', 'ags', 'A', 0);
INSERT INTO `tp_city` VALUES (3982, 3957, 0, 3, 0, '定州市', '河北省保定市定州市', '073000', '', 'dzs', 'D', 0);
INSERT INTO `tp_city` VALUES (3983, 3957, 0, 3, 0, '其它区', '河北省保定市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3984, 3957, 0, 3, 0, '高开区', '河北省保定市高开区', '', '', 'gkq', 'G', 0);
INSERT INTO `tp_city` VALUES (3985, 3850, 0, 2, 0, '张家口市', '河北省张家口市', '075000', '', 'zjks', 'Z', 0);
INSERT INTO `tp_city` VALUES (3986, 3985, 0, 3, 0, '桥西区', '河北省张家口市桥西区', '075061', '', 'qxq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3987, 3985, 0, 3, 0, '桥东区', '河北省张家口市桥东区', '075000', '', 'qdq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3988, 3985, 0, 3, 0, '下花园区', '河北省张家口市下花园区', '075300', '', 'xhyq', 'X', 0);
INSERT INTO `tp_city` VALUES (3989, 3985, 0, 3, 0, '宣化区', '河北省张家口市宣化区', '075100', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (3990, 3985, 0, 3, 0, '万全县', '河北省张家口市万全县', '076250', '', 'wqx', 'W', 0);
INSERT INTO `tp_city` VALUES (3991, 3985, 0, 3, 0, '怀安县', '河北省张家口市怀安县', '076150', '', 'hax', 'H', 0);
INSERT INTO `tp_city` VALUES (3992, 3985, 0, 3, 0, '涿鹿县', '河北省张家口市涿鹿县', '075600', '', 'lx', 'Z', 0);
INSERT INTO `tp_city` VALUES (3993, 3985, 0, 3, 0, '怀来县', '河北省张家口市怀来县', '075400', '', 'hlx', 'H', 0);
INSERT INTO `tp_city` VALUES (3994, 3985, 0, 3, 0, '崇礼县', '河北省张家口市崇礼县', '076350', '', 'clx', 'C', 0);
INSERT INTO `tp_city` VALUES (3995, 3985, 0, 3, 0, '赤城县', '河北省张家口市赤城县', '075500', '', 'ccx', 'C', 0);
INSERT INTO `tp_city` VALUES (3996, 3985, 0, 3, 0, '其它区', '河北省张家口市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (3997, 3985, 0, 3, 0, '宣化县', '河北省张家口市宣化县', '075100', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (3998, 3985, 0, 3, 0, '康保县', '河北省张家口市康保县', '076650', '', 'kbx', 'K', 0);
INSERT INTO `tp_city` VALUES (3999, 3985, 0, 3, 0, '张北县', '河北省张家口市张北县', '076450', '', 'zbx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4000, 3985, 0, 3, 0, '尚义县', '河北省张家口市尚义县', '076750', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (4001, 3985, 0, 3, 0, '沽源县', '河北省张家口市沽源县', '076550', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (4002, 3985, 0, 3, 0, '阳原县', '河北省张家口市阳原县', '075800', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4003, 3985, 0, 3, 0, '蔚县', '河北省张家口市蔚县', '075700', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (4004, 3850, 0, 2, 0, '承德市', '河北省承德市', '067000', '', 'cds', 'C', 0);
INSERT INTO `tp_city` VALUES (4005, 4004, 0, 3, 0, '鹰手营子矿区', '河北省承德市鹰手营子矿区', '067000', '', 'ysyzkq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4006, 4004, 0, 3, 0, '双桥区', '河北省承德市双桥区', '067000', '', 'sqq', 'S', 0);
INSERT INTO `tp_city` VALUES (4007, 4004, 0, 3, 0, '双滦区', '河北省承德市双滦区', '067000', '', 'slq', 'S', 0);
INSERT INTO `tp_city` VALUES (4008, 4004, 0, 3, 0, '承德县', '河北省承德市承德县', '067400', '', 'cdx', 'C', 0);
INSERT INTO `tp_city` VALUES (4009, 4004, 0, 3, 0, '兴隆县', '河北省承德市兴隆县', '067300', '', 'xlx', 'X', 0);
INSERT INTO `tp_city` VALUES (4010, 4004, 0, 3, 0, '平泉县', '河北省承德市平泉县', '067500', '', 'pqx', 'P', 0);
INSERT INTO `tp_city` VALUES (4011, 4004, 0, 3, 0, '滦平县', '河北省承德市滦平县', '068250', '', 'lpx', 'L', 0);
INSERT INTO `tp_city` VALUES (4012, 4004, 0, 3, 0, '隆化县', '河北省承德市隆化县', '068150', '', 'lhx', 'L', 0);
INSERT INTO `tp_city` VALUES (4013, 4004, 0, 3, 0, '丰宁满族自治县', '河北省承德市丰宁满族自治县', '068350', '', 'fnmzzzx', 'F', 0);
INSERT INTO `tp_city` VALUES (4014, 4004, 0, 3, 0, '宽城满族自治县', '河北省承德市宽城满族自治县', '067600', '', 'kcmzzzx', 'K', 0);
INSERT INTO `tp_city` VALUES (4015, 4004, 0, 3, 0, '围场满族蒙古族自治县', '河北省承德市围场满族蒙古族自治县', '068450', '', 'wcmzmgzzzx', 'W', 0);
INSERT INTO `tp_city` VALUES (4016, 4004, 0, 3, 0, '其它区', '河北省承德市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4017, 3850, 0, 2, 0, '沧州市', '河北省沧州市', '061000', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (4018, 4017, 0, 3, 0, '运河区', '河北省沧州市运河区', '061000', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4019, 4017, 0, 3, 0, '新华区', '河北省沧州市新华区', '061000', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (4020, 4017, 0, 3, 0, '孟村回族自治县', '河北省沧州市孟村回族自治县', '061400', '', 'mchzzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (4021, 4017, 0, 3, 0, '献县', '河北省沧州市献县', '062250', '', 'xx', 'X', 0);
INSERT INTO `tp_city` VALUES (4022, 4017, 0, 3, 0, '吴桥县', '河北省沧州市吴桥县', '061800', '', 'wqx', 'W', 0);
INSERT INTO `tp_city` VALUES (4023, 4017, 0, 3, 0, '肃宁县', '河北省沧州市肃宁县', '062350', '', 'snx', 'S', 0);
INSERT INTO `tp_city` VALUES (4024, 4017, 0, 3, 0, '南皮县', '河北省沧州市南皮县', '061500', '', 'npx', 'N', 0);
INSERT INTO `tp_city` VALUES (4025, 4017, 0, 3, 0, '海兴县', '河北省沧州市海兴县', '061200', '', 'hxx', 'H', 0);
INSERT INTO `tp_city` VALUES (4026, 4017, 0, 3, 0, '盐山县', '河北省沧州市盐山县', '061300', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4027, 4017, 0, 3, 0, '青县', '河北省沧州市青县', '062650', '', 'qx', 'Q', 0);
INSERT INTO `tp_city` VALUES (4028, 4017, 0, 3, 0, '东光县', '河北省沧州市东光县', '061600', '', 'dgx', 'D', 0);
INSERT INTO `tp_city` VALUES (4029, 4017, 0, 3, 0, '沧县', '河北省沧州市沧县', '061035', '', 'cx', 'C', 0);
INSERT INTO `tp_city` VALUES (4030, 4017, 0, 3, 0, '其它区', '河北省沧州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4031, 4017, 0, 3, 0, '河间市', '河北省沧州市河间市', '062450', '', 'hjs', 'H', 0);
INSERT INTO `tp_city` VALUES (4032, 4017, 0, 3, 0, '黄骅市', '河北省沧州市黄骅市', '061100', '', 'hs', 'H', 0);
INSERT INTO `tp_city` VALUES (4033, 4017, 0, 3, 0, '任丘市', '河北省沧州市任丘市', '062550', '', 'rqs', 'R', 0);
INSERT INTO `tp_city` VALUES (4034, 4017, 0, 3, 0, '泊头市', '河北省沧州市泊头市', '062150', '', 'bts', 'B', 0);
INSERT INTO `tp_city` VALUES (4035, 3850, 0, 2, 0, '廊坊市', '河北省廊坊市', '065000', '', 'lfs', 'L', 0);
INSERT INTO `tp_city` VALUES (4036, 4035, 0, 3, 0, '三河市', '河北省廊坊市三河市', '065200', '', 'shs', 'S', 0);
INSERT INTO `tp_city` VALUES (4037, 4035, 0, 3, 0, '其它区', '河北省廊坊市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4038, 4035, 0, 3, 0, '霸州市', '河北省廊坊市霸州市', '065700', '', 'bzs', 'B', 0);
INSERT INTO `tp_city` VALUES (4039, 4035, 0, 3, 0, '安次区', '河北省廊坊市安次区', '065000', '', 'acq', 'A', 0);
INSERT INTO `tp_city` VALUES (4040, 4035, 0, 3, 0, '广阳区', '河北省廊坊市广阳区', '065000', '', 'gyq', 'G', 0);
INSERT INTO `tp_city` VALUES (4041, 4035, 0, 3, 0, '大厂回族自治县', '河北省廊坊市大厂回族自治县', '065300', '', 'dchzzzx', 'D', 0);
INSERT INTO `tp_city` VALUES (4042, 4035, 0, 3, 0, '香河县', '河北省廊坊市香河县', '065400', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (4043, 4035, 0, 3, 0, '大城县', '河北省廊坊市大城县', '065900', '', 'dcx', 'D', 0);
INSERT INTO `tp_city` VALUES (4044, 4035, 0, 3, 0, '文安县', '河北省廊坊市文安县', '065800', '', 'wax', 'W', 0);
INSERT INTO `tp_city` VALUES (4045, 4035, 0, 3, 0, '永清县', '河北省廊坊市永清县', '065600', '', 'yqx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4046, 4035, 0, 3, 0, '固安县', '河北省廊坊市固安县', '065500', '', 'gax', 'G', 0);
INSERT INTO `tp_city` VALUES (4047, 4035, 0, 3, 0, '燕郊经济技术开发区', '河北省廊坊市燕郊经济技术开发区', '', '', 'yjjjjskfq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4048, 4035, 0, 3, 0, '开发区', '河北省廊坊市开发区', '', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (4049, 0, 0, 1, 0, '湖南省', '湖南省', '', '', 'hns', 'H', 0);
INSERT INTO `tp_city` VALUES (4050, 4049, 0, 2, 0, '怀化市', '湖南省怀化市', '418000', '', 'hhs', 'H', 0);
INSERT INTO `tp_city` VALUES (4051, 4050, 0, 3, 0, '鹤城区', '湖南省怀化市鹤城区', '418000', '', 'hcq', 'H', 0);
INSERT INTO `tp_city` VALUES (4052, 4050, 0, 3, 0, '中方县', '湖南省怀化市中方县', '418005', '', 'zfx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4053, 4050, 0, 3, 0, '沅陵县', '湖南省怀化市沅陵县', '419600', '', 'lx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4054, 4050, 0, 3, 0, '辰溪县', '湖南省怀化市辰溪县', '419500', '', 'cxx', 'C', 0);
INSERT INTO `tp_city` VALUES (4055, 4050, 0, 3, 0, '溆浦县', '湖南省怀化市溆浦县', '419300', '', 'px', 'Z', 0);
INSERT INTO `tp_city` VALUES (4056, 4050, 0, 3, 0, '会同县', '湖南省怀化市会同县', '418300', '', 'htx', 'H', 0);
INSERT INTO `tp_city` VALUES (4057, 4050, 0, 3, 0, '麻阳苗族自治县', '湖南省怀化市麻阳苗族自治县', '419400', '', 'mymzzzx', 'M', 0);
INSERT INTO `tp_city` VALUES (4058, 4050, 0, 3, 0, '新晃侗族自治县', '湖南省怀化市新晃侗族自治县', '419200', '', 'xhdzzzx', 'X', 0);
INSERT INTO `tp_city` VALUES (4059, 4050, 0, 3, 0, '芷江侗族自治县', '湖南省怀化市芷江侗族自治县', '419100', '', 'jdzzzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4060, 4050, 0, 3, 0, '靖州苗族侗族自治县', '湖南省怀化市靖州苗族侗族自治县', '418400', '', 'jzmzdzzzx', 'J', 0);
INSERT INTO `tp_city` VALUES (4061, 4050, 0, 3, 0, '通道侗族自治县', '湖南省怀化市通道侗族自治县', '418500', '', 'tddzzzx', 'T', 0);
INSERT INTO `tp_city` VALUES (4062, 4050, 0, 3, 0, '洪江市', '湖南省怀化市洪江市', '418200', '', 'hjs', 'H', 0);
INSERT INTO `tp_city` VALUES (4063, 4050, 0, 3, 0, '其它区', '湖南省怀化市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4064, 4049, 0, 2, 0, '娄底市', '湖南省娄底市', '417000', '', 'lds', 'L', 0);
INSERT INTO `tp_city` VALUES (4065, 4064, 0, 3, 0, '娄星区', '湖南省娄底市娄星区', '417000', '', 'lxq', 'L', 0);
INSERT INTO `tp_city` VALUES (4066, 4064, 0, 3, 0, '新化县', '湖南省娄底市新化县', '417600', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (4067, 4064, 0, 3, 0, '双峰县', '湖南省娄底市双峰县', '417700', '', 'sfx', 'S', 0);
INSERT INTO `tp_city` VALUES (4068, 4064, 0, 3, 0, '冷水江市', '湖南省娄底市冷水江市', '417500', '', 'lsjs', 'L', 0);
INSERT INTO `tp_city` VALUES (4069, 4064, 0, 3, 0, '涟源市', '湖南省娄底市涟源市', '417100', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (4070, 4064, 0, 3, 0, '其它区', '湖南省娄底市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4071, 4049, 0, 2, 0, '株洲市', '湖南省株洲市', '412000', '', 'zzs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4072, 4071, 0, 3, 0, '荷塘区', '湖南省株洲市荷塘区', '412000', '', 'htq', 'H', 0);
INSERT INTO `tp_city` VALUES (4073, 4071, 0, 3, 0, '芦淞区', '湖南省株洲市芦淞区', '412000', '', 'lq', 'L', 0);
INSERT INTO `tp_city` VALUES (4074, 4071, 0, 3, 0, '石峰区', '湖南省株洲市石峰区', '412005', '', 'sfq', 'S', 0);
INSERT INTO `tp_city` VALUES (4075, 4071, 0, 3, 0, '其它区', '湖南省株洲市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4076, 4071, 0, 3, 0, '醴陵市', '湖南省株洲市醴陵市', '412200', '', 'ls', 'Z', 0);
INSERT INTO `tp_city` VALUES (4077, 4071, 0, 3, 0, '天元区', '湖南省株洲市天元区', '412000', '', 'tyq', 'T', 0);
INSERT INTO `tp_city` VALUES (4078, 4071, 0, 3, 0, '攸县', '湖南省株洲市攸县', '412300', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (4079, 4071, 0, 3, 0, '株洲县', '湖南省株洲市株洲县', '412100', '', 'zzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4080, 4071, 0, 3, 0, '炎陵县', '湖南省株洲市炎陵县', '412500', '', 'ylx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4081, 4071, 0, 3, 0, '茶陵县', '湖南省株洲市茶陵县', '412400', '', 'clx', 'C', 0);
INSERT INTO `tp_city` VALUES (4082, 4049, 0, 2, 0, '长沙市', '湖南省长沙市', '410000', '', 'css', 'C', 0);
INSERT INTO `tp_city` VALUES (4083, 4082, 0, 3, 0, '浏阳市', '湖南省长沙市浏阳市', '410300', '', 'ys', 'Z', 0);
INSERT INTO `tp_city` VALUES (4084, 4082, 0, 3, 0, '其它区', '湖南省长沙市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4085, 4082, 0, 3, 0, '雨花区', '湖南省长沙市雨花区', '410007', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4086, 4082, 0, 3, 0, '岳麓区', '湖南省长沙市岳麓区', '410006', '', 'ylq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4087, 4082, 0, 3, 0, '开福区', '湖南省长沙市开福区', '410005', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (4088, 4082, 0, 3, 0, '芙蓉区', '湖南省长沙市芙蓉区', '410006', '', 'rq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4089, 4082, 0, 3, 0, '天心区', '湖南省长沙市天心区', '410002', '', 'txq', 'T', 0);
INSERT INTO `tp_city` VALUES (4090, 4082, 0, 3, 0, '宁乡县', '湖南省长沙市宁乡县', '410600', '', 'nxx', 'N', 0);
INSERT INTO `tp_city` VALUES (4091, 4082, 0, 3, 0, '长沙县', '湖南省长沙市长沙县', '410100', '', 'csx', 'C', 0);
INSERT INTO `tp_city` VALUES (4092, 4082, 0, 3, 0, '望城区', '湖南省长沙市望城区', '410200', '', 'wcq', 'W', 0);
INSERT INTO `tp_city` VALUES (4093, 4049, 0, 2, 0, '湘潭市', '湖南省湘潭市', '411100', '', 'xts', 'X', 0);
INSERT INTO `tp_city` VALUES (4094, 4093, 0, 3, 0, '雨湖区', '湖南省湘潭市雨湖区', '411100', '', 'yhq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4095, 4093, 0, 3, 0, '岳塘区', '湖南省湘潭市岳塘区', '411101', '', 'ytq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4096, 4093, 0, 3, 0, '湘潭县', '湖南省湘潭市湘潭县', '411200', '', 'xtx', 'X', 0);
INSERT INTO `tp_city` VALUES (4097, 4093, 0, 3, 0, '其它区', '湖南省湘潭市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4098, 4093, 0, 3, 0, '韶山市', '湖南省湘潭市韶山市', '411300', '', 'sss', 'S', 0);
INSERT INTO `tp_city` VALUES (4099, 4093, 0, 3, 0, '湘乡市', '湖南省湘潭市湘乡市', '411400', '', 'xxs', 'X', 0);
INSERT INTO `tp_city` VALUES (4100, 4049, 0, 2, 0, '衡阳市', '湖南省衡阳市', '421000', '', 'hys', 'H', 0);
INSERT INTO `tp_city` VALUES (4101, 4100, 0, 3, 0, '衡东县', '湖南省衡阳市衡东县', '421400', '', 'hdx', 'H', 0);
INSERT INTO `tp_city` VALUES (4102, 4100, 0, 3, 0, '祁东县', '湖南省衡阳市祁东县', '421600', '', 'qdx', 'Q', 0);
INSERT INTO `tp_city` VALUES (4103, 4100, 0, 3, 0, '衡阳县', '湖南省衡阳市衡阳县', '421200', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (4104, 4100, 0, 3, 0, '衡南县', '湖南省衡阳市衡南县', '421100', '', 'hnx', 'H', 0);
INSERT INTO `tp_city` VALUES (4105, 4100, 0, 3, 0, '衡山县', '湖南省衡阳市衡山县', '421300', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (4106, 4100, 0, 3, 0, '蒸湘区', '湖南省衡阳市蒸湘区', '421001', '', 'zxq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4107, 4100, 0, 3, 0, '南岳区', '湖南省衡阳市南岳区', '421900', '', 'nyq', 'N', 0);
INSERT INTO `tp_city` VALUES (4108, 4100, 0, 3, 0, '珠晖区', '湖南省衡阳市珠晖区', '421002', '', 'zq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4109, 4100, 0, 3, 0, '石鼓区', '湖南省衡阳市石鼓区', '421001', '', 'sgq', 'S', 0);
INSERT INTO `tp_city` VALUES (4110, 4100, 0, 3, 0, '雁峰区', '湖南省衡阳市雁峰区', '421001', '', 'yfq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4111, 4100, 0, 3, 0, '耒阳市', '湖南省衡阳市耒阳市', '421800', '', 'ys', 'Z', 0);
INSERT INTO `tp_city` VALUES (4112, 4100, 0, 3, 0, '其它区', '湖南省衡阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4113, 4100, 0, 3, 0, '常宁市', '湖南省衡阳市常宁市', '421500', '', 'cns', 'C', 0);
INSERT INTO `tp_city` VALUES (4114, 4049, 0, 2, 0, '邵阳市', '湖南省邵阳市', '422000', '', 'sys', 'S', 0);
INSERT INTO `tp_city` VALUES (4115, 4114, 0, 3, 0, '新宁县', '湖南省邵阳市新宁县', '422700', '', 'xnx', 'X', 0);
INSERT INTO `tp_city` VALUES (4116, 4114, 0, 3, 0, '城步苗族自治县', '湖南省邵阳市城步苗族自治县', '422500', '', 'cbmzzzx', 'C', 0);
INSERT INTO `tp_city` VALUES (4117, 4114, 0, 3, 0, '其它区', '湖南省邵阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4118, 4114, 0, 3, 0, '武冈市', '湖南省邵阳市武冈市', '422400', '', 'wgs', 'W', 0);
INSERT INTO `tp_city` VALUES (4119, 4114, 0, 3, 0, '绥宁县', '湖南省邵阳市绥宁县', '422600', '', 'snx', 'S', 0);
INSERT INTO `tp_city` VALUES (4120, 4114, 0, 3, 0, '洞口县', '湖南省邵阳市洞口县', '422300', '', 'dkx', 'D', 0);
INSERT INTO `tp_city` VALUES (4121, 4114, 0, 3, 0, '隆回县', '湖南省邵阳市隆回县', '422200', '', 'lhx', 'L', 0);
INSERT INTO `tp_city` VALUES (4122, 4114, 0, 3, 0, '邵阳县', '湖南省邵阳市邵阳县', '422100', '', 'syx', 'S', 0);
INSERT INTO `tp_city` VALUES (4123, 4114, 0, 3, 0, '新邵县', '湖南省邵阳市新邵县', '422900', '', 'xsx', 'X', 0);
INSERT INTO `tp_city` VALUES (4124, 4114, 0, 3, 0, '邵东县', '湖南省邵阳市邵东县', '422800', '', 'sdx', 'S', 0);
INSERT INTO `tp_city` VALUES (4125, 4114, 0, 3, 0, '双清区', '湖南省邵阳市双清区', '422001', '', 'sqq', 'S', 0);
INSERT INTO `tp_city` VALUES (4126, 4114, 0, 3, 0, '大祥区', '湖南省邵阳市大祥区', '422000', '', 'dxq', 'D', 0);
INSERT INTO `tp_city` VALUES (4127, 4114, 0, 3, 0, '北塔区', '湖南省邵阳市北塔区', '422001', '', 'btq', 'B', 0);
INSERT INTO `tp_city` VALUES (4128, 4049, 0, 2, 0, '常德市', '湖南省常德市', '415000', '', 'cds', 'C', 0);
INSERT INTO `tp_city` VALUES (4129, 4128, 0, 3, 0, '鼎城区', '湖南省常德市鼎城区', '415100', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (4130, 4128, 0, 3, 0, '武陵区', '湖南省常德市武陵区', '415000', '', 'wlq', 'W', 0);
INSERT INTO `tp_city` VALUES (4131, 4128, 0, 3, 0, '津市市', '湖南省常德市津市市', '415400', '', 'jss', 'J', 0);
INSERT INTO `tp_city` VALUES (4132, 4128, 0, 3, 0, '其它区', '湖南省常德市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4133, 4128, 0, 3, 0, '汉寿县', '湖南省常德市汉寿县', '415900', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (4134, 4128, 0, 3, 0, '澧县', '湖南省常德市澧县', '415500', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (4135, 4128, 0, 3, 0, '安乡县', '湖南省常德市安乡县', '415600', '', 'axx', 'A', 0);
INSERT INTO `tp_city` VALUES (4136, 4128, 0, 3, 0, '石门县', '湖南省常德市石门县', '415300', '', 'smx', 'S', 0);
INSERT INTO `tp_city` VALUES (4137, 4128, 0, 3, 0, '临澧县', '湖南省常德市临澧县', '415200', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (4138, 4128, 0, 3, 0, '桃源县', '湖南省常德市桃源县', '415700', '', 'tyx', 'T', 0);
INSERT INTO `tp_city` VALUES (4139, 4049, 0, 2, 0, '岳阳市', '湖南省岳阳市', '414000', '', 'yys', 'Y', 0);
INSERT INTO `tp_city` VALUES (4140, 4139, 0, 3, 0, '临湘市', '湖南省岳阳市临湘市', '414300', '', 'lxs', 'L', 0);
INSERT INTO `tp_city` VALUES (4141, 4139, 0, 3, 0, '其它区', '湖南省岳阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4142, 4139, 0, 3, 0, '汨罗市', '湖南省岳阳市汨罗市', '414400', '', 'ls', 'Z', 0);
INSERT INTO `tp_city` VALUES (4143, 4139, 0, 3, 0, '湘阴县', '湖南省岳阳市湘阴县', '414600', '', 'xyx', 'X', 0);
INSERT INTO `tp_city` VALUES (4144, 4139, 0, 3, 0, '平江县', '湖南省岳阳市平江县', '410400', '', 'pjx', 'P', 0);
INSERT INTO `tp_city` VALUES (4145, 4139, 0, 3, 0, '云溪区', '湖南省岳阳市云溪区', '414003', '', 'yxq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4146, 4139, 0, 3, 0, '岳阳楼区', '湖南省岳阳市岳阳楼区', '414000', '', 'yylq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4147, 4139, 0, 3, 0, '华容县', '湖南省岳阳市华容县', '414200', '', 'hrx', 'H', 0);
INSERT INTO `tp_city` VALUES (4148, 4139, 0, 3, 0, '岳阳县', '湖南省岳阳市岳阳县', '414100', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4149, 4139, 0, 3, 0, '君山区', '湖南省岳阳市君山区', '414005', '', 'jsq', 'J', 0);
INSERT INTO `tp_city` VALUES (4150, 4049, 0, 2, 0, '张家界市', '湖南省张家界市', '427000', '', 'zjjs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4151, 4150, 0, 3, 0, '慈利县', '湖南省张家界市慈利县', '427200', '', 'clx', 'C', 0);
INSERT INTO `tp_city` VALUES (4152, 4150, 0, 3, 0, '桑植县', '湖南省张家界市桑植县', '427100', '', 'szx', 'S', 0);
INSERT INTO `tp_city` VALUES (4153, 4150, 0, 3, 0, '其它区', '湖南省张家界市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4154, 4150, 0, 3, 0, '永定区', '湖南省张家界市永定区', '427000', '', 'ydq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4155, 4150, 0, 3, 0, '武陵源区', '湖南省张家界市武陵源区', '427400', '', 'wlyq', 'W', 0);
INSERT INTO `tp_city` VALUES (4156, 4049, 0, 2, 0, '益阳市', '湖南省益阳市', '413000', '', 'yys', 'Y', 0);
INSERT INTO `tp_city` VALUES (4157, 4156, 0, 3, 0, '南县', '湖南省益阳市南县', '413200', '', 'nx', 'N', 0);
INSERT INTO `tp_city` VALUES (4158, 4156, 0, 3, 0, '安化县', '湖南省益阳市安化县', '413500', '', 'ahx', 'A', 0);
INSERT INTO `tp_city` VALUES (4159, 4156, 0, 3, 0, '桃江县', '湖南省益阳市桃江县', '413400', '', 'tjx', 'T', 0);
INSERT INTO `tp_city` VALUES (4160, 4156, 0, 3, 0, '资阳区', '湖南省益阳市资阳区', '413000', '', 'zyq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4161, 4156, 0, 3, 0, '赫山区', '湖南省益阳市赫山区', '413002', '', 'hsq', 'H', 0);
INSERT INTO `tp_city` VALUES (4162, 4156, 0, 3, 0, '沅江市', '湖南省益阳市沅江市', '413100', '', 'js', 'Z', 0);
INSERT INTO `tp_city` VALUES (4163, 4156, 0, 3, 0, '其它区', '湖南省益阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4164, 4049, 0, 2, 0, '永州市', '湖南省永州市', '425000', '', 'yzs', 'Y', 0);
INSERT INTO `tp_city` VALUES (4165, 4164, 0, 3, 0, '宁远县', '湖南省永州市宁远县', '425600', '', 'nyx', 'N', 0);
INSERT INTO `tp_city` VALUES (4166, 4164, 0, 3, 0, '蓝山县', '湖南省永州市蓝山县', '425800', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (4167, 4164, 0, 3, 0, '道县', '湖南省永州市道县', '425300', '', 'dx', 'D', 0);
INSERT INTO `tp_city` VALUES (4168, 4164, 0, 3, 0, '江永县', '湖南省永州市江永县', '425400', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (4169, 4164, 0, 3, 0, '东安县', '湖南省永州市东安县', '425900', '', 'dax', 'D', 0);
INSERT INTO `tp_city` VALUES (4170, 4164, 0, 3, 0, '双牌县', '湖南省永州市双牌县', '425200', '', 'spx', 'S', 0);
INSERT INTO `tp_city` VALUES (4171, 4164, 0, 3, 0, '祁阳县', '湖南省永州市祁阳县', '426100', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (4172, 4164, 0, 3, 0, '其它区', '湖南省永州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4173, 4164, 0, 3, 0, '新田县', '湖南省永州市新田县', '425700', '', 'xtx', 'X', 0);
INSERT INTO `tp_city` VALUES (4174, 4164, 0, 3, 0, '江华瑶族自治县', '湖南省永州市江华瑶族自治县', '425500', '', 'jhyzzzx', 'J', 0);
INSERT INTO `tp_city` VALUES (4175, 4164, 0, 3, 0, '冷水滩区', '湖南省永州市冷水滩区', '425000', '', 'lstq', 'L', 0);
INSERT INTO `tp_city` VALUES (4176, 4164, 0, 3, 0, '零陵区', '湖南省永州市零陵区', '425007', '', 'llq', 'L', 0);
INSERT INTO `tp_city` VALUES (4177, 4049, 0, 2, 0, '郴州市', '湖南省郴州市', '423000', '', 'czs', 'C', 0);
INSERT INTO `tp_city` VALUES (4178, 4177, 0, 3, 0, '其它区', '湖南省郴州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4179, 4177, 0, 3, 0, '资兴市', '湖南省郴州市资兴市', '423400', '', 'zxs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4180, 4177, 0, 3, 0, '桂东县', '湖南省郴州市桂东县', '423500', '', 'gdx', 'G', 0);
INSERT INTO `tp_city` VALUES (4181, 4177, 0, 3, 0, '汝城县', '湖南省郴州市汝城县', '424100', '', 'rcx', 'R', 0);
INSERT INTO `tp_city` VALUES (4182, 4177, 0, 3, 0, '临武县', '湖南省郴州市临武县', '424300', '', 'lwx', 'L', 0);
INSERT INTO `tp_city` VALUES (4183, 4177, 0, 3, 0, '嘉禾县', '湖南省郴州市嘉禾县', '424500', '', 'jhx', 'J', 0);
INSERT INTO `tp_city` VALUES (4184, 4177, 0, 3, 0, '安仁县', '湖南省郴州市安仁县', '423600', '', 'arx', 'A', 0);
INSERT INTO `tp_city` VALUES (4185, 4177, 0, 3, 0, '宜章县', '湖南省郴州市宜章县', '424200', '', 'yzx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4186, 4177, 0, 3, 0, '永兴县', '湖南省郴州市永兴县', '423300', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4187, 4177, 0, 3, 0, '桂阳县', '湖南省郴州市桂阳县', '424400', '', 'gyx', 'G', 0);
INSERT INTO `tp_city` VALUES (4188, 4177, 0, 3, 0, '苏仙区', '湖南省郴州市苏仙区', '423000', '', 'sxq', 'S', 0);
INSERT INTO `tp_city` VALUES (4189, 4177, 0, 3, 0, '北湖区', '湖南省郴州市北湖区', '423000', '', 'bhq', 'B', 0);
INSERT INTO `tp_city` VALUES (4190, 4049, 0, 2, 0, '湘西土家族苗族自治州', '湖南省湘西土家族苗族自治州', '416000', '', 'xxtjzmzzzz', 'X', 0);
INSERT INTO `tp_city` VALUES (4191, 4190, 0, 3, 0, '古丈县', '湖南省湘西土家族苗族自治州古丈县', '416300', '', 'gzx', 'G', 0);
INSERT INTO `tp_city` VALUES (4192, 4190, 0, 3, 0, '永顺县', '湖南省湘西土家族苗族自治州永顺县', '416700', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4193, 4190, 0, 3, 0, '花垣县', '湖南省湘西土家族苗族自治州花垣县', '416400', '', 'hyx', 'H', 0);
INSERT INTO `tp_city` VALUES (4194, 4190, 0, 3, 0, '保靖县', '湖南省湘西土家族苗族自治州保靖县', '416500', '', 'bjx', 'B', 0);
INSERT INTO `tp_city` VALUES (4195, 4190, 0, 3, 0, '泸溪县', '湖南省湘西土家族苗族自治州泸溪县', '416100', '', 'xx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4196, 4190, 0, 3, 0, '凤凰县', '湖南省湘西土家族苗族自治州凤凰县', '416200', '', 'fhx', 'F', 0);
INSERT INTO `tp_city` VALUES (4197, 4190, 0, 3, 0, '龙山县', '湖南省湘西土家族苗族自治州龙山县', '416800', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (4198, 4190, 0, 3, 0, '其它区', '湖南省湘西土家族苗族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4199, 4190, 0, 3, 0, '吉首市', '湖南省湘西土家族苗族自治州吉首市', '416000', '', 'jss', 'J', 0);
INSERT INTO `tp_city` VALUES (4200, 0, 0, 1, 0, '甘肃省', '甘肃省', '', '', 'gss', 'G', 0);
INSERT INTO `tp_city` VALUES (4201, 4200, 0, 2, 0, '甘南藏族自治州', '甘肃省甘南藏族自治州', '747000', '', 'gnczzzz', 'G', 0);
INSERT INTO `tp_city` VALUES (4202, 4201, 0, 3, 0, '合作市', '甘肃省甘南藏族自治州合作市', '747000', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (4203, 4201, 0, 3, 0, '临潭县', '甘肃省甘南藏族自治州临潭县', '747500', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (4204, 4201, 0, 3, 0, '舟曲县', '甘肃省甘南藏族自治州舟曲县', '746300', '', 'zqx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4205, 4201, 0, 3, 0, '卓尼县', '甘肃省甘南藏族自治州卓尼县', '747600', '', 'znx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4206, 4201, 0, 3, 0, '迭部县', '甘肃省甘南藏族自治州迭部县', '747400', '', 'dbx', 'D', 0);
INSERT INTO `tp_city` VALUES (4207, 4201, 0, 3, 0, '玛曲县', '甘肃省甘南藏族自治州玛曲县', '747300', '', 'mqx', 'M', 0);
INSERT INTO `tp_city` VALUES (4208, 4201, 0, 3, 0, '碌曲县', '甘肃省甘南藏族自治州碌曲县', '747200', '', 'lqx', 'L', 0);
INSERT INTO `tp_city` VALUES (4209, 4201, 0, 3, 0, '夏河县', '甘肃省甘南藏族自治州夏河县', '747100', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (4210, 4201, 0, 3, 0, '其它区', '甘肃省甘南藏族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4211, 4200, 0, 2, 0, '临夏回族自治州', '甘肃省临夏回族自治州', '', '', 'lxhzzzz', 'L', 0);
INSERT INTO `tp_city` VALUES (4212, 4211, 0, 3, 0, '临夏市', '甘肃省临夏回族自治州临夏市', '731100', '', 'lxs', 'L', 0);
INSERT INTO `tp_city` VALUES (4213, 4211, 0, 3, 0, '东乡族自治县', '甘肃省临夏回族自治州东乡族自治县', '731400', '', 'dxzzzx', 'D', 0);
INSERT INTO `tp_city` VALUES (4214, 4211, 0, 3, 0, '积石山保安族东乡族撒拉族自治县', '甘肃省临夏回族自治州积石山保安族东乡族撒拉族自治县', '731700', '', 'jssbazdxzs', 'J', 0);
INSERT INTO `tp_city` VALUES (4215, 4211, 0, 3, 0, '广河县', '甘肃省临夏回族自治州广河县', '731300', '', 'ghx', 'G', 0);
INSERT INTO `tp_city` VALUES (4216, 4211, 0, 3, 0, '和政县', '甘肃省临夏回族自治州和政县', '731200', '', 'hzx', 'H', 0);
INSERT INTO `tp_city` VALUES (4217, 4211, 0, 3, 0, '康乐县', '甘肃省临夏回族自治州康乐县', '731500', '', 'klx', 'K', 0);
INSERT INTO `tp_city` VALUES (4218, 4211, 0, 3, 0, '永靖县', '甘肃省临夏回族自治州永靖县', '731600', '', 'yjx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4219, 4211, 0, 3, 0, '临夏县', '甘肃省临夏回族自治州临夏县', '731800', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (4220, 4211, 0, 3, 0, '其它区', '甘肃省临夏回族自治州其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4221, 4200, 0, 2, 0, '金昌市', '甘肃省金昌市', '737100', '', 'jcs', 'J', 0);
INSERT INTO `tp_city` VALUES (4222, 4221, 0, 3, 0, '金川区', '甘肃省金昌市金川区', '737103', '', 'jcq', 'J', 0);
INSERT INTO `tp_city` VALUES (4223, 4221, 0, 3, 0, '其它区', '甘肃省金昌市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4224, 4221, 0, 3, 0, '永昌县', '甘肃省金昌市永昌县', '737200', '', 'ycx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4225, 4200, 0, 2, 0, '白银市', '甘肃省白银市', '', '', 'bys', 'B', 0);
INSERT INTO `tp_city` VALUES (4226, 4225, 0, 3, 0, '白银区', '甘肃省白银市白银区', '730900', '', 'byq', 'B', 0);
INSERT INTO `tp_city` VALUES (4227, 4225, 0, 3, 0, '平川区', '甘肃省白银市平川区', '730910', '', 'pcq', 'P', 0);
INSERT INTO `tp_city` VALUES (4228, 4225, 0, 3, 0, '其它区', '甘肃省白银市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4229, 4225, 0, 3, 0, '靖远县', '甘肃省白银市靖远县', '730600', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (4230, 4225, 0, 3, 0, '会宁县', '甘肃省白银市会宁县', '730700', '', 'hnx', 'H', 0);
INSERT INTO `tp_city` VALUES (4231, 4225, 0, 3, 0, '景泰县', '甘肃省白银市景泰县', '730400', '', 'jtx', 'J', 0);
INSERT INTO `tp_city` VALUES (4232, 4200, 0, 2, 0, '天水市', '甘肃省天水市', '', '', 'tss', 'T', 0);
INSERT INTO `tp_city` VALUES (4233, 4232, 0, 3, 0, '麦积区', '甘肃省天水市麦积区', '741020', '', 'mjq', 'M', 0);
INSERT INTO `tp_city` VALUES (4234, 4232, 0, 3, 0, '秦州区', '甘肃省天水市秦州区', '741000', '', 'qzq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4235, 4232, 0, 3, 0, '其它区', '甘肃省天水市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4236, 4232, 0, 3, 0, '武山县', '甘肃省天水市武山县', '741300', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (4237, 4232, 0, 3, 0, '张家川回族自治县', '甘肃省天水市张家川回族自治县', '741500', '', 'zjchzzzx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4238, 4232, 0, 3, 0, '秦安县', '甘肃省天水市秦安县', '741600', '', 'qax', 'Q', 0);
INSERT INTO `tp_city` VALUES (4239, 4232, 0, 3, 0, '甘谷县', '甘肃省天水市甘谷县', '741200', '', 'ggx', 'G', 0);
INSERT INTO `tp_city` VALUES (4240, 4232, 0, 3, 0, '清水县', '甘肃省天水市清水县', '741400', '', 'qsx', 'Q', 0);
INSERT INTO `tp_city` VALUES (4241, 4200, 0, 2, 0, '兰州市', '甘肃省兰州市', '730000', '', 'lzs', 'L', 0);
INSERT INTO `tp_city` VALUES (4242, 4241, 0, 3, 0, '其它区', '甘肃省兰州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4243, 4241, 0, 3, 0, '皋兰县', '甘肃省兰州市皋兰县', '730200', '', 'glx', 'G', 0);
INSERT INTO `tp_city` VALUES (4244, 4241, 0, 3, 0, '榆中县', '甘肃省兰州市榆中县', '730100', '', 'yzx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4245, 4241, 0, 3, 0, '永登县', '甘肃省兰州市永登县', '730300', '', 'ydx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4246, 4241, 0, 3, 0, '七里河区', '甘肃省兰州市七里河区', '730050', '', 'qlhq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4247, 4241, 0, 3, 0, '城关区', '甘肃省兰州市城关区', '730030', '', 'cgq', 'C', 0);
INSERT INTO `tp_city` VALUES (4248, 4241, 0, 3, 0, '红古区', '甘肃省兰州市红古区', '730080', '', 'hgq', 'H', 0);
INSERT INTO `tp_city` VALUES (4249, 4241, 0, 3, 0, '安宁区', '甘肃省兰州市安宁区', '730070', '', 'anq', 'A', 0);
INSERT INTO `tp_city` VALUES (4250, 4241, 0, 3, 0, '西固区', '甘肃省兰州市西固区', '730060', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (4251, 4200, 0, 2, 0, '嘉峪关市', '甘肃省嘉峪关市', '735100', '', 'jygs', 'J', 0);
INSERT INTO `tp_city` VALUES (4252, 4251, 0, 3, 0, '新城镇', '甘肃省嘉峪关市新城镇', '', '', 'xcz', 'X', 0);
INSERT INTO `tp_city` VALUES (4253, 4251, 0, 3, 0, '峪泉镇', '甘肃省嘉峪关市峪泉镇', '', '', 'yqz', 'Y', 0);
INSERT INTO `tp_city` VALUES (4254, 4251, 0, 3, 0, '文殊镇', '甘肃省嘉峪关市文殊镇', '', '', 'wsz', 'W', 0);
INSERT INTO `tp_city` VALUES (4255, 4251, 0, 3, 0, '雄关区', '甘肃省嘉峪关市雄关区', '', '', 'xgq', 'X', 0);
INSERT INTO `tp_city` VALUES (4256, 4251, 0, 3, 0, '镜铁区', '甘肃省嘉峪关市镜铁区', '', '', 'jtq', 'J', 0);
INSERT INTO `tp_city` VALUES (4257, 4251, 0, 3, 0, '长城区', '甘肃省嘉峪关市长城区', '', '', 'ccq', 'C', 0);
INSERT INTO `tp_city` VALUES (4258, 4200, 0, 2, 0, '庆阳市', '甘肃省庆阳市', '', '', 'qys', 'Q', 0);
INSERT INTO `tp_city` VALUES (4259, 4258, 0, 3, 0, '宁县', '甘肃省庆阳市宁县', '745200', '', 'nx', 'N', 0);
INSERT INTO `tp_city` VALUES (4260, 4258, 0, 3, 0, '镇原县', '甘肃省庆阳市镇原县', '744500', '', 'zyx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4261, 4258, 0, 3, 0, '合水县', '甘肃省庆阳市合水县', '745400', '', 'hsx', 'H', 0);
INSERT INTO `tp_city` VALUES (4262, 4258, 0, 3, 0, '正宁县', '甘肃省庆阳市正宁县', '745300', '', 'znx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4263, 4258, 0, 3, 0, '其它区', '甘肃省庆阳市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4264, 4258, 0, 3, 0, '庆城县', '甘肃省庆阳市庆城县', '745100', '', 'qcx', 'Q', 0);
INSERT INTO `tp_city` VALUES (4265, 4258, 0, 3, 0, '华池县', '甘肃省庆阳市华池县', '745600', '', 'hcx', 'H', 0);
INSERT INTO `tp_city` VALUES (4266, 4258, 0, 3, 0, '环县', '甘肃省庆阳市环县', '745700', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (4267, 4258, 0, 3, 0, '西峰区', '甘肃省庆阳市西峰区', '745000', '', 'xfq', 'X', 0);
INSERT INTO `tp_city` VALUES (4268, 4200, 0, 2, 0, '酒泉市', '甘肃省酒泉市', '735000', '', 'jqs', 'J', 0);
INSERT INTO `tp_city` VALUES (4269, 4268, 0, 3, 0, '其它区', '甘肃省酒泉市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4270, 4268, 0, 3, 0, '敦煌市', '甘肃省酒泉市敦煌市', '736200', '', 'dhs', 'D', 0);
INSERT INTO `tp_city` VALUES (4271, 4268, 0, 3, 0, '玉门市', '甘肃省酒泉市玉门市', '735200', '', 'yms', 'Y', 0);
INSERT INTO `tp_city` VALUES (4272, 4268, 0, 3, 0, '瓜州县', '甘肃省酒泉市瓜州县', '743000', '', 'gzx', 'G', 0);
INSERT INTO `tp_city` VALUES (4273, 4268, 0, 3, 0, '肃北蒙古族自治县', '甘肃省酒泉市肃北蒙古族自治县', '736300', '', 'sbmgzzzx', 'S', 0);
INSERT INTO `tp_city` VALUES (4274, 4268, 0, 3, 0, '金塔县', '甘肃省酒泉市金塔县', '735300', '', 'jtx', 'J', 0);
INSERT INTO `tp_city` VALUES (4275, 4268, 0, 3, 0, '阿克塞哈萨克族自治县', '甘肃省酒泉市阿克塞哈萨克族自治县', '736400', '', 'akshskzzzx', 'A', 0);
INSERT INTO `tp_city` VALUES (4276, 4268, 0, 3, 0, '肃州区', '甘肃省酒泉市肃州区', '735000', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (4277, 4200, 0, 2, 0, '平凉市', '甘肃省平凉市', '744000', '', 'pls', 'P', 0);
INSERT INTO `tp_city` VALUES (4278, 4277, 0, 3, 0, '华亭县', '甘肃省平凉市华亭县', '744100', '', 'htx', 'H', 0);
INSERT INTO `tp_city` VALUES (4279, 4277, 0, 3, 0, '庄浪县', '甘肃省平凉市庄浪县', '744600', '', 'zlx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4280, 4277, 0, 3, 0, '静宁县', '甘肃省平凉市静宁县', '743400', '', 'jnx', 'J', 0);
INSERT INTO `tp_city` VALUES (4281, 4277, 0, 3, 0, '其它区', '甘肃省平凉市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4282, 4277, 0, 3, 0, '泾川县', '甘肃省平凉市泾川县', '744300', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4283, 4277, 0, 3, 0, '灵台县', '甘肃省平凉市灵台县', '744400', '', 'ltx', 'L', 0);
INSERT INTO `tp_city` VALUES (4284, 4277, 0, 3, 0, '崇信县', '甘肃省平凉市崇信县', '744200', '', 'cxx', 'C', 0);
INSERT INTO `tp_city` VALUES (4285, 4277, 0, 3, 0, '崆峒区', '甘肃省平凉市崆峒区', '744000', '', 'q', 'Z', 0);
INSERT INTO `tp_city` VALUES (4286, 4200, 0, 2, 0, '张掖市', '甘肃省张掖市', '734000', '', 'zys', 'Z', 0);
INSERT INTO `tp_city` VALUES (4287, 4286, 0, 3, 0, '山丹县', '甘肃省张掖市山丹县', '734100', '', 'sdx', 'S', 0);
INSERT INTO `tp_city` VALUES (4288, 4286, 0, 3, 0, '高台县', '甘肃省张掖市高台县', '734300', '', 'gtx', 'G', 0);
INSERT INTO `tp_city` VALUES (4289, 4286, 0, 3, 0, '其它区', '甘肃省张掖市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4290, 4286, 0, 3, 0, '肃南裕固族自治县', '甘肃省张掖市肃南裕固族自治县', '734400', '', 'snygzzzx', 'S', 0);
INSERT INTO `tp_city` VALUES (4291, 4286, 0, 3, 0, '临泽县', '甘肃省张掖市临泽县', '734200', '', 'lzx', 'L', 0);
INSERT INTO `tp_city` VALUES (4292, 4286, 0, 3, 0, '民乐县', '甘肃省张掖市民乐县', '734500', '', 'mlx', 'M', 0);
INSERT INTO `tp_city` VALUES (4293, 4286, 0, 3, 0, '甘州区', '甘肃省张掖市甘州区', '734000', '', 'gzq', 'G', 0);
INSERT INTO `tp_city` VALUES (4294, 4200, 0, 2, 0, '武威市', '甘肃省武威市', '733000', '', 'wws', 'W', 0);
INSERT INTO `tp_city` VALUES (4295, 4294, 0, 3, 0, '天祝藏族自治县', '甘肃省武威市天祝藏族自治县', '733200', '', 'tzczzzx', 'T', 0);
INSERT INTO `tp_city` VALUES (4296, 4294, 0, 3, 0, '古浪县', '甘肃省武威市古浪县', '733100', '', 'glx', 'G', 0);
INSERT INTO `tp_city` VALUES (4297, 4294, 0, 3, 0, '民勤县', '甘肃省武威市民勤县', '733300', '', 'mqx', 'M', 0);
INSERT INTO `tp_city` VALUES (4298, 4294, 0, 3, 0, '其它区', '甘肃省武威市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4299, 4294, 0, 3, 0, '凉州区', '甘肃省武威市凉州区', '733000', '', 'lzq', 'L', 0);
INSERT INTO `tp_city` VALUES (4300, 4200, 0, 2, 0, '陇南市', '甘肃省陇南市', '', '', 'lns', 'L', 0);
INSERT INTO `tp_city` VALUES (4301, 4300, 0, 3, 0, '武都区', '甘肃省陇南市武都区', '746000', '', 'wdq', 'W', 0);
INSERT INTO `tp_city` VALUES (4302, 4300, 0, 3, 0, '成县', '甘肃省陇南市成县', '742500', '', 'cx', 'C', 0);
INSERT INTO `tp_city` VALUES (4303, 4300, 0, 3, 0, '文县', '甘肃省陇南市文县', '746400', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (4304, 4300, 0, 3, 0, '宕昌县', '甘肃省陇南市宕昌县', '748500', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4305, 4300, 0, 3, 0, '康县', '甘肃省陇南市康县', '746500', '', 'kx', 'K', 0);
INSERT INTO `tp_city` VALUES (4306, 4300, 0, 3, 0, '西和县', '甘肃省陇南市西和县', '742100', '', 'xhx', 'X', 0);
INSERT INTO `tp_city` VALUES (4307, 4300, 0, 3, 0, '礼县', '甘肃省陇南市礼县', '742200', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (4308, 4300, 0, 3, 0, '徽县', '甘肃省陇南市徽县', '742300', '', 'hx', 'H', 0);
INSERT INTO `tp_city` VALUES (4309, 4300, 0, 3, 0, '两当县', '甘肃省陇南市两当县', '742400', '', 'ldx', 'L', 0);
INSERT INTO `tp_city` VALUES (4310, 4300, 0, 3, 0, '其它区', '甘肃省陇南市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4311, 4200, 0, 2, 0, '定西市', '甘肃省定西市', '743000', '', 'dxs', 'D', 0);
INSERT INTO `tp_city` VALUES (4312, 4311, 0, 3, 0, '其它区', '甘肃省定西市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4313, 4311, 0, 3, 0, '岷县', '甘肃省定西市岷县', '748400', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (4314, 4311, 0, 3, 0, '漳县', '甘肃省定西市漳县', '748300', '', 'zx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4315, 4311, 0, 3, 0, '临洮县', '甘肃省定西市临洮县', '730500', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (4316, 4311, 0, 3, 0, '渭源县', '甘肃省定西市渭源县', '748200', '', 'wyx', 'W', 0);
INSERT INTO `tp_city` VALUES (4317, 4311, 0, 3, 0, '陇西县', '甘肃省定西市陇西县', '748100', '', 'lxx', 'L', 0);
INSERT INTO `tp_city` VALUES (4318, 4311, 0, 3, 0, '通渭县', '甘肃省定西市通渭县', '743300', '', 'twx', 'T', 0);
INSERT INTO `tp_city` VALUES (4319, 4311, 0, 3, 0, '安定区', '甘肃省定西市安定区', '743000', '', 'adq', 'A', 0);
INSERT INTO `tp_city` VALUES (4320, 0, 0, 1, 0, '山东省', '山东省', '', '', 'sds', 'S', 0);
INSERT INTO `tp_city` VALUES (4321, 4320, 0, 2, 0, '济南市', '山东省济南市', '250000', '', 'jns', 'J', 0);
INSERT INTO `tp_city` VALUES (4322, 4321, 0, 3, 0, '平阴县', '山东省济南市平阴县', '250400', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (4323, 4321, 0, 3, 0, '济阳县', '山东省济南市济阳县', '251400', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (4324, 4321, 0, 3, 0, '商河县', '山东省济南市商河县', '251600', '', 'shx', 'S', 0);
INSERT INTO `tp_city` VALUES (4325, 4321, 0, 3, 0, '历城区', '山东省济南市历城区', '250100', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (4326, 4321, 0, 3, 0, '长清区', '山东省济南市长清区', '250300', '', 'cqq', 'C', 0);
INSERT INTO `tp_city` VALUES (4327, 4321, 0, 3, 0, '天桥区', '山东省济南市天桥区', '250031', '', 'tqq', 'T', 0);
INSERT INTO `tp_city` VALUES (4328, 4321, 0, 3, 0, '槐荫区', '山东省济南市槐荫区', '250021', '', 'hyq', 'H', 0);
INSERT INTO `tp_city` VALUES (4329, 4321, 0, 3, 0, '市中区', '山东省济南市市中区', '250002', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (4330, 4321, 0, 3, 0, '历下区', '山东省济南市历下区', '250013', '', 'lxq', 'L', 0);
INSERT INTO `tp_city` VALUES (4331, 4321, 0, 3, 0, '其它区', '山东省济南市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4332, 4321, 0, 3, 0, '章丘市', '山东省济南市章丘市', '250200', '', 'zqs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4333, 4320, 0, 2, 0, '东营市', '山东省东营市', '257000', '', 'dys', 'D', 0);
INSERT INTO `tp_city` VALUES (4334, 4333, 0, 3, 0, '河口区', '山东省东营市河口区', '257200', '', 'hkq', 'H', 0);
INSERT INTO `tp_city` VALUES (4335, 4333, 0, 3, 0, '东营区', '山东省东营市东营区', '257029', '', 'dyq', 'D', 0);
INSERT INTO `tp_city` VALUES (4336, 4333, 0, 3, 0, '垦利县', '山东省东营市垦利县', '257500', '', 'klx', 'K', 0);
INSERT INTO `tp_city` VALUES (4337, 4333, 0, 3, 0, '利津县', '山东省东营市利津县', '257400', '', 'ljx', 'L', 0);
INSERT INTO `tp_city` VALUES (4338, 4333, 0, 3, 0, '广饶县', '山东省东营市广饶县', '257300', '', 'grx', 'G', 0);
INSERT INTO `tp_city` VALUES (4339, 4333, 0, 3, 0, '西城区', '山东省东营市西城区', '', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (4340, 4333, 0, 3, 0, '其它区', '山东省东营市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4341, 4333, 0, 3, 0, '东城区', '山东省东营市东城区', '', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (4342, 4320, 0, 2, 0, '烟台市', '山东省烟台市', '264000', '', 'yts', 'Y', 0);
INSERT INTO `tp_city` VALUES (4343, 4342, 0, 3, 0, '海阳市', '山东省烟台市海阳市', '265100', '', 'hys', 'H', 0);
INSERT INTO `tp_city` VALUES (4344, 4342, 0, 3, 0, '栖霞市', '山东省烟台市栖霞市', '265300', '', 'qxs', 'Q', 0);
INSERT INTO `tp_city` VALUES (4345, 4342, 0, 3, 0, '招远市', '山东省烟台市招远市', '265400', '', 'zys', 'Z', 0);
INSERT INTO `tp_city` VALUES (4346, 4342, 0, 3, 0, '蓬莱市', '山东省烟台市蓬莱市', '265600', '', 'pls', 'P', 0);
INSERT INTO `tp_city` VALUES (4347, 4342, 0, 3, 0, '莱州市', '山东省烟台市莱州市', '261400', '', 'lzs', 'L', 0);
INSERT INTO `tp_city` VALUES (4348, 4342, 0, 3, 0, '莱阳市', '山东省烟台市莱阳市', '265200', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (4349, 4342, 0, 3, 0, '龙口市', '山东省烟台市龙口市', '265700', '', 'lks', 'L', 0);
INSERT INTO `tp_city` VALUES (4350, 4342, 0, 3, 0, '长岛县', '山东省烟台市长岛县', '265800', '', 'cdx', 'C', 0);
INSERT INTO `tp_city` VALUES (4351, 4342, 0, 3, 0, '芝罘区', '山东省烟台市芝罘区', '264001', '', 'zq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4352, 4342, 0, 3, 0, '福山区', '山东省烟台市福山区', '265500', '', 'fsq', 'F', 0);
INSERT INTO `tp_city` VALUES (4353, 4342, 0, 3, 0, '莱山区', '山东省烟台市莱山区', '264600', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (4354, 4342, 0, 3, 0, '牟平区', '山东省烟台市牟平区', '264100', '', 'mpq', 'M', 0);
INSERT INTO `tp_city` VALUES (4355, 4342, 0, 3, 0, '其它区', '山东省烟台市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4356, 4320, 0, 2, 0, '淄博市', '山东省淄博市', '255000', '', 'zbs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4357, 4356, 0, 3, 0, '淄川区', '山东省淄博市淄川区', '255100', '', 'zcq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4358, 4356, 0, 3, 0, '张店区', '山东省淄博市张店区', '255022', '', 'zdq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4359, 4356, 0, 3, 0, '沂源县', '山东省淄博市沂源县', '256100', '', 'yyx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4360, 4356, 0, 3, 0, '高青县', '山东省淄博市高青县', '256300', '', 'gqx', 'G', 0);
INSERT INTO `tp_city` VALUES (4361, 4356, 0, 3, 0, '桓台县', '山东省淄博市桓台县', '256400', '', 'htx', 'H', 0);
INSERT INTO `tp_city` VALUES (4362, 4356, 0, 3, 0, '其它区', '山东省淄博市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4363, 4356, 0, 3, 0, '周村区', '山东省淄博市周村区', '255300', '', 'zcq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4364, 4356, 0, 3, 0, '博山区', '山东省淄博市博山区', '255200', '', 'bsq', 'B', 0);
INSERT INTO `tp_city` VALUES (4365, 4356, 0, 3, 0, '临淄区', '山东省淄博市临淄区', '255400', '', 'lzq', 'L', 0);
INSERT INTO `tp_city` VALUES (4366, 4320, 0, 2, 0, '青岛市', '山东省青岛市', '266000', '', 'qds', 'Q', 0);
INSERT INTO `tp_city` VALUES (4367, 4366, 0, 3, 0, '莱西市', '山东省青岛市莱西市', '266600', '', 'lxs', 'L', 0);
INSERT INTO `tp_city` VALUES (4368, 4366, 0, 3, 0, '胶南市', '山东省青岛市胶南市', '266400', '', 'jns', 'J', 0);
INSERT INTO `tp_city` VALUES (4369, 4366, 0, 3, 0, '其它区', '山东省青岛市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4370, 4366, 0, 3, 0, '胶州市', '山东省青岛市胶州市', '266300', '', 'jzs', 'J', 0);
INSERT INTO `tp_city` VALUES (4371, 4366, 0, 3, 0, '平度市', '山东省青岛市平度市', '266700', '', 'pds', 'P', 0);
INSERT INTO `tp_city` VALUES (4372, 4366, 0, 3, 0, '即墨市', '山东省青岛市即墨市', '266200', '', 'jms', 'J', 0);
INSERT INTO `tp_city` VALUES (4373, 4366, 0, 3, 0, '开发区', '山东省青岛市开发区', '', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (4374, 4366, 0, 3, 0, '黄岛区', '山东省青岛市黄岛区', '266500', '', 'hdq', 'H', 0);
INSERT INTO `tp_city` VALUES (4375, 4366, 0, 3, 0, '李沧区', '山东省青岛市李沧区', '266100', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (4376, 4366, 0, 3, 0, '崂山区', '山东省青岛市崂山区', '266100', '', 'sq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4377, 4366, 0, 3, 0, '城阳区', '山东省青岛市城阳区', '266041', '', 'cyq', 'C', 0);
INSERT INTO `tp_city` VALUES (4378, 4366, 0, 3, 0, '市南区', '山东省青岛市市南区', '266001', '', 'snq', 'S', 0);
INSERT INTO `tp_city` VALUES (4379, 4366, 0, 3, 0, '市北区', '山东省青岛市市北区', '266011', '', 'sbq', 'S', 0);
INSERT INTO `tp_city` VALUES (4380, 4366, 0, 3, 0, '四方区', '山东省青岛市四方区', '266031', '', 'sfq', 'S', 0);
INSERT INTO `tp_city` VALUES (4381, 4320, 0, 2, 0, '枣庄市', '山东省枣庄市', '277100', '', 'zzs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4382, 4381, 0, 3, 0, '其它区', '山东省枣庄市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4383, 4381, 0, 3, 0, '滕州市', '山东省枣庄市滕州市', '277500', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4384, 4381, 0, 3, 0, '峄城区', '山东省枣庄市峄城区', '277300', '', 'cq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4385, 4381, 0, 3, 0, '台儿庄区', '山东省枣庄市台儿庄区', '277400', '', 'tezq', 'T', 0);
INSERT INTO `tp_city` VALUES (4386, 4381, 0, 3, 0, '山亭区', '山东省枣庄市山亭区', '277200', '', 'stq', 'S', 0);
INSERT INTO `tp_city` VALUES (4387, 4381, 0, 3, 0, '市中区', '山东省枣庄市市中区', '277101', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (4388, 4381, 0, 3, 0, '薛城区', '山东省枣庄市薛城区', '277000', '', 'xcq', 'X', 0);
INSERT INTO `tp_city` VALUES (4389, 4320, 0, 2, 0, '日照市', '山东省日照市', '276800', '', 'rzs', 'R', 0);
INSERT INTO `tp_city` VALUES (4390, 4389, 0, 3, 0, '岚山区', '山东省日照市岚山区', '276808', '', 'sq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4391, 4389, 0, 3, 0, '东港区', '山东省日照市东港区', '276800', '', 'dgq', 'D', 0);
INSERT INTO `tp_city` VALUES (4392, 4389, 0, 3, 0, '其它区', '山东省日照市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4393, 4389, 0, 3, 0, '莒县', '山东省日照市莒县', '276500', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (4394, 4389, 0, 3, 0, '五莲县', '山东省日照市五莲县', '262300', '', 'wlx', 'W', 0);
INSERT INTO `tp_city` VALUES (4395, 4320, 0, 2, 0, '威海市', '山东省威海市', '264200', '', 'whs', 'W', 0);
INSERT INTO `tp_city` VALUES (4396, 4395, 0, 3, 0, '其它区', '山东省威海市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4397, 4395, 0, 3, 0, '文登市', '山东省威海市文登市', '264400', '', 'wds', 'W', 0);
INSERT INTO `tp_city` VALUES (4398, 4395, 0, 3, 0, '荣成市', '山东省威海市荣成市', '264300', '', 'rcs', 'R', 0);
INSERT INTO `tp_city` VALUES (4399, 4395, 0, 3, 0, '乳山市', '山东省威海市乳山市', '264500', '', 'rss', 'R', 0);
INSERT INTO `tp_city` VALUES (4400, 4395, 0, 3, 0, '环翠区', '山东省威海市环翠区', '264200', '', 'hcq', 'H', 0);
INSERT INTO `tp_city` VALUES (4401, 4320, 0, 2, 0, '泰安市', '山东省泰安市', '271000', '', 'tas', 'T', 0);
INSERT INTO `tp_city` VALUES (4402, 4401, 0, 3, 0, '其它区', '山东省泰安市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4403, 4401, 0, 3, 0, '肥城市', '山东省泰安市肥城市', '271600', '', 'fcs', 'F', 0);
INSERT INTO `tp_city` VALUES (4404, 4401, 0, 3, 0, '新泰市', '山东省泰安市新泰市', '271200', '', 'xts', 'X', 0);
INSERT INTO `tp_city` VALUES (4405, 4401, 0, 3, 0, '岱岳区', '山东省泰安市岱岳区', '271000', '', 'yq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4406, 4401, 0, 3, 0, '泰山区', '山东省泰安市泰山区', '271000', '', 'tsq', 'T', 0);
INSERT INTO `tp_city` VALUES (4407, 4401, 0, 3, 0, '宁阳县', '山东省泰安市宁阳县', '271400', '', 'nyx', 'N', 0);
INSERT INTO `tp_city` VALUES (4408, 4401, 0, 3, 0, '东平县', '山东省泰安市东平县', '271500', '', 'dpx', 'D', 0);
INSERT INTO `tp_city` VALUES (4409, 4320, 0, 2, 0, '潍坊市', '山东省潍坊市', '261000', '', 'wfs', 'W', 0);
INSERT INTO `tp_city` VALUES (4410, 4409, 0, 3, 0, '寒亭区', '山东省潍坊市寒亭区', '261100', '', 'htq', 'H', 0);
INSERT INTO `tp_city` VALUES (4411, 4409, 0, 3, 0, '潍城区', '山东省潍坊市潍城区', '261021', '', 'wcq', 'W', 0);
INSERT INTO `tp_city` VALUES (4412, 4409, 0, 3, 0, '坊子区', '山东省潍坊市坊子区', '261200', '', 'fzq', 'F', 0);
INSERT INTO `tp_city` VALUES (4413, 4409, 0, 3, 0, '奎文区', '山东省潍坊市奎文区', '261041', '', 'kwq', 'K', 0);
INSERT INTO `tp_city` VALUES (4414, 4409, 0, 3, 0, '昌乐县', '山东省潍坊市昌乐县', '262400', '', 'clx', 'C', 0);
INSERT INTO `tp_city` VALUES (4415, 4409, 0, 3, 0, '临朐县', '山东省潍坊市临朐县', '262600', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (4416, 4409, 0, 3, 0, '开发区', '山东省潍坊市开发区', '', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (4417, 4409, 0, 3, 0, '诸城市', '山东省潍坊市诸城市', '262200', '', 'zcs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4418, 4409, 0, 3, 0, '寿光市', '山东省潍坊市寿光市', '262700', '', 'sgs', 'S', 0);
INSERT INTO `tp_city` VALUES (4419, 4409, 0, 3, 0, '青州市', '山东省潍坊市青州市', '262500', '', 'qzs', 'Q', 0);
INSERT INTO `tp_city` VALUES (4420, 4409, 0, 3, 0, '高密市', '山东省潍坊市高密市', '261500', '', 'gms', 'G', 0);
INSERT INTO `tp_city` VALUES (4421, 4409, 0, 3, 0, '安丘市', '山东省潍坊市安丘市', '262100', '', 'aqs', 'A', 0);
INSERT INTO `tp_city` VALUES (4422, 4409, 0, 3, 0, '其它区', '山东省潍坊市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4423, 4409, 0, 3, 0, '昌邑市', '山东省潍坊市昌邑市', '261300', '', 'cys', 'C', 0);
INSERT INTO `tp_city` VALUES (4424, 4320, 0, 2, 0, '济宁市', '山东省济宁市', '272100', '', 'jns', 'J', 0);
INSERT INTO `tp_city` VALUES (4425, 4424, 0, 3, 0, '汶上县', '山东省济宁市汶上县', '272501', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4426, 4424, 0, 3, 0, '泗水县', '山东省济宁市泗水县', '273200', '', 'sx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4427, 4424, 0, 3, 0, '金乡县', '山东省济宁市金乡县', '272200', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (4428, 4424, 0, 3, 0, '嘉祥县', '山东省济宁市嘉祥县', '272400', '', 'jxx', 'J', 0);
INSERT INTO `tp_city` VALUES (4429, 4424, 0, 3, 0, '微山县', '山东省济宁市微山县', '277600', '', 'wsx', 'W', 0);
INSERT INTO `tp_city` VALUES (4430, 4424, 0, 3, 0, '鱼台县', '山东省济宁市鱼台县', '272300', '', 'ytx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4431, 4424, 0, 3, 0, '梁山县', '山东省济宁市梁山县', '272600', '', 'lsx', 'L', 0);
INSERT INTO `tp_city` VALUES (4432, 4424, 0, 3, 0, '兖州市', '山东省济宁市兖州市', '272000', '', 'zs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4433, 4424, 0, 3, 0, '邹城市', '山东省济宁市邹城市', '273500', '', 'zcs', 'Z', 0);
INSERT INTO `tp_city` VALUES (4434, 4424, 0, 3, 0, '曲阜市', '山东省济宁市曲阜市', '273100', '', 'qfs', 'Q', 0);
INSERT INTO `tp_city` VALUES (4435, 4424, 0, 3, 0, '其它区', '山东省济宁市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4436, 4424, 0, 3, 0, '任城区', '山东省济宁市任城区', '272113', '', 'rcq', 'R', 0);
INSERT INTO `tp_city` VALUES (4437, 4424, 0, 3, 0, '市中区', '山东省济宁市市中区', '272133', '', 'szq', 'S', 0);
INSERT INTO `tp_city` VALUES (4438, 4320, 0, 2, 0, '滨州市', '山东省滨州市', '256600', '', 'bzs', 'B', 0);
INSERT INTO `tp_city` VALUES (4439, 4438, 0, 3, 0, '阳信县', '山东省滨州市阳信县', '251800', '', 'yxx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4440, 4438, 0, 3, 0, '无棣县', '山东省滨州市无棣县', '251900', '', 'wx', 'W', 0);
INSERT INTO `tp_city` VALUES (4441, 4438, 0, 3, 0, '惠民县', '山东省滨州市惠民县', '257100', '', 'hmx', 'H', 0);
INSERT INTO `tp_city` VALUES (4442, 4438, 0, 3, 0, '邹平县', '山东省滨州市邹平县', '256200', '', 'zpx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4443, 4438, 0, 3, 0, '其它区', '山东省滨州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4444, 4438, 0, 3, 0, '沾化县', '山东省滨州市沾化县', '256800', '', 'zhx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4445, 4438, 0, 3, 0, '博兴县', '山东省滨州市博兴县', '256500', '', 'bxx', 'B', 0);
INSERT INTO `tp_city` VALUES (4446, 4438, 0, 3, 0, '滨城区', '山东省滨州市滨城区', '256600', '', 'bcq', 'B', 0);
INSERT INTO `tp_city` VALUES (4447, 4320, 0, 2, 0, '菏泽市', '山东省菏泽市', '274000', '', 'hzs', 'H', 0);
INSERT INTO `tp_city` VALUES (4448, 4447, 0, 3, 0, '牡丹区', '山东省菏泽市牡丹区', '274009', '', 'mdq', 'M', 0);
INSERT INTO `tp_city` VALUES (4449, 4447, 0, 3, 0, '定陶县', '山东省菏泽市定陶县', '274100', '', 'dtx', 'D', 0);
INSERT INTO `tp_city` VALUES (4450, 4447, 0, 3, 0, '鄄城县', '山东省菏泽市鄄城县', '274600', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4451, 4447, 0, 3, 0, '郓城县', '山东省菏泽市郓城县', '274700', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4452, 4447, 0, 3, 0, '巨野县', '山东省菏泽市巨野县', '274900', '', 'jyx', 'J', 0);
INSERT INTO `tp_city` VALUES (4453, 4447, 0, 3, 0, '成武县', '山东省菏泽市成武县', '274200', '', 'cwx', 'C', 0);
INSERT INTO `tp_city` VALUES (4454, 4447, 0, 3, 0, '单县', '山东省菏泽市单县', '274300', '', 'dx', 'D', 0);
INSERT INTO `tp_city` VALUES (4455, 4447, 0, 3, 0, '曹县', '山东省菏泽市曹县', '274400', '', 'cx', 'C', 0);
INSERT INTO `tp_city` VALUES (4456, 4447, 0, 3, 0, '东明县', '山东省菏泽市东明县', '274500', '', 'dmx', 'D', 0);
INSERT INTO `tp_city` VALUES (4457, 4447, 0, 3, 0, '其它区', '山东省菏泽市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4458, 4320, 0, 2, 0, '聊城市', '山东省聊城市', '252000', '', 'lcs', 'L', 0);
INSERT INTO `tp_city` VALUES (4459, 4458, 0, 3, 0, '东昌府区', '山东省聊城市东昌府区', '252000', '', 'dcfq', 'D', 0);
INSERT INTO `tp_city` VALUES (4460, 4458, 0, 3, 0, '其它区', '山东省聊城市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4461, 4458, 0, 3, 0, '临清市', '山东省聊城市临清市', '252600', '', 'lqs', 'L', 0);
INSERT INTO `tp_city` VALUES (4462, 4458, 0, 3, 0, '冠县', '山东省聊城市冠县', '252500', '', 'gx', 'G', 0);
INSERT INTO `tp_city` VALUES (4463, 4458, 0, 3, 0, '东阿县', '山东省聊城市东阿县', '252200', '', 'dax', 'D', 0);
INSERT INTO `tp_city` VALUES (4464, 4458, 0, 3, 0, '高唐县', '山东省聊城市高唐县', '252800', '', 'gtx', 'G', 0);
INSERT INTO `tp_city` VALUES (4465, 4458, 0, 3, 0, '阳谷县', '山东省聊城市阳谷县', '252300', '', 'ygx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4466, 4458, 0, 3, 0, '茌平县', '山东省聊城市茌平县', '252100', '', 'px', 'Z', 0);
INSERT INTO `tp_city` VALUES (4467, 4458, 0, 3, 0, '莘县', '山东省聊城市莘县', '252400', '', 'x', 'Z', 0);
INSERT INTO `tp_city` VALUES (4468, 4320, 0, 2, 0, '德州市', '山东省德州市', '253000', '', 'dzs', 'D', 0);
INSERT INTO `tp_city` VALUES (4469, 4468, 0, 3, 0, '乐陵市', '山东省德州市乐陵市', '253600', '', 'lls', 'L', 0);
INSERT INTO `tp_city` VALUES (4470, 4468, 0, 3, 0, '禹城市', '山东省德州市禹城市', '251200', '', 'ycs', 'Y', 0);
INSERT INTO `tp_city` VALUES (4471, 4468, 0, 3, 0, '其它区', '山东省德州市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4472, 4468, 0, 3, 0, '武城县', '山东省德州市武城县', '253300', '', 'wcx', 'W', 0);
INSERT INTO `tp_city` VALUES (4473, 4468, 0, 3, 0, '临邑县', '山东省德州市临邑县', '251500', '', 'lyx', 'L', 0);
INSERT INTO `tp_city` VALUES (4474, 4468, 0, 3, 0, '齐河县', '山东省德州市齐河县', '251100', '', 'qhx', 'Q', 0);
INSERT INTO `tp_city` VALUES (4475, 4468, 0, 3, 0, '平原县', '山东省德州市平原县', '253121', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (4476, 4468, 0, 3, 0, '夏津县', '山东省德州市夏津县', '253200', '', 'xjx', 'X', 0);
INSERT INTO `tp_city` VALUES (4477, 4468, 0, 3, 0, '开发区', '山东省德州市开发区', '', '', 'kfq', 'K', 0);
INSERT INTO `tp_city` VALUES (4478, 4468, 0, 3, 0, '德城区', '山东省德州市德城区', '253011', '', 'dcq', 'D', 0);
INSERT INTO `tp_city` VALUES (4479, 4468, 0, 3, 0, '庆云县', '山东省德州市庆云县', '253700', '', 'qyx', 'Q', 0);
INSERT INTO `tp_city` VALUES (4480, 4468, 0, 3, 0, '宁津县', '山东省德州市宁津县', '253400', '', 'njx', 'N', 0);
INSERT INTO `tp_city` VALUES (4481, 4468, 0, 3, 0, '陵县', '山东省德州市陵县', '253500', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (4482, 4320, 0, 2, 0, '莱芜市', '山东省莱芜市', '271100', '', 'lws', 'L', 0);
INSERT INTO `tp_city` VALUES (4483, 4482, 0, 3, 0, '钢城区', '山东省莱芜市钢城区', '271100', '', 'gcq', 'G', 0);
INSERT INTO `tp_city` VALUES (4484, 4482, 0, 3, 0, '莱城区', '山东省莱芜市莱城区', '271100', '', 'lcq', 'L', 0);
INSERT INTO `tp_city` VALUES (4485, 4482, 0, 3, 0, '其它区', '山东省莱芜市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4486, 4320, 0, 2, 0, '临沂市', '山东省临沂市', '276000', '', 'lys', 'L', 0);
INSERT INTO `tp_city` VALUES (4487, 4486, 0, 3, 0, '其它区', '山东省临沂市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4488, 4486, 0, 3, 0, '蒙阴县', '山东省临沂市蒙阴县', '276200', '', 'myx', 'M', 0);
INSERT INTO `tp_city` VALUES (4489, 4486, 0, 3, 0, '临沭县', '山东省临沂市临沭县', '276700', '', 'lx', 'L', 0);
INSERT INTO `tp_city` VALUES (4490, 4486, 0, 3, 0, '罗庄区', '山东省临沂市罗庄区', '276022', '', 'lzq', 'L', 0);
INSERT INTO `tp_city` VALUES (4491, 4486, 0, 3, 0, '兰山区', '山东省临沂市兰山区', '276002', '', 'lsq', 'L', 0);
INSERT INTO `tp_city` VALUES (4492, 4486, 0, 3, 0, '苍山县', '山东省临沂市苍山县', '277700', '', 'csx', 'C', 0);
INSERT INTO `tp_city` VALUES (4493, 4486, 0, 3, 0, '费县', '山东省临沂市费县', '273400', '', 'fx', 'F', 0);
INSERT INTO `tp_city` VALUES (4494, 4486, 0, 3, 0, '平邑县', '山东省临沂市平邑县', '273300', '', 'pyx', 'P', 0);
INSERT INTO `tp_city` VALUES (4495, 4486, 0, 3, 0, '莒南县', '山东省临沂市莒南县', '276600', '', 'nx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4496, 4486, 0, 3, 0, '沂南县', '山东省临沂市沂南县', '276300', '', 'ynx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4497, 4486, 0, 3, 0, '郯城县', '山东省临沂市郯城县', '276100', '', 'cx', 'Z', 0);
INSERT INTO `tp_city` VALUES (4498, 4486, 0, 3, 0, '沂水县', '山东省临沂市沂水县', '276400', '', 'ysx', 'Y', 0);
INSERT INTO `tp_city` VALUES (4499, 4486, 0, 3, 0, '河东区', '山东省临沂市河东区', '276034', '', 'hdq', 'H', 0);
INSERT INTO `tp_city` VALUES (4500, 0, 0, 1, 0, '海外', '海外', '', '', 'hw', 'H', 0);
INSERT INTO `tp_city` VALUES (4501, 0, 0, 1, 0, '上海', '上海', '', '', 'sh', 'S', 0);
INSERT INTO `tp_city` VALUES (4502, 4501, 0, 2, 0, '上海市', '上海上海市', '200000', '', 'shs', 'S', 0);
INSERT INTO `tp_city` VALUES (4503, 4502, 0, 3, 0, '川沙区', '上海上海市川沙区', '', '', 'csq', 'C', 0);
INSERT INTO `tp_city` VALUES (4504, 4502, 0, 3, 0, '其它区', '上海上海市其它区', '', '', 'qtq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4505, 4502, 0, 3, 0, '崇明县', '上海上海市崇明县', '202150', '', 'cmx', 'C', 0);
INSERT INTO `tp_city` VALUES (4506, 4502, 0, 3, 0, '闸北区', '上海上海市闸北区', '200070', '', 'zbq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4507, 4502, 0, 3, 0, '虹口区', '上海上海市虹口区', '200080', '', 'hkq', 'H', 0);
INSERT INTO `tp_city` VALUES (4508, 4502, 0, 3, 0, '杨浦区', '上海上海市杨浦区', '200082', '', 'ypq', 'Y', 0);
INSERT INTO `tp_city` VALUES (4509, 4502, 0, 3, 0, '徐汇区', '上海上海市徐汇区', '200030', '', 'xhq', 'X', 0);
INSERT INTO `tp_city` VALUES (4510, 4502, 0, 3, 0, '长宁区', '上海上海市长宁区', '200050', '', 'cnq', 'C', 0);
INSERT INTO `tp_city` VALUES (4511, 4502, 0, 3, 0, '静安区', '上海上海市静安区', '200040', '', 'jaq', 'J', 0);
INSERT INTO `tp_city` VALUES (4512, 4502, 0, 3, 0, '普陀区', '上海上海市普陀区', '200062', '', 'ptq', 'P', 0);
INSERT INTO `tp_city` VALUES (4513, 4502, 0, 3, 0, '黄浦区', '上海上海市黄浦区', '200001', '', 'hpq', 'H', 0);
INSERT INTO `tp_city` VALUES (4514, 4502, 0, 3, 0, '卢湾区', '上海上海市卢湾区', '200020', '', 'lwq', 'L', 0);
INSERT INTO `tp_city` VALUES (4515, 4502, 0, 3, 0, '奉贤区', '上海上海市奉贤区', '201400', '', 'fxq', 'F', 0);
INSERT INTO `tp_city` VALUES (4516, 4502, 0, 3, 0, '南汇区', '上海上海市南汇区', '201300', '', 'nhq', 'N', 0);
INSERT INTO `tp_city` VALUES (4517, 4502, 0, 3, 0, '青浦区', '上海上海市青浦区', '201700', '', 'qpq', 'Q', 0);
INSERT INTO `tp_city` VALUES (4518, 4502, 0, 3, 0, '松江区', '上海上海市松江区', '201600', '', 'sjq', 'S', 0);
INSERT INTO `tp_city` VALUES (4519, 4502, 0, 3, 0, '金山区', '上海上海市金山区', '201540', '', 'jsq', 'J', 0);
INSERT INTO `tp_city` VALUES (4520, 4502, 0, 3, 0, '浦东新区', '上海上海市浦东新区', '200120', '', 'pdxq', 'P', 0);
INSERT INTO `tp_city` VALUES (4521, 4502, 0, 3, 0, '嘉定区', '上海上海市嘉定区', '201800', '', 'jdq', 'J', 0);
INSERT INTO `tp_city` VALUES (4522, 4502, 0, 3, 0, '宝山区', '上海上海市宝山区', '201900', '', 'bsq', 'B', 0);
INSERT INTO `tp_city` VALUES (4523, 4502, 0, 3, 0, '闵行区', '上海上海市闵行区', '201100', '', 'xq', 'Z', 0);
INSERT INTO `tp_city` VALUES (4524, 1040, 0, 3, 0, '花地玛堂区', '', '', '', 'hdmtq', 'H', 0);
INSERT INTO `tp_city` VALUES (4525, 1040, 0, 3, 0, '圣安多尼堂区', '', '', '', 'sadntq', 'S', 0);
INSERT INTO `tp_city` VALUES (4526, 1040, 0, 3, 0, '大堂区', '', '', '', 'dtq', 'D', 0);
INSERT INTO `tp_city` VALUES (4527, 1040, 0, 3, 0, '望德堂区', '', '', '', 'wdtq', 'W', 0);
INSERT INTO `tp_city` VALUES (4528, 1040, 0, 3, 0, '风顺堂区', '', '', '', 'fstq', 'F', 0);
COMMIT;

-- ----------------------------
-- Table structure for tp_config
-- ----------------------------
DROP TABLE IF EXISTS `tp_config`;
CREATE TABLE `tp_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `value` text CHARACTER SET utf8 COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_name` (`name`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `group` (`group`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='系统配置';

-- ----------------------------
-- Records of tp_config
-- ----------------------------
BEGIN;
INSERT INTO `tp_config` VALUES (1, 'config_type_list', 3, '配置类型列表', 4, '', '主要用于数据解析和页面表单的生成', 0, 1639479659, 1, '0:数字\n1:字符\n2:文本\n3:数组\n4:枚举\n6:图片', 1);
INSERT INTO `tp_config` VALUES (2, 'config_group_list', 3, '配置分组', 4, '', '配置分组', 0, 1657191101, 1, '1:基本\n2:会员\n3:站点\n4:系统\n5:微信\n6:小程序\n7:支付\n8:返利', 2);
INSERT INTO `tp_config` VALUES (3, 'user_name_prohibit', 2, '被禁止注册的名称', 2, '', '多个用户名用,号隔开来', 0, 1657189012, 1, 'admin,管理员,系统管理员', 2);
INSERT INTO `tp_config` VALUES (4, 'user_allow_reg', 4, '用户注册', 2, '1:开启注册\n0:关闭注册', '是否开启用户注册', 0, 1657189012, 1, '1', 1);
INSERT INTO `tp_config` VALUES (5, 'config_app_close', 4, '客户端状态', 1, '1:开启状态\n2:关闭维护', '系统是否开启', 0, 1663080625, 1, '1', 2);
INSERT INTO `tp_config` VALUES (6, 'config_app_url', 1, '平台地址', 1, '', 'http://www.baidu.cn', 0, 1663080625, 1, 'https://ai.sosucn.com', 3);
INSERT INTO `tp_config` VALUES (7, 'config_app_name', 1, '平台名称', 1, '', '平台名称', 0, 1663080625, 1, '首秀商城', 1);
INSERT INTO `tp_config` VALUES (8, 'site_name', 1, '站点名称', 3, '', '', 0, 1660402343, 1, '首秀美容', 1);
INSERT INTO `tp_config` VALUES (9, 'site_keywords', 2, '站点关键词', 3, '', '', 0, 1660402343, 1, '首秀美容', 2);
INSERT INTO `tp_config` VALUES (10, 'site_description', 2, '网站描述', 3, '', '', 0, 1660402343, 1, '首秀美容', 3);
INSERT INTO `tp_config` VALUES (11, 'wx_encodingaeskey', 1, '微信encod_key', 5, '', '', 1638366514, 1659457575, 1, '2908d4307826343455badc8ffa07c163', 4);
INSERT INTO `tp_config` VALUES (12, 'wx_token', 1, '微信token', 5, '', '', 1638366539, 1659457575, 1, '2908d4307826343455badc8ffa07c163', 3);
INSERT INTO `tp_config` VALUES (13, 'wx_app_secret', 1, '微信appsecret', 5, '', '', 1638366576, 1659457575, 1, '7c05203f75d0fdef7420bf7587782533', 2);
INSERT INTO `tp_config` VALUES (14, 'wx_app_id', 1, '微信appid', 5, '', '', 1638366601, 1659457575, 1, 'wx3d5fc0987ac45234', 1);
INSERT INTO `tp_config` VALUES (15, 'cert_cer', 2, '证书cer内容', 7, '', '', 1638366672, 1659457990, 1, '-----BEGIN CERTIFICATE-----\nMIID9jCCAt6gAwIBAgIUbj81T2d8XW0QxI9MVQqZVJTH8VcwDQYJKoZIhvcNAQEL\nBQAwXjELMAkGA1UEBhMCQ04xEzARBgNVBAoTClRlbnBheS5jb20xHTAbBgNVBAsT\nFFRlbnBheS5jb20gQ0EgQ2VudGVyMRswGQYDVQQDExJUZW5wYXkuY29tIFJvb3Qg\nQ0EwHhcNMjAwNzI5MTMwMjAwWhcNMjUwNzI4MTMwMjAwWjCBhzETMBEGA1UEAwwK\nMTYwMTQzOTY4NzEbMBkGA1UECgwS5b6u5L+h5ZWG5oi357O757ufMTMwMQYDVQQL\nDCrph5HniZvljLrpppbnp4DlpKfnpo/nvo7lrrnlkqjor6LmnI3liqHpg6gxCzAJ\nBgNVBAYMAkNOMREwDwYDVQQHDAhTaGVuWmhlbjCCASIwDQYJKoZIhvcNAQEBBQAD\nggEPADCCAQoCggEBANqtnHcrpqbDcr7bSKfBJ+c09H5sTZ3o/EHJ5Y8e/tETVmVL\n3NC/tUXy1RZHmntiOyas2jwLctNUUyfRLLwYHRng1sxspd9Rg5FFWrAsS38S4HCK\ndzJ+Fx6E0ipwr58UDwpJaoWX0suzgGu1Tpe4ZYhI3l06UWuPM9tv9/fccVAaMzCN\nyvMQR9PI3qF5w0s6nOxJFA8iJJLCMGsjoaRD9kS1b1BZqscT0TGeW5dKudZwxIks\n3T5jPVXKq/e22CaECzsYDLXSFiWdDLXo/YJgvz0VzELCK1ydQV/90QxQTSzyGU82\nALoNdVqyKY06sNBKk2UhZiiAKLkVqgROmCWXjZ8CAwEAAaOBgTB/MAkGA1UdEwQC\nMAAwCwYDVR0PBAQDAgTwMGUGA1UdHwReMFwwWqBYoFaGVGh0dHA6Ly9ldmNhLml0\ncnVzLmNvbS5jbi9wdWJsaWMvaXRydXNjcmw/Q0E9MUJENDIyMEU1MERCQzA0QjA2\nQUQzOTc1NDk4NDZDMDFDM0U4RUJEMjANBgkqhkiG9w0BAQsFAAOCAQEALeR5dRAy\nKr6Z7TIugFj+IrTD5r95ZQN5SgV5sTOCasmowTxrQWp6joyItf28HfffV6Dmi0ga\nv7UrA5pcMbnlo7hypJVhQaDgTAeZTtuNkum7tHX0tP1EgXi8QhUoTfsYRkd3DdUu\nmugemGCYNKQAJn/38qd+TrNor+6X+8msWe52B8BQ4Pg1tl74qF/CVSWNUQstoyZI\nHn24wUKZLi9cVlMeE6FfIFM/mWi3TJTkW6wH6IMQ1FoywU7QHKpBf86i85VUOpfY\nDWNfG4TeWc+tBGu4KdCFAbtZTSW01N6Pw7ypwOZezsdPBJ2QHU7WKNIWlXApVm4m\nSL7DVWRauq+0iw==\n-----END CERTIFICATE-----', 10);
INSERT INTO `tp_config` VALUES (16, 'cert_key', 2, '支付证书key', 7, '', '', 1638366700, 1659457990, 1, '-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDarZx3K6amw3K+\n20inwSfnNPR+bE2d6PxByeWPHv7RE1ZlS9zQv7VF8tUWR5p7YjsmrNo8C3LTVFMn\n0Sy8GB0Z4NbMbKXfUYORRVqwLEt/EuBwincyfhcehNIqcK+fFA8KSWqFl9LLs4Br\ntU6XuGWISN5dOlFrjzPbb/f33HFQGjMwjcrzEEfTyN6hecNLOpzsSRQPIiSSwjBr\nI6GkQ/ZEtW9QWarHE9ExnluXSrnWcMSJLN0+Yz1Vyqv3ttgmhAs7GAy10hYlnQy1\n6P2CYL89FcxCwitcnUFf/dEMUE0s8hlPNgC6DXVasimNOrDQSpNlIWYogCi5FaoE\nTpgll42fAgMBAAECggEBAJiH+piBQRgXQmVwLUieCYhTPqskPiuERNhazJ28//6z\n31J+zQJqhjXJQOrufQnNJfc/IGY7khdoPSyL0glNRJc1Zn5m1nhjskLVPoGeE/cK\nIrU9UBFPNC8cdEAYI9fxNOB2/y86DFX72frHF4/qlh+uvDQJJpvA4moQusUP5ZX5\ntZA/zFg8MFsEEvCgbTlSyOsDf2TGpOJtjigNPOt3md3dpqplQtvOSoM7dZH3tBn6\npzGynIj52Ic3RpOGalikFaFWdi5SrMSD9/ISZAeyZEx+9Q85TJS3XZSegOJw3qAf\nzfCk6809uBfApVFuTF2iOlzR0U47paXGoRz//iUwyrkCgYEA/d4ffBLqZfLj71AI\nJNDu8cho2SwwavKcSoqDObq/+aW8c+hZEmPHCCuLcwZrPcZ+rx5nnUjhrqsoklLN\nEefOLpRhyl4tp9YRg2UeliWbCxaPG0n58f1ZznQmjilzhv0BpjSJm5AS1RXefonJ\nNPFVbaqUYVTElNuMYFej8yfDZdsCgYEA3IPSf0h8tDD2giUOD28t4ULdZlBuxd37\nhh3wxLEOtkfH5Ml2V76xlKjJXkjQcTSScXWUdFEzcBhNXBjGXvSRR7lPPzf61dE/\nBkKulOQkfITndun5KjwckLshVlu1pq5JoEzw8yZDYDYsNMQEn6DZOZp43mjjOMbF\nJJTDtzDlnI0CgYBVHKdJnb3gODKbBSX10eaKQTqFtP72nCgyBYZBUI8UT7CC258h\nPzp3TsIN6lUB/Q5z/6mVXd3sBY4woHoISsMhcrXmdvSvlGGCv+AlTq5QZVvNNlwJ\n+XqmcOKMPvFwjFqFMpAAC6mErzRNEDzY9yBBCDN+/kB597F0i214FBi6iQKBgQCL\nlhJQKgVuVrQkK+qbkIgdWKMnWfDU5bCK9DbtexrR/dwmEfUMlBR7AuD9AuCXWGz+\nzywa+S+zXF7T1obzoqK4ITBt1zS71omrn9g9PbFu9P5EAtWLi6OVZi8zKDhze031\n396CPA1YQNJ40EAQ/9OhqAus1f5HeWNfxZ+iPZyLHQKBgHTBJfSBHjBlzQI5HohS\ng5j2Pa3RzBVM0zPt05ZbhF2GUCJomX/THFy/+MxcBPUT2ZWOK7miTkdU7VEMI+wC\nWiBuk8PLRH1KeeGBFsB3Jid5OG1e/phd5CLq6d9lLKtpjSmlVzDDbofx4IvZ/uJE\nP5dUrjpmwGVMgHQcxkoJ6665\n-----END PRIVATE KEY-----', 9);
INSERT INTO `tp_config` VALUES (18, 'mch_key_v3', 1, '支付mch_key_v3', 7, '', '', 1638366762, 1659457990, 1, '963a1ec19d7e3dc3e24c6bd024267df5', 7);
INSERT INTO `tp_config` VALUES (19, 'mch_key_v2', 1, '支付mch_key_v2', 7, '', '', 1638366792, 1659457990, 1, '963a1ec19d7e3dc3e24c6bd024267df5', 6);
INSERT INTO `tp_config` VALUES (20, 'sub_mch_id', 1, '子商户sub_mch_id', 7, '', '', 1638366824, 1659457990, 1, '1601439687', 5);
INSERT INTO `tp_config` VALUES (21, 'routine_app_encodingaeskey', 1, 'encodIngaeskey', 6, '', '', 1638366866, 1659457449, 1, '45b9e4d244830ce974fc37516b022012', 5);
INSERT INTO `tp_config` VALUES (23, 'routine_app_secret', 1, '客户端小程序app_secret', 6, '', '', 1638366922, 1659457449, 1, '7c05203f75d0fdef7420bf7587782533', 2);
INSERT INTO `tp_config` VALUES (24, 'routine_app_id', 1, '客户端小程序Appid', 6, '', '', 1638366949, 1659457449, 1, 'wx3d5fc0987ac45234', 1);
INSERT INTO `tp_config` VALUES (25, 'file_driver', 4, '上传驱动', 1, 'public:本地储存\noss:阿里云OSS', '', 1638418211, 1663080625, 1, 'public', 5);
INSERT INTO `tp_config` VALUES (27, 'integral_bi', 0, '消费奖励积分比例', 8, '', '消费1元获得多少积分', 1639381839, 1660402100, 1, '1', 10);
INSERT INTO `tp_config` VALUES (29, 'config_logo_url', 6, '站点LOGO', 1, '', '', 1639479374, 1663080625, 1, 'https://ai.sosucn.com/upload/20220813/51f08dc97d3176b15101e0318700a600.png', 1);
INSERT INTO `tp_config` VALUES (30, 'mch_id', 1, '商户mch_id', 7, '', '', 1656490832, 1659457990, 1, '1601439687', 1);
INSERT INTO `tp_config` VALUES (31, 'distributor', 4, '是否开启分销功能', 8, '1:开启\n0:关闭', '', 1657082552, 1660402100, 1, '1', 11);
INSERT INTO `tp_config` VALUES (32, 'distributor_one', 0, '一级分销奖励', 8, '', '百分比，直接填写数字', 1657082652, 1660402100, 1, '5', 12);
INSERT INTO `tp_config` VALUES (33, 'distributor_two', 0, '二级分销商奖励', 8, '', '百分比，直接填写数字', 1657082715, 1660402100, 1, '3', 13);
INSERT INTO `tp_config` VALUES (36, 'poster', 6, '推广海报背景', 1, '', '图片尺寸必须是600x1000', 1657174230, 1663080625, 1, 'https://ai.sosucn.com/upload/20220707/a814f64e6fbd5a29f649703cd23b7e67.jpg', 19);
INSERT INTO `tp_config` VALUES (37, 'distributor_hour', 0, '奖励结算周期', 8, '', 'xx小时', 1657191246, 1660402100, 1, '20', 15);
INSERT INTO `tp_config` VALUES (38, 'user_sign', 4, '是否开启签到', 8, '1:开启\n0:关闭', '', 1660401854, 1660402100, 1, '1', 1);
COMMIT;

-- ----------------------------
-- Table structure for tp_connect
-- ----------------------------
DROP TABLE IF EXISTS `tp_connect`;
CREATE TABLE `tp_connect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '微信用户id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `referee_id` int(11) NOT NULL DEFAULT '0' COMMENT '推荐人ID',
  `unionid` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段',
  `openid` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户的标识，对当前公众号唯一',
  `nickname` varchar(64) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户的昵称',
  `headimgurl` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户头像',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `city` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '用户所在城市',
  `language` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '用户的语言，简体中文为zh_CN',
  `province` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '用户所在省份',
  `country` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '用户所在国家',
  `remark` varchar(256) CHARACTER SET utf8 DEFAULT NULL COMMENT '公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注',
  `groupid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '用户所在的分组ID（兼容旧的用户分组接口）',
  `tagid_list` varchar(256) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户被打上的标签ID列表',
  `subscribe` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户是否订阅该公众号标识',
  `subscribe_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '关注公众号时间',
  `session_key` varchar(60) CHARACTER SET utf8 DEFAULT NULL COMMENT '小程序用户会话密匙',
  `user_type` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT 'wechat' COMMENT '用户类型',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `groupid` (`groupid`) USING BTREE,
  KEY `subscribe_time` (`subscribe_time`) USING BTREE,
  KEY `add_time` (`add_time`) USING BTREE,
  KEY `subscribe` (`subscribe`) USING BTREE,
  KEY `unionid` (`unionid`) USING BTREE,
  KEY `openid` (`openid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='第三方用户表';

-- ----------------------------
-- Records of tp_connect
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_distributor_task
-- ----------------------------
DROP TABLE IF EXISTS `tp_distributor_task`;
CREATE TABLE `tp_distributor_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分销奖励任务ID',
  `order_number` varchar(60) NOT NULL COMMENT '订单号',
  `order_amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已执行[1是,0否,5退款]',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '分销层级（1,2）共2级',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '直推奖励',
  `uid` int(11) NOT NULL COMMENT '分销人ID',
  `payment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态[0待支付,1已支付,9支付失败]',
  `msg` varchar(255) NOT NULL COMMENT '错误说明',
  `payment_time` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  `order_pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '订单支付时间',
  `del_time` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `order_number` (`order_number`),
  KEY `status` (`status`),
  KEY `level` (`level`),
  KEY `uid` (`uid`),
  KEY `payment` (`payment`),
  KEY `order_pay_time` (`order_pay_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单奖励任务表';

-- ----------------------------
-- Records of tp_distributor_task
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_file
-- ----------------------------
DROP TABLE IF EXISTS `tp_file`;
CREATE TABLE `tp_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `uid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `app` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '所属应用',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否管理员',
  `type_id` int(5) NOT NULL DEFAULT '0' COMMENT '分类id',
  `name` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '保存名称',
  `path` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件夹',
  `ext` char(5) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `unit` char(5) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '单位',
  `size` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '文件大小',
  `md5` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件md5',
  `hash` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `driver` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '上传驱动',
  `mch_id` varchar(60) NOT NULL DEFAULT '',
  `media_id` varchar(255) NOT NULL DEFAULT '' COMMENT '媒体ID',
  `url` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '图片访问地址',
  `create_time` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='文件表';

-- ----------------------------
-- Records of tp_file
-- ----------------------------
BEGIN;
INSERT INTO `tp_file` VALUES (1, 1, 'file', 0, 0, '1.jpg', 'upload/20220714/6dd502751b741d4a62d35f70500e10cb.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 78.47, '0d85eed5cd3dc83c1b8671c49d3d85fc', '7c0adf9952f1acb729d2a7438f479e846e18a6ef', 'public', '0', '', '/upload/20220714/6dd502751b741d4a62d35f70500e10cb.jpg', 1657771558);
INSERT INTO `tp_file` VALUES (4, 1, 'file', 0, 0, '3.jpg', 'upload/20220714/377d2c85d0b79a2bebec4a81ec4e67a9.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 32.01, '9e0221a5e4dbcb758f718b62be05ec86', 'a58ca4837bf93c210f926d81347f1e06eaee53fc', 'public', '0', '', '/upload/20220714/377d2c85d0b79a2bebec4a81ec4e67a9.jpg', 1657771785);
INSERT INTO `tp_file` VALUES (5, 1, 'file', 0, 0, '2.jpg', 'upload/20220714/d7f483aebf9b246f726cb154835f466b.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 43.71, '4500fcffaef395badcccaf3e36d994c1', '32b4a0cfeae3a95ba35a65865f3b9de5bdab912c', 'public', '0', '', '/upload/20220714/d7f483aebf9b246f726cb154835f466b.jpg', 1657771785);
INSERT INTO `tp_file` VALUES (6, 1, 'file', 0, 0, 'view1.jpg', 'upload/20220714/8be6b90db8d360286bf436a9d6026c6d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 88.66, '9dfbc6ca5d87ef5b3686e03c4a77efe9', '32884206582d90f70804d337b287e7d958d332d7', 'public', '0', '', '/upload/20220714/8be6b90db8d360286bf436a9d6026c6d.jpg', 1657772150);
INSERT INTO `tp_file` VALUES (7, 1, 'file', 0, 0, 'view2.jpg', 'upload/20220714/06dbbf97a3343c660304fafc9feba121.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 384.89, '3a272eba25c279eccd52ac5274fc12e3', '7e371d3b5845f1d1dc99ed61ce6004eb36488987', 'public', '0', '', '/upload/20220714/06dbbf97a3343c660304fafc9feba121.jpg', 1657772150);
INSERT INTO `tp_file` VALUES (8, 1, 'file', 0, 0, 'view3.jpg', 'upload/20220714/2aa0bfb923a3ea854a85be5c88e52f95.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 865.14, 'b484716b14eda3325b0c22c1afb46ce4', '8d891558e6f8dfb3d2ef350e03133530ee4ad7cb', 'public', '0', '', '/upload/20220714/2aa0bfb923a3ea854a85be5c88e52f95.jpg', 1657772150);
INSERT INTO `tp_file` VALUES (9, 1, 'file', 0, 0, 'm1.jpg', 'upload/20220714/00e0fc42b9f0a923e2448e4443da89d2.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 19.75, '9a8eef0793c1ba00dc2f152cf091bd3b', '49cadb86fed8251a9b18e56d5c8f5520c00b807b', 'public', '0', '', '/upload/20220714/00e0fc42b9f0a923e2448e4443da89d2.jpg', 1657772420);
INSERT INTO `tp_file` VALUES (10, 1, 'file', 0, 0, '极光小白管1.jpg', 'upload/20220714/f4b29b7ef44524f32e2d20535ddb5e4b.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 59.09, '3ee74ec0b49c781160b756c0ab7a7ae3', 'acd91a7d033e457b25800140277ad4fa8155ad35', 'public', '0', '', '/upload/20220714/f4b29b7ef44524f32e2d20535ddb5e4b.jpg', 1657773523);
INSERT INTO `tp_file` VALUES (11, 1, 'file', 0, 0, '极光小白管2.jpg', 'upload/20220714/bc8d05f4161b3c8054cfad9ec7d3fbc4.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 354.85, '44101e83b81949bff119ec51edf29308', 'a6e3a98e1ac76a7f7e98d8fcd65252ca3e29fd89', 'public', '0', '', '/upload/20220714/bc8d05f4161b3c8054cfad9ec7d3fbc4.jpg', 1657773523);
INSERT INTO `tp_file` VALUES (12, 1, 'file', 0, 0, '清颜祛痘套1.jpg', 'upload/20220714/e15b29511c49ee5cd2833653021451e9.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 88.55, '2c9fa1483de721c0901fe58e7daedbe9', 'c5c0de99ab52950f1e74345e2be0a77c49c9a0cc', 'public', '0', '', '/upload/20220714/e15b29511c49ee5cd2833653021451e9.jpg', 1657774201);
INSERT INTO `tp_file` VALUES (13, 1, 'file', 0, 0, '清颜祛痘套1.jpg', 'upload/20220714/6b37f21bbe99f5094f1d41d012fa80e8.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 71.43, '28debc2795ec25ad35bb21ef3e16666a', 'a801bc5b4f6a95a9bb6046f9ac7c95160d1c82a7', 'public', '0', '', '/upload/20220714/6b37f21bbe99f5094f1d41d012fa80e8.jpg', 1657774201);
INSERT INTO `tp_file` VALUES (14, 1, 'file', 0, 0, '清颜祛痘套4.jpg', 'upload/20220714/c0be9ffd42f4d86ce77070191c10db8e.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 299.85, '80a9f7a7edfc9f8b383cfd6e80186889', '1c92f2310eba9b7de319ae7012796a1d5c84712e', 'public', '0', '', '/upload/20220714/c0be9ffd42f4d86ce77070191c10db8e.jpg', 1657774201);
INSERT INTO `tp_file` VALUES (15, 1, 'file', 0, 0, '清颜祛痘套2.jpg', 'upload/20220714/e8b152e44e45f36688dd0845aded48cf.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 368.69, '214df29f54d4c682677899ca2b91418a', '644d1be31c6dac4047e56008cd954a2acfa3ecd5', 'public', '0', '', '/upload/20220714/e8b152e44e45f36688dd0845aded48cf.jpg', 1657774201);
INSERT INTO `tp_file` VALUES (16, 1, 'file', 0, 0, '清颜祛痘套5.jpg', 'upload/20220714/196ca487cdc1d741d4052fca7c06553d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 244.17, '3d332e1d9f5c4115d6b14ded6eb7accc', '83c548cd1da7ed656e5753121e8e3c326971d66f', 'public', '0', '', '/upload/20220714/196ca487cdc1d741d4052fca7c06553d.jpg', 1657774201);
INSERT INTO `tp_file` VALUES (21, 1, '', 0, 0, '5711656933869_.pic.jpg', 'upload/20220719/ae159d98213c0f6497c92e59a8304f09.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 302.68, '92c178cb2647a54188653185d1bd4c05', 'ec34831295dbf3d0249b35e34243d5a91d91b3d5', 'public', '1600606901', 'u1CxHypE7C3mCWUJIJLHkqqStMrMO6OyKRkcHfGgkrqir6Q7n3p321tTfz55-FB0Z05Mt6TZcQUR0HOVTjemFQou1NTQndiNrmFsU4JBdaY', '/upload/20220719/ae159d98213c0f6497c92e59a8304f09.jpg', 1658246007);
INSERT INTO `tp_file` VALUES (22, 1, '', 0, 0, '1.jpg', 'upload/20220720/a129b227fcea52e733b69ee328508bd7.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 161.71, '9ed67b2692fff7047149702ca49ba3af', 'cd30793a2c5ad1d24a1940bf44da48e254754fca', 'public', '1600606901', 'FsiyJv6uJPsB-FiPcepMYRcwgX_iUdP6STJ-0w4rO_J3G0FWFyiY2xQ73q6EtdXL0zN3JpLHsDkwILogwXaDRq739NegC63tMnH3BjxoEpQ', '/upload/20220720/a129b227fcea52e733b69ee328508bd7.jpg', 1658302376);
INSERT INTO `tp_file` VALUES (27, 1, 'file', 0, 0, '658167a00755c2fcc9dccddd8054d04.jpg', 'upload/20220729/a0b26e92a018ee7d39fe0bbd9d44ca45.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 688.43, '95f1c4110272b98cbe7a6fb737b7725a', 'a5c031331c83087992575a1ecf98005b4b680d2b', 'public', '', '', '/upload/20220729/a0b26e92a018ee7d39fe0bbd9d44ca45.jpg', 1659059656);
INSERT INTO `tp_file` VALUES (28, 1, 'file', 0, 0, 'a423ef0df22782ad5382ca999d2ccfc.jpg', 'upload/20220729/15af37298c6323c5f545e98c2106a4c9.jpg', 'upload', 'jpg', 'image/jpeg', 'M', 1.29, 'ad4f7f669b75c1a96b767676cf9a418a', '2ec6de231d9647509bb1917a3b4b8537b5d39dee', 'public', '', '', '/upload/20220729/15af37298c6323c5f545e98c2106a4c9.jpg', 1659060485);
INSERT INTO `tp_file` VALUES (29, 1, 'file', 0, 0, '39fa1b598cdc94922dfabbf0594d2a4.jpg', 'upload/20220729/43b9582835ac2c1203082f993a962ff8.jpg', 'upload', 'jpg', 'image/jpeg', 'M', 1.42, 'ea3343e2229d78c4a99fe94e32f6f285', '1a6ab8e63775fb06eadebe0f01b5712ffcb8d7dd', 'public', '', '', '/upload/20220729/43b9582835ac2c1203082f993a962ff8.jpg', 1659061400);
INSERT INTO `tp_file` VALUES (30, 1, 'file', 0, 0, '2b19f623e2c95629718d6446764cd63.jpg', 'upload/20220729/9199eeeb01f7631442733fc0c68c4514.jpg', 'upload', 'jpg', 'image/jpeg', 'M', 1.44, '2558a8ea3ecf467163d336ac5bffe63d', '5573932c3bb07c1e47f6dcb3de99e315a0286bd2', 'public', '', '', '/upload/20220729/9199eeeb01f7631442733fc0c68c4514.jpg', 1659064553);
INSERT INTO `tp_file` VALUES (31, 1, 'file', 0, 0, '5dc427e46ec9476b1e11da8bebc1ef7.jpg', 'upload/20220729/e354838974387302e68927995631f18c.jpg', 'upload', 'jpg', 'image/jpeg', 'M', 1.35, 'df7e4b87f1e382f0bc731b35d2dbf30c', '6d407f3c080b1906a1b4e09195738097f96311f9', 'public', '', '', '/upload/20220729/e354838974387302e68927995631f18c.jpg', 1659064751);
INSERT INTO `tp_file` VALUES (32, 1, 'file', 0, 0, '4571b38d41be946f9ac241b3a99b29f.jpg', 'upload/20220802/d0ff4adfd585642f19939a342e50d5f7.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 287.30, '521e11c8dd4be59c3eccfaef32b0bf37', '905dbd296a2ddbfc9d67ecccd3a5fd5a56e2df4f', 'public', '', '', '/upload/20220802/d0ff4adfd585642f19939a342e50d5f7.jpg', 1659408525);
INSERT INTO `tp_file` VALUES (33, 1, 'file', 0, 0, '9ca52dfacf291aa606243004432b135.jpg', 'upload/20220802/d82639d5b06395ee3cfc8d99accccf2b.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 289.35, 'bee1e33b3bdeaefc2385f27bc7b23929', 'c06e8d80380e3f5aefb4c705f35b9bfb03b14915', 'public', '', '', '/upload/20220802/d82639d5b06395ee3cfc8d99accccf2b.jpg', 1659408533);
INSERT INTO `tp_file` VALUES (34, 1, 'file', 0, 0, 'd95ccf370e468c77f97540576dc627c.jpg', 'upload/20220802/6f11f65474bd84b58cf1fa0f261d0af9.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 278.71, 'b321fba0446d3bcb51090da9ec1586ec', 'bc5ad4f60017c90143c43e5b03377d71df135684', 'public', '', '', '/upload/20220802/6f11f65474bd84b58cf1fa0f261d0af9.jpg', 1659408542);
INSERT INTO `tp_file` VALUES (35, 1, 'file', 0, 0, 'b1942c0fd16a8b66b5eb8591b0dbb4f.jpg', 'upload/20220802/b651e49ee42e6b5bee2b3df803884bb4.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 233.48, 'dfb6a6942703ac63d121a643cb00717d', 'dc3c6630415685c2398d2f0031c335da51bbe452', 'public', '', '', '/upload/20220802/b651e49ee42e6b5bee2b3df803884bb4.jpg', 1659409251);
INSERT INTO `tp_file` VALUES (36, 1, 'file', 0, 0, 'da02932344fad04ce3b214d1d7549db.jpg', 'upload/20220802/f1056202a882d5c7ab147854c55d7f51.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 81.30, '33d4abcc367ed38708b0826a99b97293', '0e3097d5175cbde550ee6d2e31162409dc1b7054', 'public', '', '', '/upload/20220802/f1056202a882d5c7ab147854c55d7f51.jpg', 1659426060);
INSERT INTO `tp_file` VALUES (38, 1, 'file', 0, 0, '0e4f299e24f7269a78732c47f0a2a0a.jpg', 'upload/20220802/6f469417bb1933eba965c8507c2fc3d5.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 535.21, '0b74033b21d01ee9de7e592d11908d55', '2d4c44cea6893a870f9910bd965f8f1b964f10ee', 'public', '', '', '/upload/20220802/6f469417bb1933eba965c8507c2fc3d5.jpg', 1659426473);
INSERT INTO `tp_file` VALUES (39, 1, 'file', 0, 0, '0fe3b219c1c45076da422116fb54da5.jpg', 'upload/20220802/d29d73625724d2ca043962055043c8fe.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 537.02, 'a9a159c5fe853f0f23c115956be109b8', 'fb25bdd4ddd4c8f9f28964793e6eeddd9ba54545', 'public', '', '', '/upload/20220802/d29d73625724d2ca043962055043c8fe.jpg', 1659426481);
INSERT INTO `tp_file` VALUES (40, 1, 'file', 0, 0, '9bb6f1681eec0c1e66fd1e4dddce884.jpg', 'upload/20220802/a8de573aa14a4689e508bd545c26ef2a.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 492.63, 'cd28296f10034e3d5ca6b3591fc44144', '532bf7dbd1124a7bf9a1dccaf65d9425aca02fa6', 'public', '', '', '/upload/20220802/a8de573aa14a4689e508bd545c26ef2a.jpg', 1659426487);
INSERT INTO `tp_file` VALUES (41, 1, 'file', 0, 0, '10f4783460f2b4678919f8ea7c699de.jpg', 'upload/20220802/a17c454d4d0a77747776e59753e3432c.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 524.11, 'e400fb70e592824e3813509f75f66d55', '0b2405692e7d77fdccf5f5c858af71fb84975efc', 'public', '', '', '/upload/20220802/a17c454d4d0a77747776e59753e3432c.jpg', 1659426492);
INSERT INTO `tp_file` VALUES (42, 1, 'file', 0, 0, '802af0fe609061c725f68337d48d665.jpg', 'upload/20220802/712fdfde7d72f106cff62c3d718265a2.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 561.45, 'add5c629296aa1dedd5f82efe6e4d9b0', '39a5e2c3f009eec2f97e5ec2ee20dc79bccefb3c', 'public', '', '', '/upload/20220802/712fdfde7d72f106cff62c3d718265a2.jpg', 1659426498);
INSERT INTO `tp_file` VALUES (43, 1, 'file', 0, 0, '990ca4d7571a0bc9d9542a463ef0c68.jpg', 'upload/20220802/3c006b663400b26a27e414d037b282d6.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 525.50, '4ebdfe272e312bd500535626f282ce49', '47a97269a05568068bf2e0c96c91038fcbd14650', 'public', '', '', '/upload/20220802/3c006b663400b26a27e414d037b282d6.jpg', 1659426504);
INSERT INTO `tp_file` VALUES (44, 1, 'file', 0, 0, '1449a047751dc56d923ed369c1e5fa4.jpg', 'upload/20220802/41958609ee211c9fccd648c21e47c940.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 406.74, 'a78ed730f859f416f4581df603918c05', '365d86f28714b0de080471a6f1f196d7c7d2c61c', 'public', '', '', '/upload/20220802/41958609ee211c9fccd648c21e47c940.jpg', 1659426509);
INSERT INTO `tp_file` VALUES (45, 1, 'file', 0, 0, 'abd18cb2670972e4d72066050115b2f.jpg', 'upload/20220802/56c1f52dc460c20b511ff38540a45fef.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 543.71, 'fb0b711f01a786eaf605c2e0281052b0', 'a9f77da69da1284909287ef02612432a5de14706', 'public', '', '', '/upload/20220802/56c1f52dc460c20b511ff38540a45fef.jpg', 1659426514);
INSERT INTO `tp_file` VALUES (46, 1, 'file', 0, 0, '2.jpg', 'upload/20220802/f33b00739351138883ebdf53941fa4b5.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 156.69, 'b23a891c0a860abed44412713fca5b0d', '4146ad8b53e91e26b15f7802d98454394d8fc850', 'public', '', '', '/upload/20220802/f33b00739351138883ebdf53941fa4b5.jpg', 1659432085);
INSERT INTO `tp_file` VALUES (47, 1, 'file', 0, 0, '3.jpg', 'upload/20220802/9cfbd55ba33c839c6c46f70e7878e166.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 115.83, 'c57a77c9a884f267864e2fc8b4b627ad', 'cfb566bc1a4958a36d95c808086b79190d42ddcb', 'public', '', '', '/upload/20220802/9cfbd55ba33c839c6c46f70e7878e166.jpg', 1659432085);
INSERT INTO `tp_file` VALUES (48, 1, 'file', 0, 0, '1.jpg', 'upload/20220802/d9dd05a0f17af67430a18244e6bf6b3d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 156.09, '70cf925f36c984558666531e2ea46ab8', '5e49867a3040bfd8669a667b342b2c53a35799fe', 'public', '', '', '/upload/20220802/d9dd05a0f17af67430a18244e6bf6b3d.jpg', 1659432085);
INSERT INTO `tp_file` VALUES (49, 1, 'file', 0, 0, 'f7e069a53fe3147c37e19b705c22601.jpg', 'upload/20220803/69018484b126bbae3d74db8bc8f509be.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 41.30, 'c6b5bf34fbef223c0b7d7dacb5730fde', 'db4453df9527c017a1f9dd21f4ffb988e57f6d5d', 'public', '', '', '/upload/20220803/69018484b126bbae3d74db8bc8f509be.jpg', 1659494336);
INSERT INTO `tp_file` VALUES (50, 1, 'file', 0, 0, 'PDRN.jpg', 'upload/20220806/41afb5f34d0887b1084dafd6aa18c63d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 1016.41, 'de5316a7a2c9cb85656a2e4d74baa675', '341a3c7831ae415f22d2997d5826d91abfd011cb', 'public', '', '', '/upload/20220806/41afb5f34d0887b1084dafd6aa18c63d.jpg', 1659764212);
INSERT INTO `tp_file` VALUES (51, 1, 'file', 0, 0, 'ACNE.jpg', 'upload/20220806/603ca0e364c69d31aa6734839a835b7e.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 899.83, '015ae0ee542fd5df4f0bb26bb8bdb4a3', 'b9febd8844c6988695fd10cd26e798038be223eb', 'public', '', '', '/upload/20220806/603ca0e364c69d31aa6734839a835b7e.jpg', 1659764244);
INSERT INTO `tp_file` VALUES (52, 1, 'file', 0, 0, 'C24.jpg', 'upload/20220806/308def2aff659b2dac10e7bfc85bf85d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 963.95, 'dfb9a9c48c1955b69965fc4bb75d6679', '1e24988351b96cc4f837da0c2fef3ff327c79f89', 'public', '', '', '/upload/20220806/308def2aff659b2dac10e7bfc85bf85d.jpg', 1659764251);
INSERT INTO `tp_file` VALUES (53, 1, 'file', 0, 0, 'CSN.jpg', 'upload/20220806/c3291175c3a291c788e5411cdc44f3bd.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 1003.42, 'fffaaf354e7b94e582e6a2cefa56b4df', '41e3c24f4127c5e1194b779940545e5c15a5eedd', 'public', '', '', '/upload/20220806/c3291175c3a291c788e5411cdc44f3bd.jpg', 1659764257);
INSERT INTO `tp_file` VALUES (54, 1, 'file', 0, 0, 'NK.jpg', 'upload/20220806/4525cdb7fd97811d1aad42fef93eba7d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 1017.80, 'ba4ca5ab0aaeb92e713f2aa84a851953', '382ab9b6baf406b01d0a0d4c080128b928b2ab25', 'public', '', '', '/upload/20220806/4525cdb7fd97811d1aad42fef93eba7d.jpg', 1659764262);
INSERT INTO `tp_file` VALUES (55, 1, 'file', 0, 0, '63fbd0d29161015e7e8c67e33fb7327.jpg', 'upload/20220806/f938a5e9190634342e39499d5bfe6797.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 957.79, 'acf7a7ce07b8f71d0de50cbe7393d155', 'f9f5a1504aaedf100e985ffdbe0b582351bf6a51', 'public', '', '', '/upload/20220806/f938a5e9190634342e39499d5bfe6797.jpg', 1659765881);
INSERT INTO `tp_file` VALUES (56, 1, 'file', 0, 0, 'BC色料.jpg', 'upload/20220806/afd5d4f5b12ca5d366ade264b46d74a0.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 354.60, 'fd64686e37598762f2bf6c184bcc6d71', '98d4cc29e649de543ba8a7b1ebefc7389d658685', 'public', '', '', '/upload/20220806/afd5d4f5b12ca5d366ade264b46d74a0.jpg', 1659769559);
INSERT INTO `tp_file` VALUES (57, 1, 'file', 0, 0, '6c8b8785f7b90529b2670f598a66652.jpg', 'upload/20220806/dfbc4e26fce4e1585e27795fb6aa164c.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 346.11, 'd5a9ef865f98a142640a61321809f21c', '35a952bdea52ef9edf5661675d9552cebd8024fc', 'public', '', '', '/upload/20220806/dfbc4e26fce4e1585e27795fb6aa164c.jpg', 1659773436);
INSERT INTO `tp_file` VALUES (58, 1, 'file', 0, 0, '1.jpg', 'upload/20220813/7ac37dd6f4b70889137c45fd13334aae.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 43.35, 'bfe8e3223ff8a00d4b2d672e8a6b7ab6', 'e7251536272d4b95c56b907b63b93801ffab51ec', 'public', '', '', '/upload/20220813/7ac37dd6f4b70889137c45fd13334aae.jpg', 1660332337);
INSERT INTO `tp_file` VALUES (59, 1, 'file', 0, 0, '2.jpg', 'upload/20220813/1e5830f2c22dab502a2abfadd5b212cb.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 36.12, 'd65ef537ce503b9b9e82efb56b211048', '7a0526785d458ca999b170eaa5eb3a3ae0d8cf07', 'public', '', '', '/upload/20220813/1e5830f2c22dab502a2abfadd5b212cb.jpg', 1660332342);
INSERT INTO `tp_file` VALUES (60, 1, 'file', 0, 0, '3.jpg', 'upload/20220813/d9d86364ea0d7451e5ed82d653656408.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 53.35, '789095e458f65b754d8b7a04a8ee7747', 'cf3775126b6ab71a1f63ca8c25b89e758a92ad43', 'public', '', '', '/upload/20220813/d9d86364ea0d7451e5ed82d653656408.jpg', 1660332342);
INSERT INTO `tp_file` VALUES (61, 1, 'goods', 0, 0, '水光.png', 'upload/20220813/c6a5e1f554e0d8b5fd1d472eba82e930.png', 'upload', 'png', 'image/png', 'KB', 4.84, '02ff0c15f091f9b8c96554bbee8785af', '1dbea8e7bd534ec645d669ba801076ed4f1a30f1', 'public', '', '', '/upload/20220813/c6a5e1f554e0d8b5fd1d472eba82e930.png', 1660364112);
INSERT INTO `tp_file` VALUES (62, 1, 'goods', 0, 0, '纹绣.png', 'upload/20220813/ae118e10df368b862b505e5f16f2a732.png', 'upload', 'png', 'image/png', 'KB', 2.83, '268e53b42aa5a72603833199a1a73b85', '6bed21348971787555c1a3542285f075bfb80f6f', 'public', '', '', '/upload/20220813/ae118e10df368b862b505e5f16f2a732.png', 1660364135);
INSERT INTO `tp_file` VALUES (63, 1, 'goods', 0, 0, '美睫.png', 'upload/20220813/3112d0ace9e70ace519976685fbb1d02.png', 'upload', 'png', 'image/png', 'KB', 3.25, '5ecf895d862ed0d02777c5782a8f90f6', '3b9587630af4c64da85f813ddc7dfc74e6ff0d67', 'public', '', '', '/upload/20220813/3112d0ace9e70ace519976685fbb1d02.png', 1660364152);
INSERT INTO `tp_file` VALUES (64, 1, 'goods', 0, 0, '其他.png', 'upload/20220813/66eb65fdc65b840955ed1e87cf9a863e.png', 'upload', 'png', 'image/png', 'KB', 5.53, 'f69f289a24e8d42ccf8391c374b00afb', '4142c4f880e3a31dd0a52cef5955ed86e476368b', 'public', '', '', '/upload/20220813/66eb65fdc65b840955ed1e87cf9a863e.png', 1660364172);
INSERT INTO `tp_file` VALUES (65, 1, 'goods', 0, 0, '化妆品.png', 'upload/20220813/06b4f966c3e776ca2a7a3044170bf2e1.png', 'upload', 'png', 'image/png', 'KB', 3.69, 'b57cc3206a7b06a75ad271254fec93e4', 'e3347f80b5b0b0fe8157aea37e403e0c83b63f7d', 'public', '', '', '/upload/20220813/06b4f966c3e776ca2a7a3044170bf2e1.png', 1660364281);
INSERT INTO `tp_file` VALUES (66, 1, 'file', 0, 0, 'sosu_logo.png', 'upload/20220813/51f08dc97d3176b15101e0318700a600.png', 'upload', 'png', 'image/png', 'KB', 5.72, '8fb7d44ec5e05d38e50827aad32eeb4b', '3961eacb01838ea2e5e4c75c822870895154c00a', 'public', '', '', '/upload/20220813/51f08dc97d3176b15101e0318700a600.png', 1660402158);
INSERT INTO `tp_file` VALUES (67, 1, 'file', 0, 0, '122.jpg', 'upload/20220814/4ee3e74fdcbb0089f1f267d1123dc879.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 978.36, 'e2ba87b693d24eb1629e230a115c7451', '8d92caff25d0b1259a217aa21248193bb8b44b42', 'public', '', '', '/upload/20220814/4ee3e74fdcbb0089f1f267d1123dc879.jpg', 1660447647);
INSERT INTO `tp_file` VALUES (68, 1, 'file', 0, 0, '1.jpg', 'upload/20220820/f268c8185c41dbec24f1b83cf5f72eaf.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 112.57, 'fbac85f0ab9b20f20f7aebd9c84dc547', '1579c6bc1aecb0cd7a2759a89aa84b3d2ef97c63', 'public', '', '', '/upload/20220820/f268c8185c41dbec24f1b83cf5f72eaf.jpg', 1660979312);
INSERT INTO `tp_file` VALUES (69, 1, 'file', 0, 0, '2.jpg', 'upload/20220820/dc56d8c419b7813251e4b9d4d411033e.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 118.86, 'e47a059ba4c1971c054d090d6fad8913', 'cb9e82bc58b559b4918586468c67c0d11bc4389b', 'public', '', '', '/upload/20220820/dc56d8c419b7813251e4b9d4d411033e.jpg', 1660979366);
INSERT INTO `tp_file` VALUES (70, 1, 'file', 0, 0, '3.jpg', 'upload/20220820/b140f906fa63dc2b4f813d9a7e1d64fd.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 128.75, '744f465b19dec5da6a34c07a1eb067a2', 'aa8bb3b683f2ca53c39e4a3d63dd0751f51e94fb', 'public', '', '', '/upload/20220820/b140f906fa63dc2b4f813d9a7e1d64fd.jpg', 1660979418);
INSERT INTO `tp_file` VALUES (71, 1, 'file', 0, 0, '4.jpg', 'upload/20220820/e48ef4ebadc1974ba83eae8adb392b02.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 105.35, '277baca22dd48383f1cd1a681d5e2a86', '24097b00e591a1cb504f6758d03f4178fb2b3241', 'public', '', '', '/upload/20220820/e48ef4ebadc1974ba83eae8adb392b02.jpg', 1660979456);
INSERT INTO `tp_file` VALUES (72, 1, 'file', 0, 0, '5.jpg', 'upload/20220820/10c9220de83e80892289ce6e5f699f3f.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 118.44, '5fa6ac44ff5ad3a86dda0895c57fc3d2', '171d097f93f41cb34de7c980acab93efc91971d7', 'public', '', '', '/upload/20220820/10c9220de83e80892289ce6e5f699f3f.jpg', 1660979489);
INSERT INTO `tp_file` VALUES (73, 1, 'file', 0, 0, '6.jpg', 'upload/20220820/e4fa7a27885851f6c677e3c092dbc8c9.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 37.58, '34f767d98ef79ccd31822b0818ffcd9f', '0329e70e8a2e8fb40e9fa7576931ee3a657dce61', 'public', '', '', '/upload/20220820/e4fa7a27885851f6c677e3c092dbc8c9.jpg', 1660979566);
INSERT INTO `tp_file` VALUES (74, 1, 'file', 0, 0, '7.jpg', 'upload/20220820/a4c8e4be3593435e51d75849c33f0fc5.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 35.20, '2ce88376ea74278e214abe2af3d95e7d', 'c2fc3e0c6ca62667efe1ce0a0c11a7ff7d59d01f', 'public', '', '', '/upload/20220820/a4c8e4be3593435e51d75849c33f0fc5.jpg', 1660979602);
INSERT INTO `tp_file` VALUES (75, 1, 'file', 0, 0, '8.jpg', 'upload/20220820/35bf8b48fa96b103ae7f474f5b023a38.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 239.04, '91b84e8180d0236c084a697c55ea2cfc', '9b5472f64baaffa2cbc034b17a5a2b83a26eba7f', 'public', '', '', '/upload/20220820/35bf8b48fa96b103ae7f474f5b023a38.jpg', 1660979647);
INSERT INTO `tp_file` VALUES (76, 1, 'file', 0, 0, '9.jpg', 'upload/20220820/9dd07e43512d6725d5ca329d2bbc622e.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 244.64, '1d03cd6a241ab33c5ce49dbfdf0f6f36', '627002232e0a128d48cc8203515f84e142d375cf', 'public', '', '', '/upload/20220820/9dd07e43512d6725d5ca329d2bbc622e.jpg', 1660979687);
INSERT INTO `tp_file` VALUES (77, 1, 'file', 0, 0, '33.jpg', 'upload/20220820/2d4e9dbb83174e45b8f11a6ae67a614c.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 195.74, '60ac98779aead66fd3d73418d937b338', 'd588245fcb51d0d847ca9663d6e3413c2ebc579e', 'public', '', '', '/upload/20220820/2d4e9dbb83174e45b8f11a6ae67a614c.jpg', 1660979767);
INSERT INTO `tp_file` VALUES (78, 1, 'file', 0, 0, '32.jpg', 'upload/20220820/f4ae060e1a94c5d7fc7a637139c1e8a3.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 236.40, 'a887a4f50793b6e13f549c9fba38967b', '1617aa3d9f440d9a4e7d33bb6ab8a854a6c9c032', 'public', '', '', '/upload/20220820/f4ae060e1a94c5d7fc7a637139c1e8a3.jpg', 1660979889);
INSERT INTO `tp_file` VALUES (79, 1, 'file', 0, 0, '31.jpg', 'upload/20220820/7e186b43b62937078beb278ab8ae7318.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 190.12, '6937335c7f3b5bcd0c3bd1daa15ebb05', '2e0967f3ec87a5a4956912e94dee635664105a8a', 'public', '', '', '/upload/20220820/7e186b43b62937078beb278ab8ae7318.jpg', 1660979919);
INSERT INTO `tp_file` VALUES (80, 1, 'file', 0, 0, '30.jpg', 'upload/20220820/bb71975af14693ce32b7f8a99f4c6f1b.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 185.10, '45b81c5c8b99c62999fb4b3ae26e1060', 'a5e847f00addabc183c1d519e5c2de7298e104b2', 'public', '', '', '/upload/20220820/bb71975af14693ce32b7f8a99f4c6f1b.jpg', 1660979952);
INSERT INTO `tp_file` VALUES (81, 1, 'file', 0, 0, '29.jpg', 'upload/20220820/c43584aaf51a9c9c6ffe3937a270832f.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 181.81, '30c729e22d90adfb19f191dac99a024b', 'c1a08adf465e26d34cdb753e176722cdefe045b9', 'public', '', '', '/upload/20220820/c43584aaf51a9c9c6ffe3937a270832f.jpg', 1660979992);
INSERT INTO `tp_file` VALUES (82, 1, 'file', 0, 0, '27.jpg', 'upload/20220820/d6c0b4d48f578c939429d429dd9c8748.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 163.77, 'b286377d9fb5f2e23986fb12ef9a4567', 'c32064ac97bb9027483e79febc644d50bce3b3f9', 'public', '', '', '/upload/20220820/d6c0b4d48f578c939429d429dd9c8748.jpg', 1660980092);
INSERT INTO `tp_file` VALUES (83, 1, 'file', 0, 0, '28.jpg', 'upload/20220820/8070045e2f6a8076e26a933aaca0b352.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 187.25, 'a6dc391d0ad89ff17e9fdd6bb3d9acb6', '5c97be8aecc66308d2f3a89f0dad084eb7228241', 'public', '', '', '/upload/20220820/8070045e2f6a8076e26a933aaca0b352.jpg', 1660980062);
INSERT INTO `tp_file` VALUES (84, 1, 'file', 0, 0, '26.jpg', 'upload/20220820/7baa1ff0e405a00c08001bb32aca2694.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 146.13, '26d08ffe35b47eb8bf40a7967880ed09', '86c02e5900e42ad48fa18825c239a94a2144c4e1', 'public', '', '', '/upload/20220820/7baa1ff0e405a00c08001bb32aca2694.jpg', 1660980145);
INSERT INTO `tp_file` VALUES (85, 1, 'file', 0, 0, '25.jpg', 'upload/20220820/2433ad1254983308abbcb4c67b817cb6.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 210.15, 'dac0b8c1ba21957ce29f26da83246dc1', '7fae8755a9836e37e1d9eb4f28dee3adf5d9c735', 'public', '', '', '/upload/20220820/2433ad1254983308abbcb4c67b817cb6.jpg', 1660980187);
INSERT INTO `tp_file` VALUES (86, 1, 'file', 0, 0, '24.jpg', 'upload/20220820/84f2218caa5b63d3515b1f595a4853fa.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 296.75, '48cd6dbeaaa7ab2d13d079baf7f29579', '9ca47ffb75ea06b3ba50ae14b99d53aceaa2b14b', 'public', '', '', '/upload/20220820/84f2218caa5b63d3515b1f595a4853fa.jpg', 1660980243);
INSERT INTO `tp_file` VALUES (87, 1, 'file', 0, 0, '23.jpg', 'upload/20220820/91ae75563ae3c379ed9f90f527dfa9b6.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 158.06, '61396fdee6294295fd3433768232c128', '4a3be3aa3e98aa22d8510b2f2e4ef21e66867fbb', 'public', '', '', '/upload/20220820/91ae75563ae3c379ed9f90f527dfa9b6.jpg', 1660980276);
INSERT INTO `tp_file` VALUES (88, 1, 'file', 0, 0, '22.jpg', 'upload/20220820/89d9dfc7f761aa36a5682c16bf60fe83.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 217.94, 'c41e66b1ce1d67b8ed47b0d4e712ee36', 'febaabb764a5aa1a3f2240617f674ee17759d969', 'public', '', '', '/upload/20220820/89d9dfc7f761aa36a5682c16bf60fe83.jpg', 1660980317);
INSERT INTO `tp_file` VALUES (89, 1, 'file', 0, 0, '19.jpg', 'upload/20220820/79596a5f3bb0bea5a41b0804ff27ca72.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 179.19, 'acc91efa903dbb4c1bf1930fa12aed23', 'deb41bc9de40f0be3bdcfbb590829b937658097d', 'public', '', '', '/upload/20220820/79596a5f3bb0bea5a41b0804ff27ca72.jpg', 1660980427);
INSERT INTO `tp_file` VALUES (90, 1, 'file', 0, 0, '18.jpg', 'upload/20220820/f73ee30e0d0091fee5d5a3e9c3aa365f.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 255.50, 'bd9f68ab318af4d5ff658343f4aa2dfe', '4c3585aee446db75534f662eecf87634b284233b', 'public', '', '', '/upload/20220820/f73ee30e0d0091fee5d5a3e9c3aa365f.jpg', 1660980469);
INSERT INTO `tp_file` VALUES (91, 1, 'file', 0, 0, '17.jpg', 'upload/20220820/7c0a11a4ef90e44608cdcf06b0aa72bd.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 332.96, '038c4200dbc1536733dd390dca319363', '3110ef39df8528804e30601376cbd5195aa4b011', 'public', '', '', '/upload/20220820/7c0a11a4ef90e44608cdcf06b0aa72bd.jpg', 1660980515);
INSERT INTO `tp_file` VALUES (92, 1, 'file', 0, 0, '14.jpg', 'upload/20220820/da7ecbd7585f91131912c268691b99de.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 150.03, '4c3b0b5c763405792dae7ad8f2ee9602', '925f226218adb6612fef97a356d15b70f9e02cbf', 'public', '', '', '/upload/20220820/da7ecbd7585f91131912c268691b99de.jpg', 1660980584);
INSERT INTO `tp_file` VALUES (93, 1, 'file', 0, 0, '15.jpg', 'upload/20220820/4f63d84c25c931486fe36e854dc0f27a.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 121.00, '454e561190619c0d23422f01e698424c', 'f8948e4d754bcca6e3f85b0536c730b874a9b675', 'public', '', '', '/upload/20220820/4f63d84c25c931486fe36e854dc0f27a.jpg', 1660980637);
INSERT INTO `tp_file` VALUES (94, 1, 'file', 0, 0, '16.jpg', 'upload/20220820/c312b964f112ba4ae725407afe8c87c9.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 142.77, '284a5a7b0611782229327749d8962755', 'da87f23f93285b0a77a8c7dc750456519fa34d1c', 'public', '', '', '/upload/20220820/c312b964f112ba4ae725407afe8c87c9.jpg', 1660980663);
INSERT INTO `tp_file` VALUES (95, 1, 'file', 0, 0, '11.jpg', 'upload/20220820/cca5a4fa1feee93304fe5db3879a03de.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 30.58, 'fbef31f5de663250f7b5b4bcd6bf19cb', 'c8150b75d73f91f01bd0d73c7d389dcc05134f5e', 'public', '', '', '/upload/20220820/cca5a4fa1feee93304fe5db3879a03de.jpg', 1660980714);
INSERT INTO `tp_file` VALUES (96, 1, 'file', 0, 0, '27.jpg', 'upload/20220820/48cb0f3c873d8d22bf7c56d7b6b92c6c.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 461.10, '55fcb2aae76879c239afe8ef92d1fedf', 'bc7d37f99761c32e6f69bb0fe286a8fd47fdb2b1', 'public', '', '', '/upload/20220820/48cb0f3c873d8d22bf7c56d7b6b92c6c.jpg', 1660980826);
INSERT INTO `tp_file` VALUES (97, 1, 'file', 0, 0, '26.jpg', 'upload/20220820/d90da5a1910a2f195fe108f93ea6a422.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 442.45, 'b85cb4a899a69d43368e6266de1e055b', '06711747967d4c6b2c9e7fb4e14ea93f5f7d37f4', 'public', '', '', '/upload/20220820/d90da5a1910a2f195fe108f93ea6a422.jpg', 1660980881);
INSERT INTO `tp_file` VALUES (98, 1, 'file', 0, 0, '25.jpg', 'upload/20220820/d71c036af034cfaacbd8315802606f92.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 458.88, '4706d8d5546ce4ad08dc848117347d59', '4d3f8701713266d097236eeadb1f0cb8ea4c652c', 'public', '', '', '/upload/20220820/d71c036af034cfaacbd8315802606f92.jpg', 1660980923);
INSERT INTO `tp_file` VALUES (99, 1, 'file', 0, 0, '24.jpg', 'upload/20220820/b3ac8e3131e1760f6f7d487fd6210cf2.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 453.09, '4de881b6584cc16dc79c7b6105227e9d', '92796d2352e0d5724a664ed0a1860edd8c5694a0', 'public', '', '', '/upload/20220820/b3ac8e3131e1760f6f7d487fd6210cf2.jpg', 1660980957);
INSERT INTO `tp_file` VALUES (100, 1, 'file', 0, 0, '23.jpg', 'upload/20220820/425cf00dc93032465f5edfbfcfa2422b.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 458.38, '9055397f5fee0ab2554828031686a04e', 'bee0a47c419377d97f5c49914424b90fd0a57cf0', 'public', '', '', '/upload/20220820/425cf00dc93032465f5edfbfcfa2422b.jpg', 1660980991);
INSERT INTO `tp_file` VALUES (101, 1, 'file', 0, 0, '22.jpg', 'upload/20220820/7fcbd4981ce0f039122a784e52f8f59d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 260.44, 'e3fffde3d4c09c7029cbd8ac92e50295', '5fafc1f30175f933ec5ea2350be4091a7760b1ae', 'public', '', '', '/upload/20220820/7fcbd4981ce0f039122a784e52f8f59d.jpg', 1660981057);
INSERT INTO `tp_file` VALUES (102, 1, 'file', 0, 0, '21.jpg', 'upload/20220820/3d30154257c3f8ee1da98ba173d531a4.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 117.02, '9bc191479245104aec7df37615ea7360', 'a4435d985ec8c0b81ad2d88484dd9402ea6833f3', 'public', '', '', '/upload/20220820/3d30154257c3f8ee1da98ba173d531a4.jpg', 1660981187);
INSERT INTO `tp_file` VALUES (103, 1, 'file', 0, 0, '1.jpg', 'upload/20220820/5f44c0f7730c9d06d1980adf4be05815.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 202.19, 'e2a6604e69cf342e2ad803bb8ed4f49f', 'fc69bd3dc3883ce1c7dffe1c6f759e9d28935b40', 'public', '', '', '/upload/20220820/5f44c0f7730c9d06d1980adf4be05815.jpg', 1660981250);
INSERT INTO `tp_file` VALUES (104, 1, 'file', 0, 0, '21.jpg', 'upload/20220820/ca77dbbb4a93ebfd1b1d655c14f00bbc.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 336.32, '2a34ece129859e6e211edc92589efeb5', '0af1b8b621f5fda00c17f121b2f024ce3efb043c', 'public', '', '', '/upload/20220820/ca77dbbb4a93ebfd1b1d655c14f00bbc.jpg', 1660981380);
INSERT INTO `tp_file` VALUES (105, 1, 'file', 0, 0, '20.jpg', 'upload/20220820/6cdfadd7f475a65e7a70c75442e50b37.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 162.58, '85d41d3d955cd4a9daeb1b9c3c57a812', 'b40f089bcb604d23364b47c09777a7a8e7af5065', 'public', '', '', '/upload/20220820/6cdfadd7f475a65e7a70c75442e50b37.jpg', 1660981453);
INSERT INTO `tp_file` VALUES (106, 1, 'file', 0, 0, '3.jpg', 'upload/20220820/01906a2f4498bcc53adc9a3ae163efc8.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 101.88, 'fd66df954041d5dde9447d2ece83d4f0', '64f4bffabd6cb78b466437977fb1893c93f6175d', 'public', '', '', '/upload/20220820/01906a2f4498bcc53adc9a3ae163efc8.jpg', 1660981798);
INSERT INTO `tp_file` VALUES (107, 1, 'file', 0, 0, '4.jpg', 'upload/20220820/457964937c29ca354b41c0eb69bf3185.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 100.51, 'e9a8c3b4af6dec9fd87feb95110ef128', '8d345ee7354a50a740fb2877e23e5961560e462d', 'public', '', '', '/upload/20220820/457964937c29ca354b41c0eb69bf3185.jpg', 1660981830);
INSERT INTO `tp_file` VALUES (108, 1, 'file', 0, 0, '2.jpg', 'upload/20220820/3b261e6da9921cd7f93f243a7594fd6f.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 61.76, 'dbe7327c321269ff95df3ff74fe9b71a', 'ba42a55ac0b726b6e8cfcf280a0a69a881579c72', 'public', '', '', '/upload/20220820/3b261e6da9921cd7f93f243a7594fd6f.jpg', 1660981911);
INSERT INTO `tp_file` VALUES (109, 1, 'file', 0, 0, '6.jpg', 'upload/20220820/a0560147ada1ca9a97e7027dacdd6bbb.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 239.28, '9f0290d12851d628b3e259eb6490c0b1', '7f62efdb3cedd0df37d6562ddafba92e039eee8c', 'public', '', '', '/upload/20220820/a0560147ada1ca9a97e7027dacdd6bbb.jpg', 1660981970);
INSERT INTO `tp_file` VALUES (110, 1, 'file', 0, 0, '5.jpg', 'upload/20220820/a946c690af7d013808b4b0ff85829feb.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 272.77, 'efb2ff3cb8008f2c92c919df80d6687c', 'd277a694cf358e9467038cedc768348baf41627e', 'public', '', '', '/upload/20220820/a946c690af7d013808b4b0ff85829feb.jpg', 1660981995);
INSERT INTO `tp_file` VALUES (111, 1, 'file', 0, 0, '7.jpg', 'upload/20220820/b1a3fd349b237bfaef25420e404c68db.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 139.46, '78dfc4fd20bfdd8181604329ea848454', '7fac56b3d2f963b1aec5087bd706a13985d27d60', 'public', '', '', '/upload/20220820/b1a3fd349b237bfaef25420e404c68db.jpg', 1660982048);
INSERT INTO `tp_file` VALUES (112, 1, 'file', 0, 0, '8.jpg', 'upload/20220820/002861488924e184aa6080718f455a08.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 134.34, '78e2aa6f83813080d134d2bbaf639891', '5726410376c5d032b0f1c194b20f60cc3ad9cef1', 'public', '', '', '/upload/20220820/002861488924e184aa6080718f455a08.jpg', 1660982088);
INSERT INTO `tp_file` VALUES (113, 1, 'file', 0, 0, '9.jpg', 'upload/20220820/463ae5e51f7b26c8100a73a0da01781e.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 164.25, '09ca3d5834af6dff40b6f5656476abc6', 'aa23a4c01ee2ed39d5e276f862d5b605affb293f', 'public', '', '', '/upload/20220820/463ae5e51f7b26c8100a73a0da01781e.jpg', 1660982195);
INSERT INTO `tp_file` VALUES (114, 1, 'file', 0, 0, '10.jpg', 'upload/20220820/d4fddfd290584aacac16a551ec95afbd.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 148.12, '360b916203093ff035303ebe6a80076e', '13df50f9701e089c96e983d2fe26801428a9ad37', 'public', '', '', '/upload/20220820/d4fddfd290584aacac16a551ec95afbd.jpg', 1660982339);
INSERT INTO `tp_file` VALUES (115, 1, 'file', 0, 0, '12.jpg', 'upload/20220820/91bf5abfe1bc7517cfaed86b6037204a.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 133.72, '770973adfa76ad2fd5aa66b960b9f1ff', '56ddd2695a0300522a2ec8cc923fce72385d9554', 'public', '', '', '/upload/20220820/91bf5abfe1bc7517cfaed86b6037204a.jpg', 1660982396);
INSERT INTO `tp_file` VALUES (116, 1, 'file', 0, 0, '13.jpg', 'upload/20220820/976ff01228f9ba97d84b7597a5463c5c.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 113.86, '7567a8cbc8d1db4c4395ce1f3f0ae106', '10fae7f9086c11d4c2f9307c357c936586e86874', 'public', '', '', '/upload/20220820/976ff01228f9ba97d84b7597a5463c5c.jpg', 1660982428);
INSERT INTO `tp_file` VALUES (117, 1, 'file', 0, 0, '14.jpg', 'upload/20220820/ac623b3d4ae32f6adff16a869b0cdc2e.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 158.55, '7b4134d57263656db2955232891f0006', 'c60662c17ba5608c33cf0e680437c943dcb1305c', 'public', '', '', '/upload/20220820/ac623b3d4ae32f6adff16a869b0cdc2e.jpg', 1660982481);
INSERT INTO `tp_file` VALUES (118, 1, 'file', 0, 0, '15.jpg', 'upload/20220820/2315537e1d0a69c9732a752bda908767.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 128.58, '0faf159a4324200990e1a6bdd4311de2', 'd24cc99b3357c7c5ede7e1320be60fc321d68243', 'public', '', '', '/upload/20220820/2315537e1d0a69c9732a752bda908767.jpg', 1660982551);
INSERT INTO `tp_file` VALUES (119, 1, 'file', 0, 0, '17.jpg', 'upload/20220820/2f3655856f10042cffbcbf2e50984375.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 178.13, '3a71fcd98538d6c503d3997ff2d4f223', '457a60ed5629f04f1fdd19dc4788b6686df2fc53', 'public', '', '', '/upload/20220820/2f3655856f10042cffbcbf2e50984375.jpg', 1660982623);
INSERT INTO `tp_file` VALUES (120, 1, 'file', 0, 0, '18.jpg', 'upload/20220820/1d7bac34379a357b973658642be554c0.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 145.53, '196dfc2e2cffc9d714ff01aebbad44c6', '33ab055c8cb213f1f0bfbf99af6a98c6b4890350', 'public', '', '', '/upload/20220820/1d7bac34379a357b973658642be554c0.jpg', 1660982734);
INSERT INTO `tp_file` VALUES (121, 1, 'file', 0, 0, '19.jpg', 'upload/20220820/b97c31d884db5fe11667d855d8efda99.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 154.12, '684f49bcb61da2f073aad1b21d1077a2', '86334c76ebaf5a368fb4b14f91ba99d5a6c60fd6', 'public', '', '', '/upload/20220820/b97c31d884db5fe11667d855d8efda99.jpg', 1661220932);
INSERT INTO `tp_file` VALUES (122, 1, 'file', 0, 0, '20.jpg', 'upload/20220820/dbf68ad82bad5f0bc6881acefd1e3ba2.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 160.65, '7c68dcd01e92ebdb058295d78291e983', '4c35dfd8bdaf302f519bc3023e6c79b1adf69645', 'public', '', '', '/upload/20220820/dbf68ad82bad5f0bc6881acefd1e3ba2.jpg', 1660982788);
INSERT INTO `tp_file` VALUES (123, 1, 'file', 0, 0, '16.jpg', 'upload/20220820/2201b67ff9d62e1f51b589191f901029.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 142.28, '4262ae71c7834bbffbb4b54aa9b2e804', '1258a5a0fa76d17b15d62627b61b293e47c3993c', 'public', '', '', '/upload/20220820/2201b67ff9d62e1f51b589191f901029.jpg', 1660982843);
INSERT INTO `tp_file` VALUES (124, 1, 'file', 0, 0, '11.jpg', 'upload/20220820/e291c58bebd496ac65ce4111cfc87b94.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 110.08, '1130d77f19ade511ae158bb128618271', 'aeb3eaf8bdc1c741309568361b0f481b071130b6', 'public', '', '', '/upload/20220820/e291c58bebd496ac65ce4111cfc87b94.jpg', 1660982946);
INSERT INTO `tp_file` VALUES (125, 1, 'file', 0, 0, '微信图片_20220820163134.jpg', 'upload/20220820/f8a340b604e40daa93865bf3e319b30d.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 343.71, '452d6d74fba284a8257ad4b1bfcd3387', 'd3a40b6894076dfb66183a8efa5949a5ea2e55e7', 'public', '', '', '/upload/20220820/f8a340b604e40daa93865bf3e319b30d.jpg', 1660984479);
INSERT INTO `tp_file` VALUES (126, 1, 'file', 0, 0, '6.jpg', 'upload/20220821/c1354c8f570390a6b277aef8b1bcf8ac.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 155.31, '775746d860a3a26674150ac58314cb6f', '148a89b247570088e8b2d2914c00970eafa147b3', 'public', '', '', '/upload/20220821/c1354c8f570390a6b277aef8b1bcf8ac.jpg', 1661049271);
INSERT INTO `tp_file` VALUES (127, 1, 'file', 0, 0, '8.jpg', 'upload/20220821/34c3d880818182f2d74ab5009d891d49.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 229.38, '6084c9cc53222077ab19b66d34049cc3', 'd5544b80dd52dd69b414dc16332aa26e71ab90f5', 'public', '', '', '/upload/20220821/34c3d880818182f2d74ab5009d891d49.jpg', 1661049343);
INSERT INTO `tp_file` VALUES (128, 1, 'file', 0, 0, '9.jpg', 'upload/20220821/2339228ed4530426924c4d3cde3ecc9b.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 134.20, '2679373d5ea6dd88856dd98517ba7dd6', 'a665969e207eaf5c6049603cdfe88fd6e79577fc', 'public', '', '', '/upload/20220821/2339228ed4530426924c4d3cde3ecc9b.jpg', 1661049390);
INSERT INTO `tp_file` VALUES (129, 1, 'file', 0, 0, '3.jpg', 'upload/20220821/2c0f0f9e9e83e615d2db3b6c99083cd2.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 111.90, '80b938f86f5c78f155a3e12ce4d2b0a3', '0a49a7d6732fb0466290b0326dd6b1e91ac5cd2f', 'public', '', '', '/upload/20220821/2c0f0f9e9e83e615d2db3b6c99083cd2.jpg', 1661049432);
INSERT INTO `tp_file` VALUES (130, 1, 'file', 0, 0, '5.jpg', 'upload/20220821/f95f4c19b4fd69515d36583fcf5b58f4.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 183.14, 'f33d373401cad6e3b72fd9141daf4eb2', 'bdee301a02feb3b183ef375295af70e072670cc6', 'public', '', '', '/upload/20220821/f95f4c19b4fd69515d36583fcf5b58f4.jpg', 1661049480);
INSERT INTO `tp_file` VALUES (131, 1, 'file', 0, 0, '7.jpg', 'upload/20220821/7d462f278931f0e766fb7906627a0f6a.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 131.14, 'de919e474f900d1a1012733b143e1296', '3bd3a076acfb339ccabd73e6a9422d22e860a238', 'public', '', '', '/upload/20220821/7d462f278931f0e766fb7906627a0f6a.jpg', 1661049533);
INSERT INTO `tp_file` VALUES (132, 1, 'file', 0, 0, '10.jpg', 'upload/20220821/fa294b1f0bde8bbdcee63ef862d43d79.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 135.62, '35ec7e63fd2296cc196e56705f93b175', '42a2347bb09719ccc92dbc8965b8830dea93b28b', 'public', '', '', '/upload/20220821/fa294b1f0bde8bbdcee63ef862d43d79.jpg', 1661049576);
INSERT INTO `tp_file` VALUES (133, 1, 'file', 0, 0, '1.jpg', 'upload/20220821/537be1990ce20d64b1d67089254f65cc.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 115.77, '7f9675a0d2e347fc7a56bf64e5e1113e', '6cc11cc90d3e36b7b3f6d1c0fc9da9d8a7987871', 'public', '', '', '/upload/20220821/537be1990ce20d64b1d67089254f65cc.jpg', 1661049732);
INSERT INTO `tp_file` VALUES (134, 1, 'file', 0, 0, '微信图片_20220822151755.jpg', 'upload/20220822/713e5b33562f50089abc59067b2ace36.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 188.75, '25565124e35a94c5e425a5e5eda9a9b5', '7a4bd862e5b945a3f9f6955e397bb5be76b942e8', 'public', '', '', '/upload/20220822/713e5b33562f50089abc59067b2ace36.jpg', 1661152723);
INSERT INTO `tp_file` VALUES (135, 1, 'file', 0, 0, '微信图片_20220822151918.jpg', 'upload/20220822/4248e57b227a2fa636fec8743647e10a.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 108.40, '0ce16db4be49409dfd1914ec63a3781d', '312d9ded172f83d24a7341051a23e4a42ca11bcc', 'public', '', '', '/upload/20220822/4248e57b227a2fa636fec8743647e10a.jpg', 1661152799);
INSERT INTO `tp_file` VALUES (136, 1, 'file', 0, 0, '微信图片_20220822152157.jpg', 'upload/20220822/59caf09685e6ed4158ed2f585925e2bc.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 430.85, '9ec5ff2692e4fa9249dbb54be9c0d96c', '0813740ecfbcca186e30b94bc868fd660caf8111', 'public', '', '', '/upload/20220822/59caf09685e6ed4158ed2f585925e2bc.jpg', 1661152948);
INSERT INTO `tp_file` VALUES (137, 1, 'file', 0, 0, '微信图片_20220822152405.jpg', 'upload/20220822/bd2a78e7a21ab469718725c2d22db536.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 123.30, '4e47fd2e15d6a78426eb1c78d52d3242', '5dcd1fc142723affb7e5351a33c9d0e52d95880b', 'public', '', '', '/upload/20220822/bd2a78e7a21ab469718725c2d22db536.jpg', 1661153071);
INSERT INTO `tp_file` VALUES (138, 1, 'file', 0, 0, '微信图片_20220822153439.jpg', 'upload/20220822/33fab0dee71f11a0d619c87ee683f50f.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 282.62, 'c0275f04ebf766633df474c685516894', 'c0b9088fc988583b46a0c8f5e313e1ed5804b26e', 'public', '', '', '/upload/20220822/33fab0dee71f11a0d619c87ee683f50f.jpg', 1661153688);
INSERT INTO `tp_file` VALUES (139, 1, 'file', 0, 0, '微信图片_20220822153837.jpg', 'upload/20220822/d4a56c81ba6002bc034cc8232e2e8ef9.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 66.20, 'bf0cb62fe257165997317c7bf7e4ab23', 'e5a56c413b09d08242cabcebf2209740617041ff', 'public', '', '', '/upload/20220822/d4a56c81ba6002bc034cc8232e2e8ef9.jpg', 1661154092);
INSERT INTO `tp_file` VALUES (140, 1, 'file', 0, 0, '微信图片_20220822175211.jpg', 'upload/20220822/21401bda63746c8cf5679f7cc60c32e9.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 141.32, '13121c3746b7f817c7bc102ca9bc420c', 'b71358cc5673dcf7beaa6571c753742e8c73bd06', 'public', '', '', '/upload/20220822/21401bda63746c8cf5679f7cc60c32e9.jpg', 1661161943);
INSERT INTO `tp_file` VALUES (141, 1, 'file', 0, 0, '微信图片_20220822175257.jpg', 'upload/20220822/74f82ff023600c56467251bf94c363b1.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 243.09, 'a17d2a272f2652974ac62a8ae1c0888c', 'd2f29ddcda567e1045c97e85336520fa3dc66ada', 'public', '', '', '/upload/20220822/74f82ff023600c56467251bf94c363b1.jpg', 1661161984);
INSERT INTO `tp_file` VALUES (142, 1, 'file', 0, 0, '微信图片_20220822175415.jpg', 'upload/20220823/ea8e9ab479a4c2526d0248270c8c71e3.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 314.38, '18f1e9d712f9483f9e11d85898cb5d0f', 'e7843f2062dfd3ccfe45b83fd2c380b29f6b16bf', 'public', '', '', '/upload/20220823/ea8e9ab479a4c2526d0248270c8c71e3.jpg', 1661220449);
INSERT INTO `tp_file` VALUES (143, 1, 'file', 0, 0, '微信图片_20220823101807.jpg', 'upload/20220823/e0811b042b6a189cb684d8204f213f16.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 117.08, '3f73082deddbbd50ed8338129e75a1f2', '09d8a8c44cb611b966c57d19095efe4b57d0fd76', 'public', '', '', '/upload/20220823/e0811b042b6a189cb684d8204f213f16.jpg', 1661221143);
INSERT INTO `tp_file` VALUES (144, 1, 'file', 0, 0, '微信图片_20220822175410.jpg', 'upload/20220823/ec4066ed1f6b4c8f23a9ed1917993a68.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 152.85, '5818a4452611704eb8b1b8317585800a', '1a7bbfc64fe747b859d8a0c71ed9fc005d9f088e', 'public', '', '', '/upload/20220823/ec4066ed1f6b4c8f23a9ed1917993a68.jpg', 1661221240);
INSERT INTO `tp_file` VALUES (145, 1, 'file', 0, 0, '微信图片_20220823104656.jpg', 'upload/20220823/eb18a6cc86094dce2e068f3e7fd32cf8.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 44.44, 'd5764337df12d0a1be96c8f057ff3052', 'f85095099aa43dc9ee308bbe5b20854e512b9c0d', 'public', '', '', '/upload/20220823/eb18a6cc86094dce2e068f3e7fd32cf8.jpg', 1661222844);
INSERT INTO `tp_file` VALUES (146, 1, 'file', 0, 0, '活动.jpg', 'upload/20220913/61dcd0827c7705b74d095d9785b51801.jpg', 'upload', 'jpg', 'image/jpeg', 'M', 1.77, '3f5496433b298194803074fd0f7b076f', 'a4ada684264a1e9347d2f43298af97851b76ec94', 'public', '', '', '/upload/20220913/61dcd0827c7705b74d095d9785b51801.jpg', 1663006472);
INSERT INTO `tp_file` VALUES (147, 1, 'file', 0, 0, '快乐世界尤克里里音乐.mp3', 'upload/20220915/237773ada517af10c2cbba1bb12b5276.mp3', 'upload', 'mp3', 'audio/mp3', 'M', 1.99, '809eea28c61418ff0f0b6b97e8a23ef4', '82c8e00aa0e73a9f2b9d16dab56df1c416bfbc99', 'public', '', '', '/upload/20220915/237773ada517af10c2cbba1bb12b5276.mp3', 1663214277);
INSERT INTO `tp_file` VALUES (148, 1, 'file', 0, 0, 'fxhb.jpg', 'upload/20220915/240fef267e58ff4884eb8bfe1f291d3b.jpg', 'upload', 'jpg', 'image/jpeg', 'KB', 154.13, '5fb9d5c1dd1e0b9cf113398f74d8f84b', '7ef8345bc2b83c4e23706ec5386ca0acf1b1dfc8', 'public', '', '', '/upload/20220915/240fef267e58ff4884eb8bfe1f291d3b.jpg', 1663226251);
COMMIT;

-- ----------------------------
-- Table structure for tp_file_type
-- ----------------------------
DROP TABLE IF EXISTS `tp_file_type`;
CREATE TABLE `tp_file_type` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `type_name` char(50) CHARACTER SET utf8 NOT NULL COMMENT '分类名称',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='文件分类';

-- ----------------------------
-- Records of tp_file_type
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_log`;
CREATE TABLE `tp_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `uid` smallint(6) NOT NULL COMMENT '操作帐号ID',
  `nickname` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '用户名称',
  `time` int(11) NOT NULL COMMENT '操作时间',
  `ip` char(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0错误提示，1为正确提示',
  `info` text CHARACTER SET utf8 NOT NULL COMMENT '其他说明',
  `data` text CHARACTER SET utf8 NOT NULL COMMENT '提交数据',
  `url` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'get数据',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `username` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='后台操作日志表';

-- ----------------------------
-- Records of tp_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_module
-- ----------------------------
DROP TABLE IF EXISTS `tp_module`;
CREATE TABLE `tp_module` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `module` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '模块目录名称',
  `module_name` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '模块名称',
  `icon` varchar(60) CHARACTER SET utf8 DEFAULT NULL COMMENT '应用图标',
  `is_core` tinyint(1) NOT NULL DEFAULT '0' COMMENT '内置模块1是0否',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关闭1是0否',
  `author` varchar(60) CHARACTER SET utf8 DEFAULT NULL COMMENT '作者',
  `introduce` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '说明',
  `version` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '版本号',
  `setting` text CHARACTER SET utf8 COMMENT '模块配置',
  `install_time` int(11) NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `admin_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '管理入口',
  `web_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '前端入口',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `is_core` (`is_core`) USING BTREE,
  KEY `disabled` (`disabled`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='安装模块表';

-- ----------------------------
-- Records of tp_module
-- ----------------------------
BEGIN;
INSERT INTO `tp_module` VALUES (1, 'article', 'CMS模块', '&#xe681', 0, 0, 'YmJ', 'CMS模块', '1.0.0', NULL, 1655192583, 1655192583, 'article/admin.article/lists', 'article/index/index');
INSERT INTO `tp_module` VALUES (2, 'city', '城市模块', '&#xe642', 0, 0, 'YmJ', '全国省市区数据管理', '1.0.0', NULL, 1655192590, 1655192590, 'city/city/index', 'city/index/index');
INSERT INTO `tp_module` VALUES (3, 'sms', '短信模块', '&#xe65a', 0, 0, 'YmJ', '短信模块', '1.0.0', NULL, 1655192743, 1655192743, 'sms/index/index', '');
INSERT INTO `tp_module` VALUES (4, 'swiper', '轮播图模块', '&#xe61e', 0, 0, 'WH', 'swiper模块', '1.0.0', NULL, 1655192749, 1655192749, 'swiper/index/index', '');
INSERT INTO `tp_module` VALUES (12, 'sign', '签到模块', '&#xe68b', 0, 0, 'ymj', '签到模块', '1.0.0', NULL, 1660389263, 1660389263, 'sign/index/index', '');
COMMIT;

-- ----------------------------
-- Table structure for tp_position
-- ----------------------------
DROP TABLE IF EXISTS `tp_position`;
CREATE TABLE `tp_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '推荐位ID',
  `position_name` text NOT NULL COMMENT '推荐位名称',
  `max` smallint(5) NOT NULL DEFAULT '0' COMMENT '最大储存数据',
  `tag` char(20) NOT NULL COMMENT '调用标签',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='推荐位';

-- ----------------------------
-- Records of tp_position
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_position_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_position_data`;
CREATE TABLE `tp_position_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目id',
  `posid` int(11) NOT NULL DEFAULT '0' COMMENT '推荐位ID',
  `module` char(20) NOT NULL COMMENT '所属模型',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `data` text NOT NULL COMMENT '数据信息	',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `syn_edit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否同步编辑[1是,否]',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `posid` (`posid`),
  KEY `module` (`module`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='推荐位数据内容';

-- ----------------------------
-- Records of tp_position_data
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_prestore
-- ----------------------------
DROP TABLE IF EXISTS `tp_prestore`;
CREATE TABLE `tp_prestore` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '预存ID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '预存金额',
  `note` varchar(250) NOT NULL COMMENT '预存说明',
  `handler` varchar(60) NOT NULL COMMENT '经办人',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='用户账户预存';

-- ----------------------------
-- Records of tp_prestore
-- ----------------------------
BEGIN;
INSERT INTO `tp_prestore` VALUES (1, 2, 5.00, '预存测试', '系统管理员', 1658995950);
INSERT INTO `tp_prestore` VALUES (2, 67, 1026.00, '预存', '系统管理员', 1661335878);
INSERT INTO `tp_prestore` VALUES (3, 69, 999999.99, '水光', '系统管理员', 1662262778);
INSERT INTO `tp_prestore` VALUES (4, 69, 10000.00, '水光', '系统管理员', 1662262969);
INSERT INTO `tp_prestore` VALUES (5, 69, 10000.00, '水光', '系统管理员', 1662263049);
INSERT INTO `tp_prestore` VALUES (6, 70, 100000.00, '充值', '系统管理员', 1662275214);
INSERT INTO `tp_prestore` VALUES (7, 155, 13238.10, '9.9号拿货，在邹保康手里下的单，款已付平台', '系统管理员', 1662694451);
COMMIT;

-- ----------------------------
-- Table structure for tp_relation
-- ----------------------------
DROP TABLE IF EXISTS `tp_relation`;
CREATE TABLE `tp_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `grade_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '等级',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '微店ID',
  `referee_id` int(11) NOT NULL DEFAULT '0' COMMENT '推荐人ID',
  `team_id` text CHARACTER SET utf8 COMMENT '团队成员id，多个用逗号隔开',
  `referee_time` int(11) NOT NULL DEFAULT '0' COMMENT '推荐时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `grade_id` (`grade_id`) USING BTREE,
  KEY `referee_id` (`referee_id`) USING BTREE,
  KEY `referee_time` (`referee_time`),
  FULLTEXT KEY `team_id` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='推荐关系';

-- ----------------------------
-- Records of tp_relation
-- ----------------------------
BEGIN;
INSERT INTO `tp_relation` VALUES (1, 3, 1, 1, 2, NULL, 1656656433);
INSERT INTO `tp_relation` VALUES (2, 4, 1, 1, 2, NULL, 1656656433);
INSERT INTO `tp_relation` VALUES (3, 5, 1, 1, 2, NULL, 1656656433);
INSERT INTO `tp_relation` VALUES (4, 8, 0, 0, 1, '1,8', 1656782118);
INSERT INTO `tp_relation` VALUES (5, 9, 1, 1, 1, '1,9', 1657178095);
INSERT INTO `tp_relation` VALUES (6, 12, 1, 4, 11, '11,12', 1657250498);
INSERT INTO `tp_relation` VALUES (7, 143, 0, 0, 71, '71,143', 1662609147);
INSERT INTO `tp_relation` VALUES (8, 156, 1, 0, 1, '1,156', 1663167998);
COMMIT;

-- ----------------------------
-- Table structure for tp_relation_team
-- ----------------------------
DROP TABLE IF EXISTS `tp_relation_team`;
CREATE TABLE `tp_relation_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '推荐人ID',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '层级',
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `level` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='推荐关系表';

-- ----------------------------
-- Records of tp_relation_team
-- ----------------------------
BEGIN;
INSERT INTO `tp_relation_team` VALUES (1, 8, 1, 1, '2022-07-03 01:15:18');
INSERT INTO `tp_relation_team` VALUES (2, 9, 1, 1, '2022-07-07 15:14:55');
INSERT INTO `tp_relation_team` VALUES (3, 12, 11, 1, '2022-07-08 11:21:38');
INSERT INTO `tp_relation_team` VALUES (4, 143, 71, 1, '2022-09-08 11:55:15');
INSERT INTO `tp_relation_team` VALUES (5, 156, 1, 1, '2022-09-14 23:06:38');
COMMIT;

-- ----------------------------
-- Table structure for tp_sms_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_sms_log`;
CREATE TABLE `tp_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `result` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`(191)),
  KEY `status` (`status`),
  KEY `create_time` (`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='短信记录';

-- ----------------------------
-- Records of tp_sms_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_sms_template
-- ----------------------------
DROP TABLE IF EXISTS `tp_sms_template`;
CREATE TABLE `tp_sms_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态[1是,0否]',
  `template_id` int(11) NOT NULL DEFAULT '0' COMMENT '模板编号',
  `template_name` varchar(250) NOT NULL COMMENT '模板名称',
  `content` text NOT NULL COMMENT '模板内容',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `template_name` (`template_name`(191)),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='短信模板';

-- ----------------------------
-- Records of tp_sms_template
-- ----------------------------
BEGIN;
INSERT INTO `tp_sms_template` VALUES (1, 1, 1001, '验证码', '【巨龙崛起】验证码 {$code}，你正在使用验证码登陆功能，请勿转发或泄密，以免造成损失。');
INSERT INTO `tp_sms_template` VALUES (2, 1, 1000, '通用验证码', '【巨龙崛起】本次验证码为 {$code}，有效期为5分账，请勿转发或泄密。');
COMMIT;

-- ----------------------------
-- Table structure for tp_swiper
-- ----------------------------
DROP TABLE IF EXISTS `tp_swiper`;
CREATE TABLE `tp_swiper` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `tab` varchar(60) NOT NULL COMMENT '位置及调用标识',
  `note` varchar(500) NOT NULL COMMENT '说明',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示[1是,0否]',
  `swiper` text NOT NULL COMMENT 'swiper图片',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='swiper管理';

-- ----------------------------
-- Records of tp_swiper
-- ----------------------------
BEGIN;
INSERT INTO `tp_swiper` VALUES (1, '新推广海报', 'user_posters', '推广海报', 0, 1, 'a:3:{i:0;a:4:{s:4:\"name\";s:7:\"海报1\";s:3:\"num\";s:1:\"1\";s:3:\"pic\";s:74:\"https://ai.sosucn.com/upload/20220802/d9dd05a0f17af67430a18244e6bf6b3d.jpg\";s:3:\"url\";s:0:\"\";}i:1;a:4:{s:4:\"name\";s:7:\"海报2\";s:3:\"num\";s:1:\"2\";s:3:\"pic\";s:74:\"https://ai.sosucn.com/upload/20220802/9cfbd55ba33c839c6c46f70e7878e166.jpg\";s:3:\"url\";s:0:\"\";}i:2;a:4:{s:4:\"name\";s:7:\"海报3\";s:3:\"num\";s:1:\"3\";s:3:\"pic\";s:74:\"https://ai.sosucn.com/upload/20220802/f33b00739351138883ebdf53941fa4b5.jpg\";s:3:\"url\";s:0:\"\";}}');
INSERT INTO `tp_swiper` VALUES (2, '首页轮播图', 'mp_index', '首页轮播图', 0, 1, 'a:3:{i:0;a:4:{s:4:\"name\";s:2:\"01\";s:3:\"num\";s:2:\"01\";s:3:\"pic\";s:74:\"https://ai.sosucn.com/upload/20220813/7ac37dd6f4b70889137c45fd13334aae.jpg\";s:3:\"url\";s:41:\"https://ai.sosucn.com/article/tgrw/1.html\";}i:1;a:4:{s:4:\"name\";s:2:\"02\";s:3:\"num\";s:2:\"02\";s:3:\"pic\";s:74:\"https://ai.sosucn.com/upload/20220813/1e5830f2c22dab502a2abfadd5b212cb.jpg\";s:3:\"url\";s:27:\"/pages/activity/detail?id=2\";}i:2;a:4:{s:4:\"name\";s:2:\"03\";s:3:\"num\";s:2:\"03\";s:3:\"pic\";s:74:\"https://ai.sosucn.com/upload/20220813/d9d86364ea0d7451e5ed82d653656408.jpg\";s:3:\"url\";s:0:\"\";}}');
COMMIT;

-- ----------------------------
-- Table structure for tp_tags
-- ----------------------------
DROP TABLE IF EXISTS `tp_tags`;
CREATE TABLE `tp_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `tag` varchar(60) NOT NULL DEFAULT '' COMMENT '标签名称',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '包含信息条数',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击次数',
  `last_hit_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后点击时间',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重[数字越大越靠前]',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `tag` (`tag`),
  KEY `hits` (`hits`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='标签统计表';

-- ----------------------------
-- Records of tp_tags
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_tags_content
-- ----------------------------
DROP TABLE IF EXISTS `tp_tags_content`;
CREATE TABLE `tp_tags_content` (
  `id` int(11) NOT NULL DEFAULT '11' COMMENT '标签ID',
  `tag` varchar(60) NOT NULL DEFAULT '' COMMENT '标签名称',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `module` varchar(60) DEFAULT NULL COMMENT '模型表明',
  `content_id` int(11) NOT NULL DEFAULT '0' COMMENT '内容ID',
  `cat_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `summary` varchar(500) NOT NULL DEFAULT '' COMMENT '摘要描述',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图',
  `data` varchar(500) NOT NULL DEFAULT '' COMMENT '内容自定义数据',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `title` (`title`(191)),
  KEY `module` (`module`),
  KEY `content_id` (`content_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='标签内容表';

-- ----------------------------
-- Records of tp_tags_content
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activation` tinyint(1) NOT NULL DEFAULT '0' COMMENT '激活状态 1为激活',
  `shop_id` smallint(11) NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `store_id` smallint(11) NOT NULL DEFAULT '0' COMMENT '门店ID',
  `type_id` smallint(6) NOT NULL DEFAULT '1' COMMENT '类型',
  `grade_id` smallint(6) NOT NULL DEFAULT '1' COMMENT '等级',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态',
  `username` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '密码',
  `mobile` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '邮箱',
  `user_number` varchar(20) NOT NULL DEFAULT '' COMMENT '会员编号',
  `reg_time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '注册ip',
  `del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除',
  `login` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `last_login_ip` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '最后登陆ip',
  `login_key` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '登录码',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `activation` (`activation`) USING BTREE,
  KEY `type_id` (`type_id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `username` (`username`) USING BTREE,
  KEY `mobile` (`mobile`) USING BTREE,
  KEY `email` (`email`) USING BTREE,
  KEY `reg_time` (`reg_time`) USING BTREE,
  KEY `last_login_time` (`last_login_time`) USING BTREE,
  KEY `update_time` (`update_time`) USING BTREE,
  KEY `grade_id` (`grade_id`),
  KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='会员表';

-- ----------------------------
-- Records of tp_user
-- ----------------------------
BEGIN;
INSERT INTO `tp_user` VALUES (1, 0, 0, 0, 2, 1, 1, '18080809090', '968a493057df71b073143a13f4be905b', '18080809090', '', '', 1663735592, '::1', 0, 0, 0, '0', '', 1663735592);
COMMIT;

-- ----------------------------
-- Table structure for tp_user_account
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_account`;
CREATE TABLE `tp_user_account` (
  `uid` int(11) NOT NULL COMMENT '会员id',
  `growth` int(11) NOT NULL DEFAULT '0' COMMENT '成长值',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `prestore` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '预存金额',
  PRIMARY KEY (`uid`) USING BTREE,
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `klb` (`growth`),
  KEY `integral` (`integral`),
  KEY `amount` (`amount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='会员账户表';

-- ----------------------------
-- Records of tp_user_account
-- ----------------------------
BEGIN;
INSERT INTO `tp_user_account` VALUES (1, 0, 0, 0.00, 0.00);
COMMIT;

-- ----------------------------
-- Table structure for tp_user_address
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_address`;
CREATE TABLE `tp_user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' 默认收货地址（0否，1是）',
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '联系人',
  `phone` varchar(12) NOT NULL DEFAULT '' COMMENT '手机号',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '所在区域id',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '省市区',
  `del_time` int(11) NOT NULL DEFAULT '0' COMMENT '是否删除（1删除）',
  `street` varchar(255) NOT NULL DEFAULT '' COMMENT '所在街道',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `is_default` (`is_default`) USING BTREE,
  KEY `area_id` (`city_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='收货地址';

-- ----------------------------
-- Records of tp_user_address
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_user_data
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_data`;
CREATE TABLE `tp_user_data` (
  `uid` int(11) NOT NULL COMMENT '会员id',
  `nickname` varchar(60) NOT NULL DEFAULT '' COMMENT '昵称',
  `invite_code` varchar(255) NOT NULL DEFAULT '' COMMENT '邀请码',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `sex` char(6) NOT NULL DEFAULT '' COMMENT '性别',
  `age` smallint(6) NOT NULL DEFAULT '0' COMMENT '年龄',
  `birthday` varchar(60) NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `province` varchar(60) NOT NULL DEFAULT '' COMMENT '省份',
  `city` varchar(60) NOT NULL DEFAULT '' COMMENT '城市',
  `district` varchar(60) NOT NULL DEFAULT '' COMMENT '区县',
  `area_id` int(11) NOT NULL DEFAULT '0' COMMENT '区域id',
  `street` varchar(255) NOT NULL DEFAULT '' COMMENT '街道地址',
  PRIMARY KEY (`uid`) USING BTREE,
  UNIQUE KEY `uid` (`uid`) USING BTREE,
  KEY `area_id` (`area_id`) USING BTREE,
  KEY `nickname` (`nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='会员附表';

-- ----------------------------
-- Records of tp_user_data
-- ----------------------------
BEGIN;
INSERT INTO `tp_user_data` VALUES (1, 'admin', '', '', '', 0, '0000-00-00', '', '', '', 0, '');
COMMIT;

-- ----------------------------
-- Table structure for tp_user_grade
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_grade`;
CREATE TABLE `tp_user_grade` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `grade_type_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型ID',
  `grade_name` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '等级名称',
  `growth` int(11) NOT NULL DEFAULT '0' COMMENT '所需成长值',
  `discount` decimal(11,1) NOT NULL DEFAULT '0.0' COMMENT '折扣',
  `integral` decimal(8,1) NOT NULL DEFAULT '0.0' COMMENT '积分倍数',
  `del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除[1是,0否]',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='会员等级';

-- ----------------------------
-- Records of tp_user_grade
-- ----------------------------
BEGIN;
INSERT INTO `tp_user_grade` VALUES (1, 0, '普通会员', 0, 0.0, 1.0, 0, 1);
INSERT INTO `tp_user_grade` VALUES (2, 0, 'vip会员', 10000, 0.0, 1.0, 0, 2);
COMMIT;

-- ----------------------------
-- Table structure for tp_user_record
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_record`;
CREATE TABLE `tp_user_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1消费、2充值、3提现、4收益、5奖励、6转入',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '对局ID',
  `order_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '对局编号',
  `note` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '说明',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `growth` int(11) NOT NULL DEFAULT '0' COMMENT '成长值',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `prestore` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '预存金额',
  `admin_name` varchar(60) NOT NULL COMMENT '操作人姓名',
  `data` text CHARACTER SET utf8 COMMENT '记录数据',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '记录时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `add_time` (`add_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='账户记录';

-- ----------------------------
-- Records of tp_user_record
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_user_security
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_security`;
CREATE TABLE `tp_user_security` (
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `security` varchar(255) NOT NULL COMMENT '安全密码',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='用户安全码';

-- ----------------------------
-- Records of tp_user_security
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_user_sign
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_sign`;
CREATE TABLE `tp_user_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户uid',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '获得积分',
  `growth` int(11) NOT NULL DEFAULT '0' COMMENT '获得金币',
  `month` varchar(60) NOT NULL DEFAULT '' COMMENT '月份',
  `total` smallint(5) NOT NULL DEFAULT '0' COMMENT '累计签到次数',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='签到记录表';

-- ----------------------------
-- Records of tp_user_sign
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_user_signcfg
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_signcfg`;
CREATE TABLE `tp_user_signcfg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `day` varchar(60) NOT NULL COMMENT '第几天',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '奖励积分',
  `growth` int(11) NOT NULL DEFAULT '0' COMMENT '奖励成长值',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='签到配置';

-- ----------------------------
-- Records of tp_user_signcfg
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_user_token
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_token`;
CREATE TABLE `tp_user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户 id',
  `token` varchar(500) CHARACTER SET utf8 NOT NULL COMMENT 'token',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `expires_time` datetime NOT NULL COMMENT '到期事件',
  `login_ip` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户登陆token';

-- ----------------------------
-- Records of tp_user_token
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tp_user_type
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_type`;
CREATE TABLE `tp_user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户类型ID',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='用户类型表';

-- ----------------------------
-- Records of tp_user_type
-- ----------------------------
BEGIN;
INSERT INTO `tp_user_type` VALUES (1, '普通用户', 0);
INSERT INTO `tp_user_type` VALUES (2, '高级用户', 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
