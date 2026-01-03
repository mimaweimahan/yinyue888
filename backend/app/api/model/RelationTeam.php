<?php
/**
 * Created by PhpStorm.
 * Explain: 推荐关系网
 */
namespace app\api\model;
use think\Model;
use think\facade\Db;
class RelationTeam extends Model
{
    protected $name ='relation_team';
    /**
     * 用户视图
     * @return Db
     */
    public static function ListDb(){
        return Db::view('relation', '*')
            ->view('user', 'nickname,account,grade_id,mobile', 'user.id = relation.uid')
            ->view('user_grade', 'grade_name', 'user_grade.id = user.grade_id','LEFT')
            ->view('user_data','agent_area','user.id = user_data.uid')
            ->view('user_wallet', '*', 'user_wallet.uid = user.id','LEFT');
    }
    public static function teamDb(){
        return Db::view('relation_team','*')
            ->view('user','mobile,account,nickname,grade_id','user.id = relation_team.parent_id');
    }
}