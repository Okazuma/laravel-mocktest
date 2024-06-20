アプリケーション名:勤怠打刻管理アプリ
=====

概要説明
=====
    1.出退勤時間、実働時間、休憩時間など細かく記録できる。

    2.日別一覧画面から直近の勤務情報をすぐに確認できるため、お客様対応や社内での業務を行う上で、誰がどの時間に出勤していたかなどスムーズに把握できるようになる。



作成目的
=====
    1.勤怠情報に記録ミスや漏れが無いよう正確に記録するため

    2.それぞれの勤務情報をいち早く確認できるようにするため


アプリケーションURL
=====



他のリポジトリ
=====



機能一覧
=====
    1.会員登録、ログイン機能

    2.メールでの認証機能

    3.勤怠打刻ボタンによる勤怠記録の保存機能

    4.各一覧ページでの保存されたデータの閲覧機能



使用技術
=====
    Laravel 8.83

    php 7.4.9

    nginx 1.21.1

    Mysql 8.0.26



テーブル設計
=====



ER図
=====

![alt text](mocktest-ER.png)



dockerビルド
=====
    1 git clone リンク 　　https://github.com/Okazuma/laravel_test.git

    2 docker-compose up -d --build

    *MysqlはOSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlを編集してください。

    *メール認証は.envファイルでメールサーバーを設定してください。



Laravel環境構築
=====
    1 phpコンテナにログイン       $docker-compose exec php bash

    2 パッケージのインストール     $composer-install

    3 env.exampleから.envを作成し、環境変数を変更、メールサーバーの設定

    4 アプリケーションキーの生成    $php artisan key:generate

    5 マイグレーション            $php artisan migrate

    6 シーディング               $php artisan db:seed


その他
=====