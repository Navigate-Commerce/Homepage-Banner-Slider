# Navigate Commerce Homepage-Banner-Slider module for Magento 2
Add multiple homepage banner sliders in the Magento 2 backend and display them on the homepage. This module will also allow you to upload separate image for mobile device.

## How to install Navigate_HomepageBannerSlider module

### 1. composer Installation

Run the following command in Magento 2 root directory to install Navigate_HomepageBannerSlider module via composer.

#### Install

```
composer require navigate/module-banner-slider
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

#### Update

```
composer update navigate/module-banner-slider
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

Run below command if your store in the production mode:

```
php bin/magento setup:di:compile
```

### 2. Manual Installation

If you prefer to install this module manually, kindly follow the steps described below - 

- Download [the latest version here](https://github.com/navigatecommerce/magento-2-homepage-banner-slider/archive/refs/heads/main.zip) 
- Extract `main.zip` file to `app/code/Navigate/HomepageBannerSlider` ; You should create a folder path `app/code/Navigate/HomepageBannerSlider` if not exist.
- Go to Magento root directory and execute upgrade command to install `Navigate_HomepageBannerSlider`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```