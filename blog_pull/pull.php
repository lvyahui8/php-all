<?php
require_once __DIR__ . '/vendor/autoload.php';

use DiDom\Document;
use DiDom\Element;

/**
 * Created by PhpStorm.
 * User: lvyahui
 * Date: 2016/7/17
 * Time: 20:39
 */

function pushToMovesun($postData)
{
    $url = "http://movesun.com/admin/blog/edit";
}

$blogId = 200167;
$blogApp = 'lvyahui';

$bindData = array(
    'blogId'  => $blogId,
    'blogApp' => $blogApp,
);

$cnblogUrl = 'http://www.cnblogs.com';

$interfaces = array(
    'post_category_tags' => '/mvc/blog/CategoriesTags.aspx',
    'post_prev_next'     => '/post/prevnext',
    'blog_side_block'    => '/mvc/Blog/GetBlogSideBlocks.aspx',
    'post_comments'      => '/mvc/blog/GetComments.aspx',
    'post_view_count'    => '/mvc/blog/ViewCountCommentCout.aspx',
    'post_get_comments'  => '/mvc/blog/GetComments.aspx',
);

$listPage = $cnblogUrl . '/' . $bindData['blogApp'] . '/default.html';

$listPageParams = array(
    'page' => 1,
);

$doucument = new Document();

$doucument->loadHtml(file_get_contents($listPage));

$articleLinks = $doucument->find('.postTitle2');

foreach ($articleLinks as $articleLink) {
    $postData = array();

    // 处理文章内容
    $postUrl = $articleLink->attr('href');
    $start = strrpos($postUrl, '/') + 1;
    $postId = (substr($postUrl, $start, strrpos($postUrl, '.html') - $start));

    $postData['cnblogs_url'] = $postUrl;
    $postData['cnblogs_id'] = $postId;

    $postDoc = new Document();
    $postDoc->loadHtml(file_get_contents($postUrl));
    $postData['title'] = $postDoc->first('.postTitle2')->text();
    $content = $postDoc->first('#cnblogs_post_body');
    $attr = $postDoc->first('.postDesc');

    $postData['content'] = $content->html();

//    $postData['view_count'] = intval($attr->first('#post_view_count')->text());
    $postData['view_count'] = intval(file_get_contents($cnblogUrl .$interfaces['post_view_count'] . '?'
        . http_build_query(array_merge(array(
            'postId'    =>  $postId
        ),$bindData))));
    $postData['created_at'] = $attr->first('#post-date')->text();

    echo $content;
}

