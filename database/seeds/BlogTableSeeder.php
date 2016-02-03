<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Blog as Blog;

class BlogTableSeeder extends Seeder {

    public function run()
    {
        DB::table('blogs')->delete();

        Blog::create(['seo_id' => 2, 'url' => 'laravel-rest-cms', 'title' => 'Laravel REST CMS', 'tags' => "laravel,rest,cms", 'published_on' => '2016-01-28', 'content' => $this->content, 'created_by' => 1]);
        Blog::create(['seo_id' => 3, 'url' => 'laravel-rest-cms-api-docs', 'title' => 'Laravel REST CMS API Docs', 'tags' => "laravel,rest,cms,api,docs", 'published_on' => '2016-01-29', 'content' => 'Docs here...blah, blah', 'created_by' => 1]);
    }



	protected $content = <<<'EOD'
<p>A Laravel 5 based REST Server for Content Management. <a href="api-docs/current/">API Docs</a></p> 
<p><a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></a>
<a href="https://travis-ci.org/ddimaria/Laravel-REST-CMS"><img src="https://img.shields.io/travis/ddimaria/Laravel-REST-CMS/master.svg?style=flat-square" alt="Build Status"></a>
<a href="https://scrutinizer-ci.com/g/ddimaria/Laravel-REST-CMS/?branch=master"><img src="https://scrutinizer-ci.com/g/ddimaria/Laravel-REST-CMS/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality"></a>
<a href="https://coveralls.io/github/ddimaria/Laravel-REST-CMS?branch=master"><img src="https://coveralls.io/repos/ddimaria/Laravel-REST-CMS/badge.svg?branch=master&amp;service=github" alt="Coverage Status"></a>
<a href="https://github.com/ddimaria/Laravel-REST-CMS/releases"><img src="https://img.shields.io/github/release/ddimaria/Laravel-REST-CMS.svg?style=flat-square" alt="Latest Version"></a></p>
<p>This package complies with <a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md">PSR-1</a>, <a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md">PSR-2</a> and <a href="https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md">PSR-4</a>.</p>
<h2><a id="Requirements_15"></a>Requirements</h2>
<ul>
<li>PHP &gt;= 5.5.9</li>
<li>OpenSSL PHP Extension</li>
<li>PDO PHP Extension</li>
<li>Mbstring PHP Extension</li>
<li>Tokenizer PHP Extension</li>
</ul>
<h2><a id="Installation_23"></a>Installation</h2>
<p>After ensuring that you meet the above requirements, follow the below procedures for installing Laravel REST CMS</p>
<h3><a id="Clone_this_repo_26"></a>Clone this repo</h3>
<pre><code class="language-shell">$ git clone http<span class="hljs-variable">s:</span>//github.<span class="hljs-keyword">com</span>/ddimaria/Laravel-REST-CMS.git laravel-rest-cms
$ <span class="hljs-keyword">cd</span> laravel-rest-cms
</code></pre>
<h3><a id="Run_Composer_32"></a>Run Composer</h3>
<p>This assumes you have composer installed and configured to run globally.  For assistance, visit <a href="https://getcomposer.org/download/">https://getcomposer.org/download/</a></p>
<pre><code class="language-shell">$ composer <span class="hljs-keyword">install</span>
</code></pre>
<p>This creates a /vendor directory and will pull in dependenies.</p>
<h3><a id="Folder_Permissions_39"></a>Folder Permissions</h3>
<pre><code class="language-shell">$ find storage/* -<span class="hljs-typedef"><span class="hljs-keyword">type</span> d -exec chmod 775 <span class="hljs-container">{}</span> \;</span>
</code></pre>
<h3><a id="Environment_Configuration_44"></a>Environment Configuration</h3>
<pre><code class="language-shell">$ cp <span class="hljs-class">.env</span><span class="hljs-class">.example</span> to <span class="hljs-class">.env</span></code></pre>
<p>After this file copy, update the attributes in .env to match your environment, database, and mail configurations.</p>
<h3><a id="Create_a_Unique_Encryption_Key_51"></a>Create a Unique Encryption Key</h3>
<pre><code class="language-shell"><span class="hljs-variable">$ </span>php artisan <span class="hljs-symbol">key:</span>generate
</code></pre>
<h3><a id="Migrate_the_Database_56"></a>Migrate the Database</h3>
<pre><code class="language-shell"><span class="hljs-variable">$ </span>php artisan migrate
</code></pre>
<h3><a id="Seed_the_Database_61"></a>Seed the Database</h3>
<pre><code class="language-shell"><span class="hljs-variable">$ </span>php artisan <span class="hljs-symbol">db:</span>seed
</code></pre>
<h2><a id="Testing_67"></a>Testing</h2>
<h3><a id="Basic_68"></a>Basic</h3>
<pre><code class="language-shell"><span class="hljs-variable">$ </span>phpunit
</code></pre>
<h3><a id="With_Coverage_HTML_73"></a>With Coverage HTML</h3>
<p>The testing goal is 100% covearge of non-vendor, non-laravel code.</p>
<pre><code class="language-shell">$ phpunit --coverage-<span class="hljs-tag">html</span> --coverage-clover=coverage<span class="hljs-class">.clover</span>
</code></pre>
<h2><a id="Packages_and_General_Processes_80"></a>Packages and General Processes</h2>
<h3><a id="API_Design_82"></a>API Design</h3>
<p>This system uses the <a href="https://github.com/thephpleague/fractal">thephpleague/fractal</a> component, which is “a presentation and transformation layer for complex data output.”  This provides a solid foundation for relating models, transforming data, pagination responses and standardizing input parameters.</p>
<h3><a id="Responses_85"></a>Responses</h3>
<p>Responses are sent using the <a href="https://github.com/ellipsesynergie/api-response">ellipsesynergie/api-response</a> package.  This ties into Fractal’s Manager object for simplifying and standardizing responses.</p>
<h3><a id="Authentication_88"></a>Authentication</h3>
<p>The system implements token-based authetication with the <a href="https://github.com/chrisbjr/api-guard">chrisbjr/api-guard</a> component.  This nifty package plays well with Fractal and Api-Response, and fully abstracts authentication, token generation and maintenence, api rate limiting, access levels, method-level access and full api logging.</p>
<h3><a id="Pagination_91"></a>Pagination</h3>
<p>When returning data for collection-based endpoints, results are paginated, 15 per page.</p>
<pre><code class="language-json">"meta": {
    "pagination": {
        "total": 150,
        "count": 15,`
        "per_page": 15,
        "current_page": 3,
        "total_pages": 10,
        "links": {
            "previous": "https://localhost/api/v1/pages/?page=2",
            "next": "https://localhost/api/v1/pages/?page=4"
        }
    }
}
</code></pre>
<h3><a id="Error_Responses_109"></a>Error Responses</h3>
<p>404 responses are returned with a 404 status code and a “Not found!” JSON response:</p>
<pre><code class="language-json">{
    "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">message</span>": <span class="hljs-value"><span class="hljs-string">"Not found!"</span></span>,
        "<span class="hljs-attribute">status_code</span>": <span class="hljs-value"><span class="hljs-number">404</span>
    </span>}
</span>}
</code></pre>
<p>Validation errors throw a 422 response:</p>
<pre><code class="language-json">{
  "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">code</span>": <span class="hljs-value"><span class="hljs-string">"GEN-UNPROCESSABLE-ENTITY"</span></span>,
    "<span class="hljs-attribute">http_code</span>": <span class="hljs-value"><span class="hljs-number">422</span></span>,
    "<span class="hljs-attribute">message</span>": <span class="hljs-value">[
      <span class="hljs-string">"The name field is required."</span>,
      <span class="hljs-string">"The layout field is required."</span>
    ]
  </span>}
</span>}
</code></pre>
<h3><a id="Caching_133"></a>Caching</h3>
<p>All models that extend \App\LaravelRestCms\BaseModel implement the \App\LaravelRestCms\CacheTrait in which are cached when saved.</p>
<h2><a id="Usage_136"></a>Usage</h2>
<h3><a id="Logging_In_138"></a>Logging In</h3>
<p><code>POST /app/v1/user/login</code></p>
<h4><a id="POST_140"></a>POST</h4>
<pre><code class="language-json">{
    "<span class="hljs-attribute">username</span>": <span class="hljs-value"><span class="hljs-string">"admin"</span></span>, 
    "<span class="hljs-attribute">password</span>": <span class="hljs-value"><span class="hljs-string">"123"</span>
</span>}
</code></pre>
<h4><a id="Response_147"></a>Response:</h4>
<pre><code class="language-json">{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">first_name</span>": <span class="hljs-value"><span class="hljs-string">"Admin"</span></span>,
    "<span class="hljs-attribute">last_name</span>": <span class="hljs-value"><span class="hljs-string">"User"</span></span>,
    "<span class="hljs-attribute">api_key</span>": <span class="hljs-value"><span class="hljs-string">"7fa1949b94f9000f4bb558709aee106f8c0d042c"</span></span>,
    "<span class="hljs-attribute">version</span>": <span class="hljs-value"><span class="hljs-string">"version: 1.0.3"</span>
  </span>}
</span>}
</code></pre>
<h3><a id="Logging_Out_160"></a>Logging Out</h3>
<p><code>GET /app/v1/user/logout/{api_key}</code></p>
<h4><a id="Response_162"></a>Response</h4>
<pre><code class="language-json">{
  "<span class="hljs-attribute">ok</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">code</span>": <span class="hljs-value"><span class="hljs-string">"SUCCESSFUL"</span></span>,
    "<span class="hljs-attribute">http_code</span>": <span class="hljs-value"><span class="hljs-number">200</span></span>,
    "<span class="hljs-attribute">message</span>": <span class="hljs-value"><span class="hljs-string">"User was successfuly deauthenticated"</span>
  </span>}
</span>}
</code></pre>
<h3><a id="Simple_Page_173"></a>Simple Page</h3>
<p><code>GET /app/v1/page/{id}</code></p>
<h4><a id="Response_175"></a>Response</h4>
<pre><code class="language-json">{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">parent_id</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
    "<span class="hljs-attribute">template_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">nav_name</span>": <span class="hljs-value"><span class="hljs-string">"Home"</span></span>,
    "<span class="hljs-attribute">url</span>": <span class="hljs-value"><span class="hljs-string">"home"</span></span>,
    "<span class="hljs-attribute">title</span>": <span class="hljs-value"><span class="hljs-string">"Home Page"</span>
  </span>}
</span>}
</code></pre>
<h3><a id="Page_data_including_page_detail_and_template_detail_joins_189"></a>Page data, including page_detail and template_detail joins</h3>
<p><code>GET /app/v1/page/{id}/detail</code></p>
<h4><a id="Response_191"></a>Response</h4>
<pre><code class="language-json">{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">parent_id</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
    "<span class="hljs-attribute">template_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">nav_name</span>": <span class="hljs-value"><span class="hljs-string">"Home"</span></span>,
    "<span class="hljs-attribute">url</span>": <span class="hljs-value"><span class="hljs-string">"home"</span></span>,
    "<span class="hljs-attribute">title</span>": <span class="hljs-value"><span class="hljs-string">"Home Page"</span></span>,
    "<span class="hljs-attribute">detail</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
        {
          "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
          "<span class="hljs-attribute">page_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
          "<span class="hljs-attribute">template_detail_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
          "<span class="hljs-attribute">data</span>": <span class="hljs-value"><span class="hljs-string">"First page content"</span></span>,
          "<span class="hljs-attribute">group</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
          "<span class="hljs-attribute">version</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
          "<span class="hljs-attribute">template_detail</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
              {
                "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
                "<span class="hljs-attribute">parent_id</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
                "<span class="hljs-attribute">name</span>": <span class="hljs-value"><span class="hljs-string">"Main Content"</span></span>,
                "<span class="hljs-attribute">description</span>": <span class="hljs-value"><span class="hljs-literal">null</span></span>,
                "<span class="hljs-attribute">var</span>": <span class="hljs-value"><span class="hljs-string">"main_content"</span></span>,
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"wysiwyg"</span></span>,
                "<span class="hljs-attribute">data</span>": <span class="hljs-value"><span class="hljs-literal">null</span></span>,
                "<span class="hljs-attribute">sort</span>": <span class="hljs-value"><span class="hljs-number">1</span>
              </span>}
            ]
          </span>}
        </span>},
        {
          "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
          "<span class="hljs-attribute">page_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
          "<span class="hljs-attribute">template_detail_id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
          "<span class="hljs-attribute">data</span>": <span class="hljs-value"><span class="hljs-string">"First page sub-content"</span></span>,
          "<span class="hljs-attribute">group</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
          "<span class="hljs-attribute">version</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
          "<span class="hljs-attribute">template_detail</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
              {
                "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
                "<span class="hljs-attribute">parent_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
                "<span class="hljs-attribute">name</span>": <span class="hljs-value"><span class="hljs-string">"Sub Content"</span></span>,
                "<span class="hljs-attribute">description</span>": <span class="hljs-value"><span class="hljs-literal">null</span></span>,
                "<span class="hljs-attribute">var</span>": <span class="hljs-value"><span class="hljs-string">"main_content"</span></span>,
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"wysiwyg"</span></span>,
                "<span class="hljs-attribute">data</span>": <span class="hljs-value"><span class="hljs-literal">null</span></span>,
                "<span class="hljs-attribute">sort</span>": <span class="hljs-value"><span class="hljs-number">1</span>
              </span>}
            ]
          </span>}
        </span>}
      ]
    </span>}</span>,
    "<span class="hljs-attribute">parent</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">data</span>": <span class="hljs-value">[]
    </span>}
  </span>}
</span>}
</code></pre>
<h2><a id="License_256"></a>License</h2>
<p>The MIT License (MIT). Please see <a href="https://github.com/ddimaria/Laravel-REST-CMS/blob/master/LICENSE">License File</a> for more information.</p>
EOD;
}