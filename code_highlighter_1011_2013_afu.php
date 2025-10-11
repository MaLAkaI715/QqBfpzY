<?php
// 代码生成时间: 2025-10-11 20:13:36
// CodeHighlighter.php
// 代码语法高亮器类

class CodeHighlighter {
    // 存储代码高亮配置
    private $config;

    // 构造函数
    public function __construct($config = []) {
        // 设置默认配置
        $this->config = array_merge([
            'highlight_theme' => 'default',
            'highlight_language' => 'php',
        ], $config);
    }

    // 设置高亮主题
    public function setTheme($theme) {
        $this->config['highlight_theme'] = $theme;
    }

    // 设置高亮语言
    public function setLanguage($language) {
        $this->config['highlight_language'] = $language;
    }

    // 执行代码高亮
    public function highlight($code) {
        try {
            // 根据语言选择对应的高亮函数
            $highlightFunction = 'highlight_' . $this->config['highlight_language'];
            if (function_exists($highlightFunction)) {
                // 应用高亮
                $highlightedCode = $highlightFunction($code, true);

                // 根据主题添加样式
                $themeStyles = $this->getThemeStyles($this->config['highlight_theme']);
                return '<pre><code>' . $themeStyles . $highlightedCode . '</code></pre>';
            } else {
                // 语言不支持高亮
                throw new Exception('Unsupported language for highlighting: ' . $this->config['highlight_language']);
            }
        } catch (Exception $e) {
            // 错误处理
            return '<pre>Error: ' . $e->getMessage() . '</pre>';
        }
    }

    // 获取主题样式
    private function getThemeStyles($theme) {
        // 这里可以扩展不同的主题样式
        switch ($theme) {
            case 'default':
                return '<span style="color: #0000FF;">';
            default:
                return '';
        }
    }
}

// 使用示例
// $highlighter = new CodeHighlighter(['highlight_theme' => 'default', 'highlight_language' => 'php']);
// echo $highlighter->highlight('<?php echo "Hello, World!"; ?>');
