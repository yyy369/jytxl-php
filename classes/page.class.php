<?php 
    /**
     * 分页类
     */
    class Page{
        private $pageSize; //每页要显示的条目数
        private $total; //要被分页显示的总记录数
        private $pageNum; //总页数
        private $page; //当前页码
        private $limit; //分页查询的limit子句
        private $start;  //当前页显示的起始记录号
        private $end;   //当前页显示的终止记录号
       
        /**
         * [__construct 初始化分页类]
         * @param [type]  $total    [description]
         * @param integer $pageSize [description]
         */
        public function __construct($total,$pageSize = 10){
            $this->total = $total;
            $this->pageSize = $pageSize;
            $this->pageNum = ceil($this->total/$this->pageSize);  
            if (!empty($_GET['page'])) {
                if ($_GET['page']<=$this->pageNum) {
                    $this->page = $_GET['page'];
                } else {
                    $this->page = 1;
                }           
                
            } else {
                $this->page = 1; //默认显示第1页
            }
            

            //设置limit子句
            $this->limit = $this->setLimit(); 

            //计算当前页的起始和终止序号
            $this->start = $this->pageSize*($this->page-1)+1;
            $this->end = min($this->pageSize*$this->page,$this->total);    
        }

        /**
         * [setLimit 私有函数，用于为limit属性赋值]
         */
        private function setLimit(){
            
                return "limit ".(($this->page-1)*$this->pageSize)." , {$this->pageSize}";        
            
        }
        /**
         * [__get 魔术方法，用于在外部获取私有属性]
         * @param  [string] $propertyName [要访问的属性名]
         * @return [string]               [读取limit时，返回limit子句]
         */
        public function __get($propertyName){
            if ($propertyName=='limit') {
                return $this->limit;
            } else {
                return null;
            }            
        }

        /**
         * [fpage 打印页码信息，调用时传递0-7数字]
         * 例如：fpage(0,1,2,3,4,5,6,7)。
         * 0 显示总计数
         * 1 显示每页条数
         * 2 显示当前页/总页
         * 3 显示当前页显示X-X条
         * 4 显示首页链接
         * 5 显示上一页链接
         * 6 显示下一页链接
         * 7 显示尾页链接
         * 
         * @return [string] [返回各类页码信息字符串]
         */
        public function fpage(){
            $arr = func_get_args();
            $link[0] = "<span>总计有{$this->total}条记录</span>&nbsp;";
            $link[1] = "<span>每页显示{$this->pageSize}条记录</span>&nbsp;";
            $link[2] = "<span>{$this->page}/{$this->pageNum}</span>&nbsp;";
            $link[3] = "<span>当前显示{$this->start}-{$this->end}条记录</span>&nbsp;";
            $prev = max(1,$this->page-1);
            $next = min($this->page+1,$this->pageNum);
            $link[4] = "<a href='?".$this->getUrl(1)."'>首页</a>";
            $link[5] = "<a href='?".$this->getUrl($prev)."'>上一页</a>";
            $link[6] = "<a href='?".$this->getUrl($next)."'>下一页</a>";
            $link[7] = "<a href='?".$this->getUrl($this->pageNum)."'>尾页</a>";
            $pagelink = "";
            for ($i=0; $i < count($arr); $i++) { 
                $pagelink .= $link[$arr[$i]];
            }
            return  $pagelink;
        }

        /**
         * [setUrl 根据页码获取带page=n的查询字符串，可以处理多参数的情况]
         * @param [int] $page [某一页]
         * @return [string] [追加或修改了page参数的查询字符串]
         */
        private function getUrl($page){
            //取得当前URL地址后的查询字符串
            $searchStr = $_SERVER['QUERY_STRING'];
            
            $i = strrpos($searchStr,'page=');
            if ($i!==false) {
                //如果包含page=，就更新成新的参数值
                $searchStr = substr_replace($searchStr,"page={$page}",$i);
            } else {
                //如果不包含page=,就追加
                $searchStr .= "&page={$page}";
            }        

            return $searchStr;
        }

    }

 ?>