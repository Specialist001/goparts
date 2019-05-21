<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255)->unique(),
            'email' => $this->string(255)->notNull()->unique(),

            'first_name' => $this->string(255)->null(),
            'middle_name' => $this->string(255)->null(),
            'last_name' => $this->string(255)->null(),

            'gender' => $this->tinyInteger(1)->defaultValue(0)->comment('0-male, 1-female'),
            'role' => $this->smallInteger(1)->defaultValue(0)->comment('0-buyer, 1-seller'),
            'type' => $this->smallInteger(1)->defaultValue(0)->comment('0-Individual, 1-Legal entity'),

            'birth_date' => $this->date()->null(),

            'site' => $this->string(255),
            'about' => $this->string(255),
            'location' => $this->string(255),

            'access_level' => $this->integer(5)->defaultValue(0),

            'visit_time' => $this->integer(11)->null(),

            'avatar' => $this->string(164)->null(),
            'email_confirm' => $this->tinyInteger(1)->defaultValue(0),
            'phone' => $this->string(100)->null(),
            'legal_info' => $this->string(255)->null(),
            'legal_reg_certificate' => $this->string(255)->null(),
            'legal_address' => $this->string(255)->null(),
            'legal_bank_account' => $this->string(255)->null(),
            'legal_vat_number' => $this->string(255)->null(),

            'status' => $this->smallInteger(6)->notNull()->defaultValue(10),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'deleted_at' => $this->integer(11)->null(),

        ], $tableOptions);

        $this->createIndex('un-user_username', '{{%user}}', 'username', true);
        $this->createIndex('un-user_email', '{{%user}}', 'email', true);
        $this->createIndex('ix-user_status', '{{%user}}', 'status', false);
    }

    public function down()
    {
        $this->dropIndex('ix-user_status', '{{%users}}');
        $this->dropIndex('un-user_email', '{{%users}}');
        $this->dropIndex('un-user_username', '{{%users}}');

        $this->dropTable('{{%user}}');
    }
}
