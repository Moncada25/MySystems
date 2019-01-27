<?php
define("KEY", "PackApps");
define("COD", "AES-128-ECB");

define("DESCARGAS", "1");

/* SANDBOX */
//define("LINKAPI", "https://api.sandbox.paypal.com");
//define("CLIENTID", "Af_zFuVd2QLuIZlolQn91bIVugQ4L0MfE0Zb-zRQGglWrou70Imrfh2E8AOQ0M5MtLr1xLt5f6SPoluK");
//define("SECRET", "EMwmIxIyvrpwJmbk6MBBMJw2keavjQFMG-jxhS6QQXMT9i2AXj-ubqVQfDoENAxD_wLuEtf2UIOF1TYI");

/* LIVE */
define("LINKAPI", "https://api.paypal.com");
define("CLIENTID", "ASuv78iK7bkReEHah5sbhQunwTRQZDgRxv0tFU_3fg9VIvchDdq_TigJzTAwK8Ok6LJyYeksb8mnwzMt");
define("SECRET", "EIRngmwO4b1wgAG4w7on5EObT2uy6AQm8ol3wyEPxb2MA1hYcqB64DP5wQLiD76Xx9nsp0Yx3SDz1AwF");

/* SERVICES */ 
define("R1", openssl_encrypt("Soporte para Smartphones", COD, KEY));
define("R2", openssl_encrypt("Soporte para PC", COD, KEY));
define("R3", openssl_encrypt("Desarrollador", COD, KEY));

/* SERVER */ 
/*define("SERVIDOR", "localhost");
define("USUARIO", "id8402412_mypackapps");
define("PASSWORD", "santiago123");
define("BD", "id8402412_mypackapps");*/

/* LOCALHOST */ 
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("PASSWORD", "");
define("BD", "tienda");
?>