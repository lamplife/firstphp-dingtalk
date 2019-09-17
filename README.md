# firstphp-dingtalk
钉钉开发组件 for hyperf

安装组件:

	composer require firstphp/dingtalk



发布配置:

	cp vendor/firstphp/dingtalk/src/Config/dingtalk.php config/autoload

	或

	php bin/hyperf.php vendor:publish firstphp/dingtalk



编辑.env配置：

	DINGTALK_URL=https://oapi.dingtalk.com/
	DINGTALK_APPID=dingoavde8e9au3bzeoaew
	DINGTALK_APPSECRET=l03242xmoe3YBnQVgaVbxKRPVxNHdFIg6YjkY0qowDtnhuqdqRwS3D9OXAU3G4mX



示例代码：

    use Firstphp\Dingtalk\DingtalkInterface;

    ......

    /**
     * @Inject
     * @var DingtalkInterface
     */
    protected $dingtalkInterface;

    public function test() {
        $res = $this->dingtalkInterface->gettoken();
        var_dump($res);
    }
