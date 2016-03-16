#autophp
自动化生成tp框架的model,controller,view文件和代码


# 使用说明1.0
1.直接TPH导入Application项目下,作为一个模块;svn/git时候记得不到上传此块代码<
2.如果担心生成的文件,覆盖已有的文件而造成损失,则可以在本地新建另外一个项目,生成文件后,再复制到新项目中
3.注意common中的配置,必须全部大小;尤其是DB的配置



#项目结构:
1.function.php是公用方法
2.Cmodel是创建普通的model类
3.Cviewmodel是创建viewmodel
4.Crelationmodel是创建relationmodel
5.Ccontroller是创建控制器
6.Cview是创建view
注:function时候Common文件夹下,其余都是在Controller下
