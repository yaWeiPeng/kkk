<?php
namespace app\admin\model;

use app\common\model\NovelContent as NovelContentModel;
use app\admin\model\Novel as NovelModel;

class NovelContent extends NovelContentModel
{
	//拉取小说
	public function doadd($data){
		if(!$this->laqu($data)){
			return true;
		}
	}
	
	public function laqu($data){
		$res = curl_link($data['url'].$data['one']);
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
		
		$res = ['title'=>$newtitle[1][0],'content'=>$newcontent[1][0],'nexpage'=>$nexpage,'novel_id'=>$data['nid']];
		
		$list = [
			['novel_id'=>$res['novel_id'],'title'=>$res['title'],'content'=>$res['content']],
		];
		$this->saveAll($list,false);
		
		//更新最后抓取的章节
		(new NovelModel)->where('id',$res['novel_id'])->update(['last_url'=>$data['one']]);
		
		$data['one'] = $nexpage;
		//判断下一章是否存在
		$d = explode('/',$nexpage);
		if($d[2] == ''){
			return false;
		}else{
			$this->laqu($data);
		}
	}
	
}