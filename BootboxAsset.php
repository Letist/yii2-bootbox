<?php 

namespace letist\assets;

use Yii;
use yii\web\AssetBundle;
 
class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootbox';

    public $css = [
    ];

    public $js = [
        'bootbox.js'
    ];

    public $depends = [
    ];

    /**
     * Registers the CSS and JS files with the given view.
     * @param \yii\web\View $view the view that the asset files are to be registered with.
     */
    public function registerAssetFiles($view)
    {

        $yes = Yii::t('app', 'Yes');
        $cancel = Yii::t('app', 'Cancel');

        $view->registerJs(<<<JS
yii.allowAction = function (e) {
    var message = e.data('confirm');
    return message === undefined || yii.confirm(message, e);
};

yii.confirm = function (message, ok, cancel) {

    bootbox.confirm(
        {
            message: message,
            buttons: {
                confirm: {label: '{$yes}'},
                cancel: {label: '{$cancel}'}
            },
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );

    return false;
};

window.alert = function (message) {
    bootbox.alert({
        message: message
    });
    return false;
};

JS
);

        parent::registerAssetFiles($view);
    }
}
