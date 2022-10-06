# Solicitud（お問い合わせ管理システム）
ある企業のお問合せ管理システム

![main](https://user-images.githubusercontent.com/108909962/194219940-52b7a0bc-464d-4598-84e3-edeb101f37a4.png)

![admin](https://user-images.githubusercontent.com/108909962/194219956-abb984af-ebc2-4931-a56d-831ab32215af.png)

## 作成した目的
問い合わせ管理のため

## 機能一覧
- 問い合わせ内容入力
- 郵便番号を利用した住所自動入力
- 問い合わせ登録
- 問い合わせ修正
- 管理画面表示
- 問い合わせ検索
- 検索結果のページネーション

## 使用技術（実行環境）
- MySQL、PHP（Laravel　8.x）、Livewire

## テーブル設計
![Screenshot_2022-10-06-14-08-54-710](https://user-images.githubusercontent.com/108909962/194219486-a35003a8-8a98-44ea-b26c-9849919fdcdc.jpeg)

## ER図
テーブル1つのため、リレーションなし

## 環境構築
- MySQLでforminoue20220930dbを作成する
- バックエンドのトップにある設定ファイル.envのユーザー名、パスワードの箇所に、自分の環境にあったものを設定する
- MySQLを立ち上げてから、マイグレーション、シーディングを行う
- トップでphp artisan serveとコマンド入力する
