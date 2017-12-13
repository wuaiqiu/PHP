<?php
/*
 * 数据库迁移文件
 *
 * (1).数据类型
 *
 *  $table->engine = 'InnoDB':指定存储引擎
 *
 *  $table->bigInteger('votes')：BIGINT
 *  $table->integer('votes')：INTEGER
 *  $table->mediumInteger('numbers')：MEDIUMINT
 *  $table->smallInteger('votes')：SMALLINT
 *  $table->tinyInteger('numbers')：TINYINT
 *  $table->float('amount')：FLOAT
 *  $table->decimal('amount', 5, 2)：DECIMAL
 *  $table->double('column', 15, 8)：DOUBLE
 *
 *  $table->binary('data')：BLOB
 *
 *  $table->char('name', 4)：CHAR
 *  $table->string('name', 100)：VARCHAR
 *  $table->longText('description')：LONGTEXT
 *  $table->text('description')：TEXT
 *  $table->mediumText('description')：MEDIUMTEXT
 *  $table->enum('choices', ['foo', 'bar'])：ENUM
 *
 *  $table->time('sunrise')：TIME
 *  $table->date('created_at')：DATE
 *  $table->dateTime('created_at')：DATETIME
 *  $table->timestamp('added_on')：TIMESTAMP
 *  $table->timestamps()：添加 created_at 和 updated_at 列
 *
 *
 *  $table->increments('id')：数据库主键自增ID
 *
 *  $table->unsignedBigInteger('votes')：BIGINT
 *  $table->unsignedInteger('votes')：INT
 *  $table->unsignedMediumInteger('votes')：MEDIUMINT
 *  $table->unsignedSmallInteger('votes')：SMALLINT
 *  $table->unsignedTinyInteger('votes')：TINYINT
 *
 *
 * (2).约束
 *
 * $table->default($value):指定列的默认值
 * $table->nullable():允许该列的值为NULL
 * $table->primary('id'):添加主键索引
 * $table->primary(['first', 'last']):添加混合索引
 * $table->unique('email'):添加唯一索引
 * $table->unique('state', 'my_index_name'):指定自定义索引名称
 * $table->unique(['first', 'last']):添加组合唯一索引
 * $table->index('state'):添加普通索引
 *
 * 
 * (3).相关命令
 *  
 *  #生成迁移类
 *  php artisan make:migration Migrations
 *  #自动生成Schema::create结构
 *  php artisan make:migration create_users_table --create=users
 *  #自动Schema::table结构
 *  php artisan make:migration add_votes_to_users_table --table=users
 *  #运行迁移
 *  php artisan migrate
 *  #回滚最后一批迁移
 *  php artisan migrate:rollback
 *  #回滚后5条迁移
 *  php artisan migrate:rollback --step=5
 *  #回滚所有
 *  php artisan migrate:reset
 *  #先回滚所有，后数据库迁移
 *  php artisan migrate:refresh
 * */




class Migrations extends Migrations{

    //运行迁移（提交迁移）
    public function up(){

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('airline');
            $table->timestamps();
        });

    }


    //撤销迁移（回滚迁移）
    public function down(){
        Schema::dropIfExists('users');
    }
}