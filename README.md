
## 環境構築

```bash

```

## クラスの命名規則

クラスの命名規則規則は基本的に以下の二つの記事を参考にして記入する
分からんくなったらこれなら伝わるっしょっていうやつ書いてね

-   https://qiita.com/manabuyasuda/items/dbb76ed36970bec95470
-   https://qiita.com/cotolier_risa/items/210db74e6496d4359be7

## コミットメッセージのテンプレート

-   以下の記事に従って先頭に接頭辞をつける
-   https://qiita.com/muranakar/items/20a7927ffa63a5ca226a
-   またコミットメッセージはスネークケースを使う
-   英語が好ましいが、どうしてもというときは日本語を使ってもよい

例:モーダルウインドウの css を変更した際

```
    improve:modal_window_css
```

## ブランチの命名規則

基本的に issue を立ててからブランチをきる
ブランチの名前のテンプレートとして以下を利用する

```
    {接頭辞}/#{issue番号}_{内容}
```

例:issue がモーダルウィンドウの作成で issue 番号が 6 だった場合

```
    feat/#6_modalwindow
```

## クラス、変数、関数名、型の名称について

命名には以下の記事を参考にする

-   https://qiita.com/YutaManaka/items/62dda256bb7ba6c08399

以下にはパスカルケースを採用する

-   コンポーネント名
-   型の名称

例: ハンバーガーメニューコンポーネント

```
    HamburgerMenu
```

以下にはケバブケースを採用する

-   クラス名

```
    hamburger-menu-style
```

それ以外はキャメルケースを用いる

例:ハンバーガーメニューを開く関数

```
    openHamburgerMenu()
```

