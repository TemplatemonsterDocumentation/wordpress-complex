<h2>Введение</h2>
<h5>Благодарим Вас за приобретение шаблона WordPress. Данная документация состоит из нескольких частей и охватывает весь процесс установки и настройки веб-сайта WordPress с нуля.</h5>
<article id="whatiswordpress">
    <h3>Что представляет собой WordPress CMS?</h3>

    <p>WordPress - это бесплатное программное обеспечение с открытым исходным кодом для создания блогов и система управления контентом (CMS) на основе PHP и MySQL. Она позволяет создавать веб-сайты и мощные онлайн приложения, а также почти не требует технических навыков или знаний в управлении. Множество особенностей, в том числе простота использования и расширяемость, сделали WordPress наиболее популярной программой для веб-сайтов.
    <a href="http://wordpress.org/about/" target="_blank">Детали</a>
    </p>
</article>
<article id="whatistemplate">
    <h3>Что такое шаблон WordPress</h3>
    <p>Шаблон WordPress - это тема для платформы WordPress CMS. Другими словами, вы можете легко изменить внешний вид веб-сайта WordPress путем установки нового шаблона за несколько несложных шагов. При всей своей простоте, шаблон WordPress содержит все необходимые исходные файлы, которые можно редактировать желаемым образом.</p>
</article>
<article id="structure">
    <h3>Структура шаблона</h3>
    <p>Приобретенный комплект шаблона состоит из нескольких папок. Проверим содержимое каждой папки:</p>

    <ul class="files_structure">
    <li>
        <dl class="inline-term">
            <dt><i class="fa fa-folder"></i> <strong>documentation</strong></dt>
            <dd> содержит файлы документации.</dd>
        </dl>
        <ul>
            <li>
                <dl class="inline-term">
                    <dt><i class="fa fa-file"></i> <strong>documentation.html</strong></dt>
                    <dd> основной файл документации. Вы его сейчас читаете :)</dd>
                </dl>
            </li>
        </ul>
    </li>
    <li>
        <dl class="inline-term">
            <dt><i class="fa fa-folder"></i> <strong>screenshots</strong></dt>
            <dd>  содержит скриншоты шаблона. Для работы с шаблоном они не требуются.</dd>
        </dl>
    </li>    
    <li>
        <dl class="inline-term">
            <dt><i class="fa fa-folder"></i> <strong>sources.zip</strong></dt>
            <dd> содержит исходные файлы темы.</dd>
        </dl>
        <ul>
            <li>
                <dl class="inline-term">
                    <dt><i class="fa fa-folder"></i> <strong>psd</strong></dt>
                    <dd> исходные файлы шаблона для Adobe Photoshop(.psd).</dd>
                </dl>
            </li>
        </ul>
    </li>


    <li>
        <dl class="inline-term">
            <dt><i class="fa fa-folder"></i> <strong>theme</strong></dt>
            <dd> содержит файлы темы WordPress.</dd>
        </dl>
        <ul>
            <li>
                <dl class="inline-term">
                    <dt><i class="fa fa-file"></i> <strong>CherryFramework.zip</strong></dt>
                    <dd> архив с темой Cherry Framework. Включает все файлы темы. Необходимо устанавливать через менеджер расширений WordPress.</dd>
                </dl>
            </li>
            <li>
                <dl class="inline-term">
                    <dt><i class="fa fa-file"></i> <strong>theme####.zip</strong></dt>
                    <dd> архив с темой (дочерняя тема). Содержит все файлы темы. Необходимо устанавливать через менеджер расширений WordPress.</dd>
                </dl>
            </li>
             <li>
                <dl class="inline-term">
                    <dt><i class="fa fa-folder"></i> <strong>sample_data</strong></dt>
                    <dd> включает все демо-данные шаблона (записи, страницы, категории и т.п.).</dd>
                </dl>
                    <ul>
                        <li>
                            <dl class="inline-term">
                                <dt><i class="fa fa-file"></i> <strong>sample_data.xml</strong></dt>
                                <dd> включает все демо-данные шаблона (записи, страницы, категории и т.п.).</dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="inline-term">
                                <dt><i class="fa fa-file"></i> <strong>widgets.json</strong></dt>
                                <dd> файл настроек виджетов.</dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="inline-term">
                                <dt><i class="fa fa-file"></i> <strong>различные изображения и другие медиа файлы</strong></dt>
                            </dl>
                        </li>
                    </ul>
            </li>
            
            <li>
                <dl class="inline-term">
                    <dt><i class="fa fa-folder"></i> <strong>manuall_install</strong></dt>
                    <dd> содержит файлы, которые используются для того чтобы сделать сайт WordPress таким же, как наше демо.</dd>
                </dl>
                    <ul>
                         <li> 
                            <dl class="inline-term">
                                <dt><i class="fa fa-folder"></i> <strong>uploads</strong></dt>
                                    <dd>содержит изображения темы</dd>
                            </dl>
                        </li>
                        <li> 
                            <dl class="inline-term">
                                <dt><i class="fa fa-file"></i> <strong>theme#####.sql</strong></dt>
                                    <dd>файл базы данных (вмещает контент темы).</dd>
                            </dl>
                        </li>
                    </ul>
            </li>    
        </ul>
    </li>
    <li> 
        <dl class="inline-term">
            <dt><i class="fa fa-file"></i> <strong>license.txt</strong></dt>
                <dd>файл с информацией о лицензии.</dd>
           </dl>
    </li>
    <li> 
        <dl class="inline-term">
            <dt><i class="fa fa-file"></i> <strong>fonts_info.txt</strong></dt>
                <dd>файл со ссылками на скачку шрифтов, используемых в шаблоне.</dd>
           </dl>
    </li>
    <li> 
        <dl class="inline-term">
            <dt><i class="fa fa-file"></i> <strong>info.txt</strong></dt>
                <dd>инструкции по разархивированию исходных файлов.</dd>
           </dl>
    </li>
</ul>    




</article>
<article id="preparation">
    <h3>Подготовка</h3>
    <h6>Прежде чем перейти к установке веб-сайта WordPress, нужно полностью подготовиться. Рекомендуется выполнить следующие подготовительные шаги:</h6>

    <h4>Программное обеспечение</h4>
    <p>Для полноценной работы с шаблоном WordPress мы рекомендуем скачать все требуемые приложения. Список необходимого программного обеспечения находится на странице предпросмотра шаблона. 
Требования для различных шаблонов могут меняться, поэтому мы перечислим самые основные:</p>
    <ol class="index-list">
    	<li>Прежде всего нужны правильные приложения для распаковывания защищенного паролем архива sources_#########.zip. Можно воспользоваться WinZip 9+ (Windows) и Stuffit Expander 10+ (Mac).</li>
    	<li>Также может понадобиться программа Adobe Photoshop. Она используется для редактирования исходных файлов .PSD и необходима, если требуется изменить графический дизайн и изображения шаблона.</li>
    	<li>Для редактирования исходного кода файлов шаблона нужно использовать редактор кода, например Adobe Dreamweaver, Notepad++, Sublime Text и т.п.</li>
    	<li>Чтобы загрузить файлы на хостинг сервер, потребуется FTP менеджер, например Total Commander, FileZilla, CuteFTP и т.д.</li>
    </ol>

    	<h4>Хостинг</h4>
    	<p>Поскольку WordPress CMS является приложением PHP/MySQL, необходимо подготовить хостинг сервер.</p>
    	<p>In case you already have a hosting server, you need to check whether it is compatibile with <a href="http://wordpress.org/about/requirements/" target="_blank"> WordPress hosting requirements </a> or not. In other words, whether you can host a WordPress website with it.</p>

    	<p>Cherry Framework itself requires Apache or Nginx hosting servers with the following configuration settings:</p>

    	<h5>Recommended Configuration</h5>

    	<ol class="index-list">
    		<li>In <strong>php.ini</strong> define the following:<br>
    			<ul class="marked-list">
    				<li>'max_execution_time' => 60;</li>
    				<li>'memory_limit' => 128;</li>
    				<li>'post_max_size' => 8;</li>
    				<li>'upload_max_filesize' => 8;</li>
    				<li>'max_input_time' => 45;</li>
    				<li>'file_uploads' => 'on';</li>
    				<li>'safe_mode' => 'off';</li>
    			</ul>
    		</li>
    		<li>in <strong>.htaccess</strong> file: 'php_value max_execution_time' => 60;</li>
    		<li>in <strong>wp-config.php</strong>: 'set_time_limit' => 60;</li>
    		<li>50 MB of disk space</li>
    		<li>memory limit per process: 64mb (128mb or more recommended)</li>
    	</ol>


    	<h5>PHP and MySQL</h5>

    	<p>Minimal required version of PHP is 5.2.4 and MySQL 5. PHP 5.2 is already not safe as contains critical vulnerabilities that can be used to harm your website. Some Cherry Framework extensions will not work with PHP 5.2 and require version 5.4 or later.</p>

    	<p>Recommended settings are: </p>

    	<ol class="index-list">
    		<li>PHP 5.4</li>
    		<li>MySQL 5.5 or later</li>
    		<li>mod_rewrite</li>
    		<li>php fopen</li>
    		<li>suPHP</li>
    	</ol>

    	<p>Также можно установить WordPress на компьютер при помощи локального сервера. Для создания локального хостинг сервера необходимо использовать программное обеспечение WAMP, AppServ, MAMP и т.п. Любое из них устанавливается как обычная программа и поддерживает WordPress.</p>
        <p>Вы можете воспользоваться следующими туториалами для настройки локального сервера:</p>
    	<ul class="marked-list">
    		<li><a href="http://info.template-help.com/help/ru/how-to-install-appserv-web-development-environment.html" target="_blank">Как установить среду веб-разработки AppServ</a></li>
    	   <li><a href="http://info.template-help.com/help/ru/how-to-install-wamp-web-development-environment.html" target="_blank">Как установить среду веб-разработки WAMP</a></li>
    	   <li><a href="http://info.template-help.com/help/ru/how-to-install-xamp-web-development-environment.html" target="_blank">Как установить среду веб-разработки XAMP</a></li>
    </ul>
</article>