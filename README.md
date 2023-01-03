# PHP Deprem API
Kandilli Rasathanesi'nin yayınladığı Türkiye geneli tüm depremler için REST API servisi.

-----------------------------------------

### Dokümantasyon
* [Parametreler](#parametreler)
* [Kullanım](#kullanım)
* [JSON Çıktısı](#json-çıktısı)

-----------------------------------------

### Katkıda Bulunanlar
İstediğiniz veya eksik olan özellikler için `issue` açabilirsiniz. Ya da katkıda bulunmak için kendiniz yazın ve `pull request` gönderin.

![Katkıda Bulunanlar](https://contrib.rocks/image?repo=hakansrndk60/php-deprem-api)

-----------------------------------------

### Parametreler

| Parametre | Default Değeri     | Açıklama                                      |
| --------- | ------------------ | --------------------------------------------- |
| year      | Yok (Zorunlu)      | Çekmek istediğiniz yıl.                       |
| month     | Yok (Zorunlu)      | Çekmek istediğiniz ay.                        |
| limit     | 50                 | Maksimum kaç tane veri çekileceğini belirler. |
| city      | Yok (Tüm şehirler) | Çekmek istediğiniz şehir.                     |

-----------------------------------------

### Kullanım
**01/2003 tarihinden bugüne kadar tüm deprem verilerine ulaşabilirsiniz.**

2023'ün Ocak ayında gerçekleşen depremleri getirir. Default olarak 50 sonuç getirir.
~~~
https://api.hknsoft.com/earthquake/v1/get?year=2023&month=01
~~~

Daha fazla veri çekmek için `limit` parametresi ekleyin.
~~~
https://api.hknsoft.com/earthquake/v1/get?year=2023&month=01&limit=500
~~~

Sadece İstanbul'da gerçekleşen depremleri getirir.

**Şehir isimlerinde türkçe karakter kullanılmamalı ve hepsi küçük harf olmalıdır.**
~~~
https://api.hknsoft.com/earthquake/v1/get?year=2023&month=01&limit=500&city=istanbul
~~~

Son 24 saatte gerçekleşen depremleri getirir.
~~~
https://api.hknsoft.com/earthquake/v1/last24hours
~~~

-----------------------------------------

### JSON Çıktısı
```jsonc
{
  ...
  "earthquakes": [
    {
      "date": "2023.01.02",
      "time": "12:54:25",
      "location": "GIRENCIK-ORHANELI",
      "city": "BURSA",
      "lat": "39.9252",
      "lng": "28.9023",
      "mag": "1.6",
      "depth": "0.0"
    },
    {
      "date": "2023.01.03",
      "time": "13:41:26",
      "location": "KUMYAKA-MUDANYA",
      "city": "BURSA",
      "lat": "40.4255",
      "lng": "28.8287",
      "mag": "2.9",
      "depth": "6.0"
    }
  ]
}
```

-----------------------------------------

### Uyarı
_Söz konusu bilgi, veri ve haritalar Boğaziçi Üniversitesi Rektörlüğü’nün yazılı izni ve onayı olmadan herhangi bir şekilde ticari amaçlı kullanılamaz._

Bu api Kandilli Rasathanesi'nin yayınladığı depremleri çekmektedir.

Referans: http://www.koeri.boun.edu.tr/scripts/lasteq.asp