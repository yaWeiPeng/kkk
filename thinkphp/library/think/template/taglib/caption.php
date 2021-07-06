<?php
// 自定义标签

namespace think\template\taglib;

use think\template\TagLib;

class caption extends Taglib
{

    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'category'        	=> ['attr' => 'key,value,type,field,pid,status'],
        'field'       		=> ['attr' => 'caption,id', 'close' => 0],
        'search'        	=> ['attr' => 'caption,key,value'],
    ];

	/**
	* category标签解析
	* 格式：
	* {caption:category name="v"}
	* {v.username}
	* {v.email}
	* {/caption:category}
	*/
    public function tagCategory($tag, $content)
    {
		$key = isset($tag['key']) ? $tag['key'] : 'k';
		$value = isset($tag['value']) ? $tag['value'] : 'v';
		$type = isset($tag['type']) ? $tag['type'] : 'top';
		$pid = isset($tag['pid']) ? $tag['pid'] : '';
		$field = isset($tag['field']) ? $tag['field'] : '';
		$status = isset($tag['status']) ? $tag['status'] : '';
		
		$parseStr = '<?php ';
		$parseStr .= '$tagColumn = new \think\template\taglib\caption\tagColumn;';
		$parseStr .= '$taglist = $tagColumn->getColumn("'.$type.'","'.$pid.'","'.$field.'","'.$status.'");';
        $parseStr .= 'foreach($taglist as $'.$key.'=>$'.$value.'): ?>';
		$parseStr .= $content;
		$parseStr .= '<?php endforeach; ?>';
        return $parseStr;
    }
	
	/**
	* field标签解析
	* 格式：
	* {caption:field caption="" /}
	*/
	public function tagField($tag)
	{
		$caption = isset($tag['caption']) ? $tag['caption'] : '';
		$id = $tag['id'];
		$id = $this->autoBuildVar($id);
		if($caption == ''){
		 return false;
		}
		$parseStr = '<?php ';
		$parseStr .= '$tagField = new \think\template\taglib\caption\tagField;';
		$parseStr .= '$tagFieldstr = $tagField->getFieldstr("'.$caption.'",'.$id.');';
		$parseStr .= 'echo $tagFieldstr;'; 
		$parseStr .= ' ?>';
		return $parseStr;
	}
	 
	 /**
     * search标签解析
     * 格式：
     * {caption:search caption=""} {/caption:search}
     */
    public function tagSearch($tag, $content)
    {
		$key = isset($tag['key']) ? $tag['key'] : 'k';
		$value = isset($tag['value']) ? $tag['value'] : 'v';
		$caption = isset($tag['caption']) ? $tag['caption'] : '';
		if($caption == ''){
			return false;
		}
		$parseStr = '<?php ';
		$parseStr .= '$tagField = new \think\template\taglib\caption\tagField;';
		$parseStr .= '$tagFielddata = $tagField->getSearch("'.$caption.'");';
        $parseStr .= 'foreach($tagFielddata as $'.$key.'=>$'.$value.'): ?>';
		$parseStr .= $content;
		$parseStr .= '<?php endforeach; ?>';
		return $parseStr;
		
	}
   
}
