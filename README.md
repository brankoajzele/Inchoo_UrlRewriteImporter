Inchoo_UrlRewriteImporter
=========================

Adds the posibility to mass import URL rewrites into Magento.

Once you install the extension, when you login to Magento administration interface and go to "Catalog > URL Rewrite Management" you should see a "Import URL Rewrites" button in the upper right corner next to standard "Add URL Rewrite" Magento button.

Clicking the "Import URL Rewrites" button opens the screen where you supply the CSV file with 2 columns of data. In the left column is the origin path, and in the right column is the destination path to which you wish to make a rewrite like shown below.

"store_id","request_path","target_path"
"1","product/1","product/iphone"

"1","product/2","product/iphone2"

"1","product/3","product/iphone3"

"1","product/4","product/iphone4"
