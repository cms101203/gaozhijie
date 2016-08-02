<?php
    Breadcrumbs::register("admin.index", function ($breadcrumbs) {
        $breadcrumbs->push("首页", route("admin.index"));
    });
Breadcrumbs::register("admin.user.manage", function ($breadcrumbs){
        $breadcrumbs->push("用户管理", route("admin.user.manage"));
    });Breadcrumbs::register("admin.permission.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.user.manage");
                        $breadcrumbs->push("权限列表", route("admin.permission.index"));
                    });
                    Breadcrumbs::register("admin.user.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.user.manage");
                        $breadcrumbs->push("用户列表", route("admin.user.index"));
                    });
                    Breadcrumbs::register("admin.role.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.user.manage");
                        $breadcrumbs->push("角色列表", route("admin.role.index"));
                    });
                    Breadcrumbs::register("admin.permission.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.permission.index");
                          $breadcrumbs->push("添加权限", route("admin.permission.create"));
                        });
                  Breadcrumbs::register("admin.permission.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.permission.index");
                          $breadcrumbs->push("修改权限", route("admin.permission.edit"));
                        });
                  Breadcrumbs::register("admin.permission.destroy ", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.permission.index");
                          $breadcrumbs->push("删除权限", route("admin.permission.destroy "));
                        });
                  Breadcrumbs::register("admin.user.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.user.index");
                          $breadcrumbs->push("添加用户", route("admin.user.create"));
                        });
                  Breadcrumbs::register("admin.user.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.user.index");
                          $breadcrumbs->push("编辑用户", route("admin.user.edit"));
                        });
                  Breadcrumbs::register("admin.user.destroy", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.user.index");
                          $breadcrumbs->push("删除用户", route("admin.user.destroy"));
                        });
                  Breadcrumbs::register("admin.role.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.role.index");
                          $breadcrumbs->push("添加角色", route("admin.role.create"));
                        });
                  Breadcrumbs::register("admin.role.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.role.index");
                          $breadcrumbs->push("编辑角色", route("admin.role.edit"));
                        });
                  Breadcrumbs::register("admin.role.destroy", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.role.index");
                          $breadcrumbs->push("删除角色", route("admin.role.destroy"));
                        });
                  Breadcrumbs::register("admin.category.manage", function ($breadcrumbs){
        $breadcrumbs->push("分类管理", route("admin.category.manage"));
    });Breadcrumbs::register("admin.category.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.category.manage");
                        $breadcrumbs->push("分类列表", route("admin.category.index"));
                    });
                    Breadcrumbs::register("admin.category.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.category.index");
                          $breadcrumbs->push("分类添加", route("admin.category.create"));
                        });
                  Breadcrumbs::register("admin.category.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.category.index");
                          $breadcrumbs->push("分类修改", route("admin.category.edit"));
                        });
                  Breadcrumbs::register("admin.category.destroy", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.category.index");
                          $breadcrumbs->push("分类删除", route("admin.category.destroy"));
                        });
                  Breadcrumbs::register("admin.company.manage", function ($breadcrumbs){
        $breadcrumbs->push("公司管理", route("admin.company.manage"));
    });Breadcrumbs::register("admin.company.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.company.manage");
                        $breadcrumbs->push("公司列表", route("admin.company.index"));
                    });
                    Breadcrumbs::register("admin.company.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.company.index");
                          $breadcrumbs->push("添加公司", route("admin.company.create"));
                        });
                  Breadcrumbs::register("admin.company.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.company.index");
                          $breadcrumbs->push("编辑公司信息", route("admin.company.edit"));
                        });
                  Breadcrumbs::register("admin.pape.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.company.manage");
                            $breadcrumbs->push("公司证件添加", route("admin.pape.edit"));
                        });
                  Breadcrumbs::register("admin.xm.manage", function ($breadcrumbs){
        $breadcrumbs->push("项目管理", route("admin.xm.manage"));
    });Breadcrumbs::register("admin.xm.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.xm.manage");
                        $breadcrumbs->push("项目列表", route("admin.xm.index"));
                    });
                    Breadcrumbs::register("admin.joinstore.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.xm.manage");
                        $breadcrumbs->push("加盟店管理", route("admin.joinstore.index"));
                    });
                    Breadcrumbs::register("admin.discount.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.xm.manage");
                        $breadcrumbs->push("店铺优惠列表", route("admin.discount.index"));
                    });
                    Breadcrumbs::register("admin.xm.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.xm.index");
                          $breadcrumbs->push("添加项目", route("admin.xm.create"));
                        });
                  Breadcrumbs::register("admin.xm.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.xm.index");
                          $breadcrumbs->push("编辑项目", route("admin.xm.edit"));
                        });
                  Breadcrumbs::register("admin.pape.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.xm.manage");
                            $breadcrumbs->push("项目图片管理", route("admin.pape.create"));
                        });
                  Breadcrumbs::register("admin.joinstore.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.joinstore.index");
                          $breadcrumbs->push("加盟店添加", route("admin.joinstore.create"));
                        });
                  Breadcrumbs::register("admin.joinstore.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.joinstore.index");
                          $breadcrumbs->push("加盟店编辑", route("admin.joinstore.edit"));
                        });
                  Breadcrumbs::register("admin.discount.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.discount.index");
                          $breadcrumbs->push("优惠信息添加", route("admin.discount.create"));
                        });
                  Breadcrumbs::register("admin.discount.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.discount.index");
                          $breadcrumbs->push("优惠信息编辑", route("admin.discount.edit"));
                        });
                  Breadcrumbs::register("admin.article.manage", function ($breadcrumbs){
        $breadcrumbs->push("文章管理", route("admin.article.manage"));
    });Breadcrumbs::register("admin.article.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.article.manage");
                        $breadcrumbs->push("文章列表", route("admin.article.index"));
                    });
                    Breadcrumbs::register("admin.article.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.article.index");
                          $breadcrumbs->push("添加文章", route("admin.article.create"));
                        });
                  Breadcrumbs::register("admin.article.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.article.index");
                          $breadcrumbs->push("编辑文章", route("admin.article.edit"));
                        });
                  Breadcrumbs::register("admin.question.manage", function ($breadcrumbs){
        $breadcrumbs->push("问答管理", route("admin.question.manage"));
    });Breadcrumbs::register("admin.question.index", function ($breadcrumbs) {
                        $breadcrumbs->parent("admin.question.manage");
                        $breadcrumbs->push("问答列表", route("admin.question.index"));
                    });
                    Breadcrumbs::register("admin.question.create", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.question.index");
                          $breadcrumbs->push("添加问答", route("admin.question.create"));
                        });
                  Breadcrumbs::register("admin.question.edit", function ($breadcrumbs) {
                  $breadcrumbs->parent("admin.question.index");
                          $breadcrumbs->push("编辑问答", route("admin.question.edit"));
                        });
                  