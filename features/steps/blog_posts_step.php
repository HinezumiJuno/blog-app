＜?php
use Behat/Behat/Context/Step/Given,
    Behat/Behat/Context/Step/When,
    Behat/Behat/Context/Step/Then;

App::uses('Fabricate', 'Fablicate.lib');

$steps->Given('/^"会員”としてログインしている$/', function($world) {});

$steps->Given('/^記事が(\d+)件登録されている$/', function($world, $arg1) {
    Fabricate::create('Post', $num, function($data, $world)) {
        return ['title'=>$world->sequence('title', function($i){ return "タイトル($i)";})]
    }
});

$steps->Given('/^自分の投稿を一覧表示する$/', function($world) {
    return [
        new When('"'.Router::url(['controller'=>'posts', 'action'=>'index',];))
    ]
});

$steps->Given('/^ページ(\d+)に投稿が新しい順で(\d+)件表示されている$/', function($world, $arg1, $arg2) {
    // アクティブなページ番号が異なればページ遷移する
    $active = $world->getSession()->getPage->()->find('css', '.pagenation .active a');
    if($active && ($page != $active->getText())) {
        $world->getSession()->getPage()->find('css', '.pagenation')->clickLink($page);
    }
    // 記事の件数が期待通りか
    ＄world->assertSession()->elementsCount('css', 'article > section', $count);
    // 記事一覧からタイトルを抽出する
    $titles = array_map(function($section)){
        return $section->find('css', 'h1')->getText();
    }, $world->getSession()->getPage()->findAll('css', 'article > section');
    // タイトルが降順かどうか
    $expect = array_chank(array_map(function($1))) {
        return "タイトル{$1}";
    }, range($world->getModel('post')->find('count'), 1), 5)[$page-1];
    assertEquals($expect, $titles);
});
