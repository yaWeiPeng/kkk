<?php
namespace app\api\controller\v1;

use think\Controller;
use app\common\model\NovelModel;
use app\common\model\NovelContentModel;

class Novel extends Base
{
	//
	public function NovelUpdate(){
		$data = NovelModel::where('novel_state',1)->field('id,target_url,last_url,novel_state')->select();
		$msg = '';
		$i = 1;
		foreach($data as $k=>$v){
			$res = curl_link($v['target_url'].$v['last_url']);
			//匹配章
			$page = '/var prevpage="(.*?)"\s+var nextpage="(.*?)"/';
			preg_match_all($page, $res, $newpage);
			//下一章
			$nexpage = $newpage[2][0];
			$d = explode('/',$nexpage);
			if($d[2] != ''){
				$msg = '一共'.$i++.'部小说更新了';
				$this->laqu($v);
			}else{
				$msg = '一共'.$i++.'部小说更新了';
			}
		}
		$f = fopen("../application/common/log/NovelUpdate.txt", "a+");
		$txt = date("Y-m-d H:i",time())."     ".$msg."\n";
		fwrite($f, $txt);
		fclose($f);
	}
	
	public function laqu($data){
		$res = curl_link($data['target_url'].$data['last_url']);
		//匹配标题
		$title = '/<div class="bookname">\s+\n+\s+<h1>(.*?)<\/h1>/';
		preg_match_all($title, $res, $newtitle);
		//echo $newtitle[1][0];
		//匹配内容
		$content = '/<div id="content">(.*?)<\/div>/';
		preg_match_all($content, $res, $newcontent);
		//echo '<br><br><br>'.$newcontent[1][0];
		//匹配上下章
		$page = '/var prevpage="(.*?)"\s+var nextpage="(.*?)"/';
		preg_match_all($page, $res, $newpage);
		
		//下一章
		$nexpage = $newpage[2][0];
		
		$res = ['title'=>$newtitle[1][0],'content'=>$newcontent[1][0],'nexpage'=>$nexpage,'novel_id'=>$data['id']];
		
		$list = [
			['novel_id'=>$res['novel_id'],'title'=>$res['title'],'content'=>$res['content']],
		];
		$NovelContent = new NovelContentModel;
		$NovelContent->saveAll($list);
		
		//更新最后抓取的章节
		NovelModel::where('id',$res['novel_id'])->update(['last_url'=>$data['last_url'],'update_time'=>time()]);
		
		$data['last_url'] = $nexpage;
		//判断下一章是否存在
		$d = explode('/',$nexpage);
		if($d[2] != ''){
			$this->laqu($data);
		}
	}
	
}


