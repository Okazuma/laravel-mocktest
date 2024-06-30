アプリケーション名
=====
    勤怠打刻管理アプリ

<img width="650" src="https://github.com/Okazuma/laravel-mocktest/assets/160417297/5ea8caac-1c62-4fda-8e75-6baf1c96baf5">



概要説明
=====
    1 出退勤時刻、実働時間、休憩時間など細かく記録できる。

    2 日別の勤怠記録や勤務者別での勤怠記録を確認できる。

    3 メール認証機能でユーザー情報登録時に本人確認ができる。



作成目的
=====
    1 勤怠情報を管理者が毎回記録する手間を省き業務を効率化させるため。

    2 入力ミスや記入漏れなく正確な勤怠記録から人事評価を行うため。

    3 勤務者自身が打刻できることで勤務時間と休憩時間の切り替えを行えるように。



アプリケーションURL
=====

    http://43.207.53.156

    メール認証機能を設定しているのでホーム画面へアクセスするためには
    初回アクセス時 会員登録->メール認証->ログイン の順でユーザー登録が必要です。



機能一覧
=====
    1 会員登録、ログイン機能

    2 メール認証機能

    3 勤怠打刻ボタンによる勤怠記録の保存機能

    4 各種一覧ページでの保存された記録の閲覧機能



使用技術
=====
    Laravel 8.83

    php 7.4.9

    nginx 1.21.1

    Mysql 8.0.37

    phpMyAdmin 5.2.1



テーブル設計
=====
<img width="650" src="https://github.com/Okazuma/laravel-mocktest/assets/160417297/5253e412-73d0-48e2-8be1-2052239a3ac8">



ER図
=====
<img width="650" src="https://github.com/Okazuma/laravel-mocktest/assets/160417297/faceeab7-4bf2-43c3-aeff-3068a5a04f1f">



dockerビルド
=====
    1 git clone リンク  https://github.com/Okazuma/laravel_test.git

    2 docker-compose up -d --build

    * MysqlはOSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlを編集してください。



Laravelの環境構築
=====
    1 phpコンテナにログイン        $docker-compose exec php bash

    2 パッケージのインストール      $composer-install

    3 .envファイルの作成          cp .env.example .env

    4 アプリケーションキーの生成    $php artisan key:generate

    5 マイグレーション            $php artisan migrate

    6 シーディング               $php artisan db:seed



メールサーバー設定について
=====
    1 使用しているメールサーバーから必要な設定情報を取得

    2 メールサーバーの情報を.envファイルに設定

    3 .envファイルの変更が反映するようlaravelの設定キャッシュのクリア
