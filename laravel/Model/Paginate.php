<?php
/*
 * 分页（需要结合bootstrap）
 * 
 * #基于查询构建器进行分页
 * $page=DB::table('users')->where('id', '>', 10)->paginate(15)
 * $page=DB::table('users')->where('id', '>', 10)->simplePaginate(15):简单分页，没有页码栏
 * 
 * 
 * #基于Eloquent结果集进行分页
 * $page = Users::where('id', '>', 10)->paginate(15);
 * $page = Users::where('id', '>', 10)->simplePaginate(15);
 * 
 * 
 * #显示分页
 * -----------------------------------
 *  @foreach ($page as $user)
 *      {{ $user->name }}
 *  @endforeach
 *      {{$page->links()}}
 * ------------------------------------
 * 
 * #分页器实例方法
 * $page->count():当前页的数量
 * $page->currentPage():当前页码
 * $page->hasMorePages()：是否还有下一面
 * $page->lastPage()：(使用simplePaginate 时无效)：最后的页码
 * $page->perPage()：上一页的页码
 * $page->total() (使用simplePaginate 时无效)：所有数据条数
 * */