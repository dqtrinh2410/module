Magepow.com === Next Previous Product

Installation Guide
--------------------

1. Copy file đến thư mục /app trong project.

2. Mở command lines: 

    bật module 
        
        php bin/magento module:enable Magepow_Next
    check status module -> kiểm tra xem module đã được bật chưa
        
        php bin/magento module:status
    lần lượt chạy các lệnh sau: 
        
        php bin/magento setup:upgrade
        php bin/magento setup:static-content:deploy -f
        php bin/magento cache:flush
3. Trong cms(admin) config:

Configure:

STORES > Settings > Configuration > MAGEPOW > Next Previous Product > General Options > Enabled	> select Yes/No > Save Config


