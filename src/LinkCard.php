<?php

/**
 * A simple utility class to render a link card HTML snippet.
 * The resulting output is safely escaped to prevent XSS.
 */
class LinkCard
{
    /**
     * Default configuration for the link card.
     *
     * @var array
     */
    private static array $defaultConfig = [
        'url'         => 'https://main-m-aiyouxi.com.cn',
        'title'       => '爱游戏',
        'description' => '发现更多精彩游戏内容',
        'icon'        => '',
        'target'      => '_blank',
    ];

    /**
     * Build and return an escaped HTML link card.
     *
     * @param array $overrides Optional overrides for url, title, description, icon, target.
     * @return string The safe HTML string.
     */
    public static function render(array $overrides = []): string
    {
        $config = array_merge(self::$defaultConfig, $overrides);

        // Sanitize and escape each field individually
        $url         = htmlspecialchars($config['url'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $title       = htmlspecialchars($config['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $description = htmlspecialchars($config['description'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $icon        = htmlspecialchars($config['icon'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $target      = htmlspecialchars($config['target'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card" style="border:1px solid #ddd;border-radius:8px;padding:16px;max-width:400px;margin:12px 0;font-family:sans-serif;">';

        if ($icon !== '') {
            $html .= '<img src="' . $icon . '" alt="icon" style="width:32px;height:32px;vertical-align:middle;margin-right:8px;" />';
        }

        $html .= '<a href="' . $url . '" target="' . $target . '" rel="noopener noreferrer" style="text-decoration:none;color:#007bff;font-size:18px;font-weight:600;">';
        $html .= $title;
        $html .= '</a>';

        if ($description !== '') {
            $html .= '<p style="margin:8px 0 0;color:#555;font-size:14px;">' . $description . '</p>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * Render a predefined sample link card.
     *
     * @return string
     */
    public static function renderSample(): string
    {
        return self::render([
            'title'       => '爱游戏',
            'description' => '热门游戏推荐 · 尽在爱游戏',
            'url'         => 'https://main-m-aiyouxi.com.cn',
        ]);
    }

    /**
     * Render multiple link cards from an array of configurations.
     *
     * @param array $cards Array of associative arrays with keys: url, title, description, icon, target.
     * @return string Concatenated HTML of all cards.
     */
    public static function renderMultiple(array $cards): string
    {
        $output = '';
        foreach ($cards as $card) {
            $output .= self::render($card);
        }
        return $output;
    }
}

// Example usage (uncomment to test in isolation):
/*
echo LinkCard::renderSample();
echo "\n\n---\n\n";
echo LinkCard::render([
    'title'       => '爱游戏资讯',
    'description' => '最新游戏动态与攻略',
    'url'         => 'https://main-m-aiyouxi.com.cn/news',
    'icon'        => 'https://main-m-aiyouxi.com.cn/favicon.ico',
]);
*/