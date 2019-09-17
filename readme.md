SubCategoryBlocks Extension
=====================

Facts
-----
- version: 1.0.0
- [extension on GitHub](https://github.com/natedawg92/SubCategoryBlocks)
- [direct download link](https://github.com/natedawg92/SubCategoryBlocks/archive/master.zip)

Description
-----------
A Magento 2 module to add the option to show sub categories on a Product List page.
Adds the Following Options:
- Sub Category Blocks Only
- Sub Category Blocks and Products
- Sub Category Blocks, CMS Blocks and Products
- Sub Category List Only
- Sub Category List and Products
- Sub Category List, CMS Blocks and products

Requirements
------------
- PHP >= 7.0
- magento/module-catalog >= 100.0

Compatibility
-------------
- Magento >= 2.0

Installation Instructions
-------------------------
```BASH
composer config repositories.subcategoryblocks git git@github.com:natedawg92/SubCategoryBlocks.git
composer nathanday/module-subcategoryblocks
php bin/magento module:enable NathanDay_SubCategoryBlocks
php bin/magento setup:upgrade
```

Uninstallation
--------------
`php bin/magento module:uninstall NathanDay_SubCategoryBlocks`

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/natedawg92/SubCategoryBlocks/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
[Nathan Day](mailto:nathanday92@gmail.com)

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2019 NathanDay
