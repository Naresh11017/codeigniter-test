####

Template icinde modul view'ý gostermek icin WebIM'inki gibi bir yontem kullandim. Bunun icin su adimlari uyguladim:

* application/core altinda MY_Controller diye bir class oluþturdum. Bu class MX_Controller class'ini extend ediyor. Modul controllerlarimiz da bundan sonra MX_Controller yerine bu controller'i extend edecek.

* MY_Cotroller'da $template diye bir degisken actim ve bu controller'in icinde gosterilecegi template'in adini tutuyor. Default deger: "site". Eger bir admin controller'i yazarsak bunun admin template'inde goruntulenmesi icin tek yapmamiz gereken constructor'da $this->template = "admin" yazmak.

* MY_Controller'a _remap metodu yazdim. Bir controller'da _remap() metodu varsa sistem http://www.site.com/modul/cont/metod url'sini acarken bir tane "cont" controller'i uretip bunun "metod" metodunu cagirmak yerine bunun "_remap" metodunu cagirir ve "metod"u buna parametre olarak gonderir (Bkz. system/core/CodeIgniter.php, satir:323). Bunu nicin yaptigima asagida gelicem.

* Template'lerimizin index sayfalari application/views altinda bulunacak. Buraya site_template.php diye ornek bir dosya olusturdum. Dikkat edilmesi gereken bitr nokta var, o da template index sayfalarinin adi '_template' soneki ile bitmeli. Maksat view'in bir template oldugunu ilk bakista anlamak, tek basina calisabilen diger view'lerle karistirmamak.

* Basta application/templates diye bir klasor olusturup template'leri de mesela application/templates/site_template gibi klasorlere koymak istedim ama bunu yapmak icin ya HMVC gibi bir extension yapmak lazim ya da  CodeIgniter'in ya da HMVC'nin kodlarinda degisiklik yapmak. Cunku view'lerinizin duracagi klasoru sisteme tanitmaniz gerekiyor. Loader->app_package_path() kullanayim dedim, o da sikintili olacakti, ondan da vazgectim. Hem application/views klasoru de bos kalmamis oldu :) Ama yine siz bilirsiniz, koda giriselim derseniz girisiriz ama yarin birgun yeni versiyon cikarsa problem yasayabiliriz.

* ./content klasorunu olusturdum. Sitemizle alakali ne kadar css, js, resim, upload, vs. varsa bu klasorde duracak, tipki WordPress'deki wp-content klasoru gibi. Ornek olarak da 'site' template'inde kullanilacak dosyalari buraya attim (aslinda topu topu bir tane js dosyasi var..).

* .htaccess dosyasinda degisiklikler yaptim. (1) content klasorune erisimi actim ve (2) directory listing'i kapattim. http://localhost/ci/content adresine giderseniz server'in hata verdigini goreceksiniz. Directory listing'i kapattigim icin projedeki index.html dosyalarini sildim, nasil olsa artik ise yaramayacaklar. (40 kusur tane index.html vardi!)

* _remap'i nicin kullandigima gelelim. application/core/MY_Controller'daki _remap gelen talebi controller'in ilgili metodundan once yakaliyor ve Modules::run() metodunu kullanarak ilgili metodun urettigi ciktiyi $output'a atiyor. Sonra eger hakkaten $tamplate diye bir template varsa $output'u ona gonderiyor, yoksa direkt basiyor. Yok eger o controller $method diye bir metod hic yoksa 404'u cakiyor.

* application/config/config.php'de index_page'i bosa cektim. Boylece artik url_helper'daki site_url()'nin dondugu degerin sonu '/index.php' yerine sadece '/' ile bitiyor.

* application/helpers altina MY_url_helper.php dosyasini ekledim. Boylece artik $this->load->helper('url') deyince template_url fonksiyonu da yuklenecek. Bu fonksiyon'un ustune aciklama yazdim.

* Abi application/views/site_template.php'de <base> diye bir tag goreceksiniz. Bu tag sayesinde "js/jsfile.js" gibi relative path'lerin baslangic kismini bir kere ayarlayip kurtulabiliyoruz. Yani browser sanki site_template.php dosyasi application/views altinda degil de content/site_template altindaymis gibi calisiyor. Yazan arkadasi tebrik ediyorum :)

Abi ozetle sistemde config['index_page'] = 'index.php' ayarini bosaltmak ve .htaccess dosyasi haric hic kod degistimedim, hep mevcut kodun ustune ciktim.