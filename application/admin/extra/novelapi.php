<?php
/**
 * 小说拉取
 */
namespace app\admin\extra;

use app\common\model\Novel as NovelModel;

class novelapi{
	
	static function pushnovel($url , $apiurl = ''){
		if(empty($apiurl)){
			return false;
		}else{
			$res = curl_link($url.$apiurl);
			//匹配标题
			$info = '/<div id="info">\s+\n+\s+<h1>(.*?)<\/h1>\s+\n+\s+<p>(.*?)<\/p>\s+\n+\s+<p>(.*?)<\/p>/';
			preg_match_all($info, $res, $newinfo);
			//匹配第一章
			$one = '/<dd><a href="(.*?)">/';
			preg_match_all($one, $res, $content);
			//小说更新状态
			$a = explode(',',$newinfo[3][0]);
			$b = explode('：',$a[0]);
			if($b[1] == '连载中'){
				$state = 1;
			}else{
				$state = 0;
			}
			if(empty($newinfo[1][0])){
				return false;
			}else{
				$data = ['title'=>$newinfo[1][0],'target_url'=>$url,'novel_state'=>$state];
				//$new_novel = Db::name('novel')->insert($data);
				$novelModel = new NovelModel;
				if($novelModel->save($data)){
					$res = ['nid'=>$novelModel->id,'one'=>$content[1][0],'url'=>$url];
					//dump($res);
					if(static::laqu($res)){
						return true;
					}
				}else{
					return false;
				}
			}
		}
	}
	
	static function laqu($data){
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
		model('novel_content')->saveAll($list,false);
		
		//更新最后抓取的章节
		(new NovelModel)->where('id',$res['novel_id'])->update(['last_url'=>$data['one']]);
		
		$data['one'] = $nexpage;
		//判断下一章是否存在
		$d = explode('/',$nexpage);
		if($d[2] == ''){
			return false;
		}else{
			static::laqu($data);
		}
	}
}