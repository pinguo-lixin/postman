<?php
namespace App\Service;

use App\Postman\Body;
use App\Postman\Info;
use App\Postman\Item;
use App\Postman\Main;
use App\Postman\KeyValue;
use App\Postman\Response;

class Markdown implements GeneratorProvider
{
    public $dftTableHeader = ['Field', 'Value', 'Desc'];

    /**
     * 请求方法颜色
     *
     * @var array
     */
    public $reqMethodColor = [
        'GET' => '#3eb63e',
        'POST' => '#f5a623',
        'PUT' => '#4a90e2',
        'DELETE' => '#ed4b48',
        'PATCH' => '#666',
    ];
    
    public function parse(Main $entity)
    {
        ob_start();
        ob_implicit_flush(false);

        $this->title($entity->info);
        $this->renderItems($entity->item);

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    protected function title(Info $info)
    {
        echo '# ' , $info->name , PHP_EOL;
        if ($info->description) {
            echo $info->description, PHP_EOL;
        }
    }

    protected function renderItems(array $items, $level = 1)
    {
        /** @var Item $item */
        foreach ($items as $item) {
            if ($item->isRequest) {
                $this->item($item);
            } else {
                $this->dirDescription($item, $level);
                $this->renderItems($item->item, $level + 1);
            }
        }
    }

    protected function dirDescription(Item $item, $level = 1)
    {
        if ($level >= 5) {
            $level = 5;
        }

        echo str_repeat('#', $level) , ' ', $item->name, PHP_EOL;;
        if ($item->description) {
            echo  $item->description, PHP_EOL, PHP_EOL;
        }
    }

    /**
     * render a request item
     *
     * @param \App\Postman\Item $item
     * @return string
     */
    protected function item(Item $item)
    {
        $req = $item->request;
        static $reqTitle = '<p style="font-size: 1.5em;"><span style="font-weight: bold;">%s</span>  %s</p>';
        
        echo sprintf($reqTitle, $this->reqMethod($req->method), $item->name), PHP_EOL;
        echo sprintf('<pre style="background-color: #fafafa;">%s</pre>', $req->url->raw), PHP_EOL;
        
        if ($item->request->description) {
           echo $item->request->description . "\n";
        }
        if ($req->header) {
            echo static::bold('Headers'), 
            PHP_EOL,
            static::table(static::keyValuesToRows($req->header), $this->dftTableHeader);
        }
        if ($req->url->query) {
            echo static::bold('Params'), 
            PHP_EOL,
            static::table(static::keyValuesToRows($req->url->query), $this->dftTableHeader);
        }

        if ($req->body) {
            echo sprintf('**Body** <span style="color: #7e7e7e;">%s</span>', $req->body->mode), PHP_EOL;
            if ($req->body->mode === Body::MODE_RAW) {
                static $tpl = <<<'REQ_BODY'
<details>
<summary>%s</summary>
<pre><code>
%s
</code></pre>
</details>
REQ_BODY;
                echo sprintf($tpl, '查看请求', $req->body->raw), PHP_EOL;
            } else {
                $rows = array_map(function ($v) {
                    /** @var \App\Postman\Formdata $v */
                    return [$v->key, $v->getValue(), $v->description];
                }, $req->body->getValue());
                echo static::table($rows, $this->dftTableHeader);
            }
        }

        if ($item->response) {
            echo static::bold('Response'), PHP_EOL;
            foreach ($item->response as $res) {
                echo $this->renderResponse($res), PHP_EOL;
            }
        }

        echo '----', PHP_EOL;
    }

    protected function renderResponse(Response $response)
    {
static $tpl = <<<'RESPONSE'
<details>
<summary>%s</summary>
<pre><code>
%s
</code></pre>
</details>
RESPONSE;
        
        return sprintf(
            $tpl,
            $response->name . ' ' . $response->code . ' ' . $response->status,
            $response->body
        );
    }

    protected static function bold($text)
    {
        return sprintf('**%s**', $text);
    }

    protected static function keyValuesToRows(array $keyVs, $valuePropName = 'value')
    {
        $rows = [];
        /** @var KeyValue $v */
        foreach ($keyVs as $v) {
            $rows[] = [$v->key, $v->$valuePropName, $v->description];
        }
        return $rows;
    }

    /**
     * 创建三列的表格
     *
     * @param array $rows
     * @param string[] $header 表格首行，若不存在，取 rows 第一行
     * @return string
     */
    protected static function table($rows, $header = null)
    {
        if ($header === null) {
            $header = $rows[0];
            unset($rows[0]);
        }

        $content = static::tableColumn($header);
        $content .= static::tableColumn(['----', '----', '----']);
        foreach ($rows as $row) {
            $content .= static::tableColumn($row);
        }
        return $content;
    }

    protected static function tableColumn($row)
    {
        return sprintf('| %s | %s | %s |', $row[0], $row[1], $row[2]) . "\n";
    }

    protected function reqMethod($method)
    {
        $color = isset($this->reqMethodColor[$method]) ? $this->reqMethodColor[$method] : '#fff';

        return sprintf('<span style="color: %s; font-weight: bold;">%s</span>', $color, $method);
    }
}
