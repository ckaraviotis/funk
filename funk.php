<?php
#
# funk, a very simple PHP & Markdown blogging framework
#
# Copyright (c) 2012 Christian Karaviotis
# See LICENSE.txt for more info
#
# TODO
# - archive
# - limit posts on front page to latest n
# - filter by categories

define ('POST_DIRECTORY', "./posts/");
define ('ARTICLE_CLASS', "post");
define ('VERSION', "D.20121201");
define ('POST_LIMIT', 3);
define ('DEBUG', true);

if(DEBUG) {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
}

$current;
$archive;
$pl_enabled = true;

GetPostList();

/*
 * Return an array of Posts, using the Post date as the array index
 * 
 * This is the main function of the funk platform. It builds an array containing Post objects.
 * The format looks something like this:
 *
 * [1354030400] => Post Object
 *        (
 *           [date] => 1354030400
 *           [name] => test_post.txt
 *           [path] => ./posts/test_posts/
 *       )
 *
 * The array is reverse sorted based on the key, which is the unix date.
 *
 */
function GetPostList() {
    global $current, $archive;
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(POST_DIRECTORY));
    
    foreach($it as $fileinfo) {
        if($fileinfo->isFile()) {
            $name = $fileinfo->getFilename();
            $path = $fileinfo->getPath()."/";
            $date = $fileinfo->getMTime();
            $files[$date] = new Post($date, $name, $path);
        }
    }
    krsort($files);
       
    if (POST_LIMIT > count($files)) { $i = count($files); }
    else { $i = POST_LIMIT; }
    
    while ($i > 0) {
        $out[$i] = array_shift($files);
        $i--;
    }

    $current = $out;
    $archive = $files;
}

/*
 * So I know I said the last function was the main function, but really this is
 * probably the main one. It's the only function users need to actually call.
 * It will return all of the posts as a string.
 */
function GetAllPosts() {
    global $current;
    $builder = '';
    foreach($current as $post) { 
        $open_head = '<article class="'.ARTICLE_CLASS.'"><header>';
        $close_head = '</header>';
        $open_foot = '<footer>posted on ';              
        $mid_foot = ' in <span class="category">';
        $close_foot = '</span></footer></article>';
        
        $builder .= $open_head . GetPostTitle($post) . $close_head . GetPost($post) . $open_foot . GetPostDate($post) . $mid_foot . GetPostCategory($post) . $close_foot;
        
     }
    return $builder;
}

function GetArchivesList() {
    global $archive;
    $ml;
    $i = count($archive)-1;
    $builder = '';
    
    // Create array
    
    // stop
    // what do we want to do
    // loop through the array obv
    // first we need all the unique YEARs
    // then for each yeah, we need all the unique MONTHS
    // then under that, the post titles
    // like so
    // 2012
    //    |-- November
    //            |-- Post one
    //            |-- Post two
    //    |-- December
    //            |-- Post one
    // We need a better data structure
    // Post already describes date. all this data can be pulled from that.
    // think about this later. Lets put it on the screen.
    
    while($i >= 0) {
        $ml[$i] = date('m',$archive[$i]->GetDate());
        
        if($i < count($ml)-1) {
            if($ml[$i] == $ml[$i+1]) {
                $tmp = array_pop($ml);
            }
        }
        
        $i--;
    }


   
    return $ml;
}

function ToggleAllPosts() {
    global $pl_enabled;
    $pl_enabled = !$pl_enabled;
}
 
/*
 * Send us back the file name of a Post object, but with spaces replacing underscores,
 * extension removed, and nicely capitalised.
 */
function GetPostTitle($post) {
    return ucwords(strtolower(str_replace("_", " ", substr($post->GetName(), 0, strrpos($post->GetName(), '.')))));
}

/*
 * Return a nicely formated date line from a Post object
 * with a correct datetime attribute
 */
function GetPostDate($post) {
    $innerDate = date('Y-m-d', $post->GetDate());
    $niceDate = date('j<\s\u\p>S</\s\u\p> M, Y', $post->GetDate());
    
    return "<time datetime=" . $innerDate . ">" . $niceDate . "</time>";
}

/*
 * Return the category from the Post object
 */
function GetPostCategory($post) {
    return $post->GetCategory();
}

/*
 * Return the Markdown of the file in the given Post object
 */
function GetPost($post) {
    $p = $post->GetPath();
    $n = $post->GetName();
    return Markdown(file_get_contents($p.$n));
}

/*
 * Return the funk tag! Logo's all up in this hizzy
 */
function funkTag() {
    return '<a href="#"><img src="img/funk.png" alt="the funk logo" width="32" height="32"/ title="powered by funk&#013;version '.VERSION.'"></a>';
}

/*
 * Our Post Object
 */
class Post {
    private $date;
    private $name;
    private $path;
    private $category;
    
    public function __construct($d, $n, $p) {
        $this->date = $d;
        $this->name = $n;
        $this->path = $p;
        $this->category = $this->AnalyseCategory();
    }
    
    /*
     * Work out our category
     */
    private function AnalyseCategory() {
        if(!strcmp($this->path, POST_DIRECTORY) == 0) {
            // Old horribleness
            // $p = ucwords(str_replace("_", " ", substr_replace(substr(strtolower($this->path), strlen(POST_DIRECTORY)), "", -1)));
            // new, brighter, shinier horribleness
            $ary = explode("/", $this->path);
            $tmp = array_shift($ary);
            $tmp = array_shift($ary);
            $tmp = array_pop($ary);
            $out = "";
            
            for($i = 0; $i<count($ary);$i++) {
                if($i>0) $out .= " &rarr; ";
                $out .= ucwords(str_replace("_", " ", strtolower($ary[$i])));
            }

            return $out;
            
        }
        else {
            return "General";
        }
    }
    
    public function GetDate() {
        return $this->date;
    }
    
    public function GetCategory() {
        return $this->category;
    }
    
    public function GetName() {
        return $this->name;
    }
    
    public function GetPath() {
        return $this->path;
    }
}