-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 26 May 2020, 15:21:54
-- Sunucu sürümü: 10.4.10-MariaDB
-- PHP Sürümü: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `my_blog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blog_category`
--

INSERT INTO `blog_category` (`id`, `title`) VALUES
(243, 'Yazılım'),
(246, 'Gezi Yazıları'),
(247, 'Jquery Öğrenen Adam'),
(251, 'Html'),
(252, 'github');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_content`
--

DROP TABLE IF EXISTS `blog_content`;
CREATE TABLE IF NOT EXISTS `blog_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `text` longtext COLLATE utf8_turkish_ci NOT NULL,
  `tarih` datetime NOT NULL,
  `labels` text COLLATE utf8_turkish_ci NOT NULL,
  `visibility` int(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_content` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=484 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blog_content`
--

INSERT INTO `blog_content` (`id`, `title`, `text`, `tarih`, `labels`, `visibility`, `category_id`) VALUES
(404, 'Merhaba Blog Dünyası!', '&lt;pre&gt;\r\n&lt;code class=&quot;language-php&quot;&gt;$saySomething= &quot;merhaba blog dünyası&quot;;\r\necho $saySomething;&lt;/code&gt;&lt;/pre&gt;\r\n\r\n&lt;p&gt;D&amp;uuml;z metinler de&amp;nbsp; buraday&amp;nbsp; ekleniyor...&lt;/p&gt;\r\n\r\n&lt;p&gt;Yazı fontlarının kıyaslanabilmesi A&amp;Ccedil;ISINDAN. Bu &amp;Ouml;nemli !&amp;nbsp;&lt;/p&gt;', '2019-12-16 00:00:00', 'blog, yazılımcı blog, merhaba dünya php', 1, 243),
(426, 'iğneada', '&lt;p&gt;KIYIK&amp;Ouml;Y&lt;/p&gt;', '2018-01-30 00:00:00', 'trakya, gezi', 1, 246),
(427, 'Kıyıköy', '&lt;p&gt;KIYIK&amp;Ouml;Y&lt;/p&gt;', '2019-11-08 00:00:00', 'trakya, gezi', 1, 246),
(428, 'demirköy', '&lt;p&gt;KIYIK&amp;Ouml;Y&lt;/p&gt;', '2020-05-16 00:00:00', 'trakya, gezi', 1, 246),
(466, 'Jquery\'nin Gücü', '&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/php/blog/elFinder/files/jquery.png&quot; style=&quot;height:273px; width:500px&quot; /&gt;power of JQUERY&lt;/p&gt;', '2020-05-23 00:00:00', 'jquery, javascript, jquery nedir?,jquery ile neler yapılabilir', 1, 247),
(467, 'JAVASCRİPT DEĞİL JQUERY :))', '&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/php/blog/elFinder/files/jquery.png&quot; style=&quot;height:273px; width:500px&quot; /&gt;power of JQUERY&lt;/p&gt;', '2020-05-04 00:00:00', 'jquery, javascript, jquery nedir?,jquery ile neler yapılabilir', 1, 247),
(468, 'JAVASCRİPT', '&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://localhost/php/blog/elFinder/files/jquery.png&quot; style=&quot;height:273px; width:500px&quot; /&gt;power of JQUERY&lt;/p&gt;', '2020-05-15 00:00:00', 'jquery, javascript, jquery nedir?,jquery ile neler yapılabilir', 1, 247),
(477, 'Tarih denemesi Tarih denemesi Tarih denemesi Tarih denemesi Tarih denemesi', '&lt;p&gt;ads&lt;/p&gt;', '2020-05-22 00:00:00', 'yazılım ve okul, alaylı yazılımcı', 1, 243),
(478, 'mysql', '&lt;pre&gt;\r\n&lt;code class=&quot;language-sql&quot;&gt;SELECT blog_content.title, \r\nCOUNT(blog_counter.content_id) as countNumber, \r\nblog_content.tarih \r\n\r\nFROM `blog_counter` \r\nINNER JOIN blog_content ON blog_content.id = blog_counter.content_id \r\nWHERE blog_content.tarih BETWEEN \'2020-04-29\' AND \'2020-06-29\' \r\nGROUP BY blog_counter.content_id \r\nORDER BY COUNT(blog_counter.content_id) \r\nDESC LIMIT 10&lt;/code&gt;&lt;/pre&gt;\r\n\r\n&lt;h6&gt;&amp;nbsp;&lt;/h6&gt;', '2020-06-29 00:00:00', 'sql, mysql', 1, 243),
(479, 'Mert SARICA', '&lt;p&gt;Kariyer hayatım, 2003 yılında eğitim aldığım&amp;nbsp;&lt;a href=&quot;http://yeditepe.edu.tr/&quot; target=&quot;_blank&quot;&gt;Yeditepe &amp;Uuml;niversitesi&lt;/a&gt;&amp;lsquo;nin elektronik ders se&amp;ccedil;me uygulaması &amp;uuml;zerinde keşfetmiş olduğum kritik g&amp;uuml;venlik zafiyetini &amp;uuml;niversite y&amp;ouml;netimi ile paylaşmam ile başladı. Bu paylaşım &amp;uuml;zerine &amp;uuml;niversite y&amp;ouml;netimi tarafından başarı bursu ile &amp;ouml;d&amp;uuml;llendirildim ve 2005 yılında Ethical Hacker olarak işe alındım. 2006 yılında Yeditepe &amp;Uuml;niversitesi,&amp;nbsp;&lt;a href=&quot;http://ticaribilimler.yeditepe.edu.tr/tr/bilisim-sistemleri-ve-teknolojileri-bolumu/duyuru/tanitim-gunleri-bilisim-sistemleri-ve&quot; target=&quot;_blank&quot;&gt;Bilişim Sistemleri ve Teknolojileri&lt;/a&gt;&amp;nbsp;b&amp;ouml;l&amp;uuml;m&amp;uuml;nden mezun oldum. 2010 yılında ise Yeditepe &amp;Uuml;niversitesi,&amp;nbsp;&lt;a href=&quot;http://sbe.yeditepe.edu.tr/tr/isletme-tezsiz-yuksek-lisans-programi&quot; target=&quot;_blank&quot;&gt;İngilizce İşletme&lt;/a&gt;&amp;nbsp;(MBA) programını tamamladım.&lt;/p&gt;\r\n\r\n&lt;p&gt;2018 yılı itibariyle 25 &amp;ccedil;alışana sahip olan Siber Saldırı Tespit ve M&amp;uuml;dahale, Siber G&amp;uuml;venlik M&amp;uuml;hendisliği, Siber Tehdit İstihbaratı ve Zafiyet Y&amp;ouml;netimi ekiplerinden sorumlu m&amp;uuml;d&amp;uuml;r olarak&amp;nbsp;&lt;a href=&quot;http://www.akbank.com/&quot; target=&quot;_blank&quot;&gt;Akbank&lt;/a&gt;&amp;nbsp;Siber G&amp;uuml;venlik Merkezi&amp;rsquo;nde (SGM) g&amp;ouml;rev yapmaktayım.&lt;/p&gt;\r\n\r\n&lt;p&gt;2007 &amp;ndash; 2017 yıllarında&amp;nbsp;&lt;a href=&quot;http://www.qnbfinansbank.com/&quot; target=&quot;_blank&quot;&gt;QNB Finansbank&lt;/a&gt;&amp;rsquo;ın Bilgi Teknolojileri firması olan&amp;nbsp;&lt;a href=&quot;http://www.ibtech.com.tr/&quot; target=&quot;_blank&quot;&gt;IBTech&lt;/a&gt;&amp;nbsp;firmasında, sızma testi, zararlı yazılım analizi, bilgisayar olayları tespit ve m&amp;uuml;dahale alanlarından sorumlu olan Tehdit ve Zafiyet Y&amp;ouml;netimi Ekibi&amp;rsquo;nde Teknik Lider olarak g&amp;ouml;rev yaptım.&lt;/p&gt;\r\n\r\n&lt;p&gt;2014 &amp;ndash; 2016 yıllarında Bah&amp;ccedil;eşehir &amp;Uuml;niversitesi, Siber G&amp;uuml;venlik Y&amp;uuml;ksek Lisans Programı&amp;rsquo;nda Zararlı Yazılım Analizi eğitimi verdim.&lt;/p&gt;\r\n\r\n&lt;p&gt;2012 yılından bu yana,&amp;nbsp;&lt;a href=&quot;https://twitter.com/halilozturkci&quot; target=&quot;_blank&quot;&gt;Halil &amp;Ouml;ZT&amp;Uuml;RKCİ&lt;/a&gt;&amp;nbsp;ve&amp;nbsp;&lt;a href=&quot;https://twitter.com/warex&quot; target=&quot;_blank&quot;&gt;Sertan KOLAT&lt;/a&gt;&amp;nbsp;ile birlikte, siber g&amp;uuml;venlik d&amp;uuml;nyasında yaşananları keyifli bir dille ele aldığımız&amp;nbsp;&lt;a href=&quot;http://www.guvenliktv.org/&quot; target=&quot;_blank&quot;&gt;G&amp;uuml;venlik TV&lt;/a&gt;&amp;nbsp;programının sunuculuğunu yapmaktayım.&lt;/p&gt;\r\n\r\n&lt;p&gt;Boş vakitlerimi siber g&amp;uuml;venlik &amp;uuml;zerine araştırmalar yaparak ge&amp;ccedil;irmekteyim.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Lisans (Undergraduate)&lt;/strong&gt;&lt;br /&gt;\r\nBilişim Sistemleri ve Teknolojileri (Information Systems and Technologies) / Yeditepe &amp;Uuml;niversitesi&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Y&amp;uuml;ksek Lisans (Graduate)&lt;/strong&gt;&lt;br /&gt;\r\nİşletme Programı (Business Administration) / Yeditepe &amp;Uuml;niversitesi&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sertifikalar (Certificates)&lt;/strong&gt;&lt;br /&gt;\r\n2013 &amp;ndash; CEREA (Certified Expert Reverse Engineering Analyst),&lt;br /&gt;\r\n2010 &amp;ndash; CREA (Certified Reverse Engineering Analyst),&lt;br /&gt;\r\n2009 &amp;ndash; OPST (OSSTMM Professional Security Tester),&lt;br /&gt;\r\n2009 &amp;ndash; OSCP (Offensive Security Certified Professional),&lt;br /&gt;\r\n2007 &amp;ndash; CISSP (Certified Information Systems Security Professional),&lt;br /&gt;\r\n2006 &amp;ndash; SSCP (Systems Security Certified Practitioner)&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Eğitimler (Trainings)&lt;/strong&gt;&lt;br /&gt;\r\n2020 &amp;ndash; Blue Team Fundamentals: Security Operations and Analysis (SEC 450)&lt;br /&gt;\r\n2019 &amp;ndash; Security Strategic Planning, Policy, and Leadership (MGT 514)&lt;br /&gt;\r\n2018 &amp;ndash; The Security Automation Lab (Black Hat USA 2018)&lt;br /&gt;\r\n2017 &amp;ndash; Advanced Digital Forensics, Incident Response, and Threat Hunting (FOR 508)&lt;br /&gt;\r\n2016 &amp;ndash; Hardware Hacking With Hardsploit Framework (Black Hat USA 2016)&lt;br /&gt;\r\n2015 &amp;ndash; Exploit Laboratory: Black Belt (Black Hat USA 2015)&lt;br /&gt;\r\n2014 &amp;ndash; Advanced Penetration Testing, Exploits, and Ethical Hacking (SEC 660)&lt;br /&gt;\r\n2013 &amp;ndash; Advanced Reverse Engineering Malware&lt;br /&gt;\r\n2012 &amp;ndash; Reverse-Engineering Malware (FOR 610)&lt;br /&gt;\r\n2011 &amp;ndash; Computer Forensic Investigations &amp;ndash; Windows In-Depth (FOR 408)&lt;br /&gt;\r\n2010 &amp;ndash; Reverse Engineering: Malware, Binary Analysis and Software Vulnerabilities&lt;br /&gt;\r\n2009 &amp;ndash; OSSTMM Professional Security Tester (OPST)&lt;br /&gt;\r\n2009 &amp;ndash; Pentesting with BackTrack (OSCP)&lt;br /&gt;\r\n2008 &amp;ndash; Oracle Anti Hacker Training&lt;br /&gt;\r\n2007 &amp;ndash; BS 7799 (27001) &amp;ndash; Lead Auditor&lt;br /&gt;\r\n2006 &amp;ndash; BS 7799 (27001) &amp;ndash; Implementation of Information Security Management&lt;br /&gt;\r\n2005 &amp;ndash; Certified Ethical Hacker (CEH)&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sunumlar (Presentations)&lt;/strong&gt;&lt;br /&gt;\r\n2019 &amp;ndash; Sandbox Detection (NOPcon Hacker Conference)&lt;br /&gt;\r\n2019 &amp;ndash; Backdoor Hunt (IstSec Information Security Conference)&lt;br /&gt;\r\n2016 &amp;ndash; 2017 Hunting Hackers with Custom Deception System &amp;ndash; (Bilisim Zirvesi, Istanbul &amp;amp; Cyprus Cyber Security Conferences)&lt;br /&gt;\r\n2016 &amp;ndash; Malicious JavaScript Analysis &amp;ndash; (Netsec)&lt;br /&gt;\r\n2016 &amp;ndash; Being a Penetration Tester and Career &amp;ndash; (Cyber Security Winter Camp)&lt;br /&gt;\r\n2015 &amp;ndash; Homemade Cryptolocker Prevention Tool (CryptoKiller) &amp;ndash; (IstSec Information Security Conference)&lt;br /&gt;\r\n2015 &amp;ndash; Cyber Attacks &amp;amp; Defence (International Internal Audit Conference (TIDE))&lt;br /&gt;\r\n2015 &amp;ndash; Firmware Analysis &amp;ndash; (Hacktrick Information Security Conference)&lt;br /&gt;\r\n2014 &amp;ndash; Firmware Analysis &amp;ndash; (IstSec Information Security Conference)&lt;br /&gt;\r\n2013 &amp;ndash; Anti Malware Analysis &amp;ndash; (IstSec Information Security Conference)&lt;br /&gt;\r\n2013 &amp;ndash; Offensive Malware Analysis &amp;ndash; (Euroforensics, Cyprus, IstSec Information Security Conference)&lt;br /&gt;\r\n2012 &amp;ndash; Importance Of Penetration Testing &amp;ndash; (Netsec)&lt;br /&gt;\r\n2012 &amp;ndash; Android Mobile App Pentest &amp;ndash; (NOPcon)&lt;br /&gt;\r\n2012 &amp;ndash; Android Malware Analysis &amp;ndash; (Euroforensics)&lt;br /&gt;\r\n2011 &amp;ndash; 2019 How to Become an Ethical Hacker / Penetration Tester &amp;ndash; (Universities)&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;\r\n	&lt;p&gt;&lt;a href=&quot;https://eksisozluk.com/?q=akbank&quot;&gt;akbank&lt;/a&gt;&amp;nbsp;cyber defense center vp&amp;#39;si.&lt;br /&gt;\r\n	&lt;br /&gt;\r\n	&lt;a href=&quot;https://www.mertsarica.com/&quot; target=&quot;_blank&quot;&gt;https://www.mertsarica.com/&lt;/a&gt;&amp;nbsp;isminde bir blogu vardır. yazdığı yazıları yıl sonunda kitap olarak sunar. yıllardır siber g&amp;uuml;venlik alanında &amp;ccedil;alışmak isteyen &amp;ouml;ğrencilere &amp;ouml;rnek olmuştur.&lt;br /&gt;\r\n	&lt;br /&gt;\r\n	halk arasında sarıcaların mert diye de hitap edildiği duyulmuştur.&lt;/p&gt;\r\n\r\n	&lt;p&gt;&amp;nbsp;2&lt;/p&gt;\r\n	&lt;a href=&quot;https://eksisozluk.com/entry/99983105&quot;&gt;03.01.2020 01:19&lt;/a&gt;&amp;nbsp;&lt;a href=&quot;https://eksisozluk.com/biri/modest-mouse&quot;&gt;modest mouse&lt;/a&gt;&amp;nbsp;\r\n\r\n	&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n	&lt;/li&gt;\r\n	&lt;li&gt;\r\n	&lt;p&gt;guvenliktv.org adresinde siber d&amp;uuml;nya hakkında da &amp;ouml;nemli bilgiler verir. isteseler bu siteyi 1 ayda duman ederler &amp;ouml;yle diyim size.&lt;/p&gt;\r\n\r\n	&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n	&lt;a href=&quot;https://eksisozluk.com/entry/100112083&quot;&gt;05.01.2020 22:54&lt;/a&gt;&amp;nbsp;&lt;a href=&quot;https://eksisozluk.com/biri/blsmfadem&quot;&gt;blsmfadem&lt;/a&gt;&amp;nbsp;\r\n\r\n	&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n	&lt;/li&gt;\r\n	&lt;li&gt;\r\n	&lt;p&gt;pi hediyem var oyunu var şuan. siber g&amp;uuml;venlikle ilgilenenler bakabilir.&lt;/p&gt;\r\n	&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img src=&quot;https://hozkomurcu.com/wp-content/uploads/2013/05/mert-sarica.jpg&quot; style=&quot;height:425px; width:500px&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;CEH ya da benzeri bir sertifika sahibi misiniz ya da bu işin bir eğitimini aldınız mı?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;İşe ilk girdiğim yıl olan 2005 yılında, &amp;uuml;niversite y&amp;ouml;netimi tarafından Certified Ethical Hacker eğitimine g&amp;ouml;nderilmiştim fakat o zamana dek okuduğum kitaplardan ve makalelerden edindiğim bilgiler, eğitim i&amp;ccedil;eriğinden &amp;ccedil;ok daha ileri seviyede olduğu i&amp;ccedil;in eğitimin bir katma değerini ne yazık ki g&amp;ouml;rememiştim.&lt;/p&gt;\r\n\r\n&lt;p&gt;G&amp;uuml;venlik ile ilgili her daim kitap okuduğum i&amp;ccedil;in &amp;ccedil;oğunlukla eğitimleri, sahip olduğum bilgiyi sertifikalandırmak ve CV&amp;rsquo;imde yer etmesi amacıyla kullanıyorum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Sahip olduğum g&amp;uuml;venlik sertifikaları CISSP, OSCP, OPST, CREA, SSCP&amp;rsquo;dir. CEH eğitimi ve sertifikasyonunun temeli, ezbere y&amp;ouml;nelik olduğu i&amp;ccedil;in CEH sertifikası yerine 2009 yılında, eğitimi ve sınavı pratiğe dayalı olan (hedef sistemleri hackleyerek sınavı ge&amp;ccedil;ebiliyorsunuz), OSCP (Offensive Security Certified Professional) sertifikasını aldım.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Hacker olmak i&amp;ccedil;in hep meraklı olmak gerek derler. Sizce merak yeterli mi?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;2-3 yaşında anneniz, babanız size efendi efendi oynamanız i&amp;ccedil;in bir oyuncak alıp &amp;ouml;n&amp;uuml;n&amp;uuml;ze koyuyorsa ve siz kalkıp bunun i&amp;ccedil;inde ne var diyerek canım oyuncağı kırıp, i&amp;ccedil;ine bakıyorsanız ve 31 yaşına geldiğinizde de mesleğiniz gereği acaba bu sistem, bu uygulama nasıl &amp;ccedil;alışıyor? nasıl hacklenir?, bu zararlı yazılım nasıl &amp;ccedil;alışıyor ? gibi sorular soruyorsanız, evet, belki de merak bu işte başarılı olmanızı sağlayan en &amp;ouml;nemli etkenlerden bir tanesidir. Tabii sadece merak, başarılı olmak i&amp;ccedil;in tek başına yeterli olmuyor &amp;ouml;zellikle sunum yaptığın &amp;uuml;niversitelerde de bu işe ilgi duyan &amp;ouml;ğrenci arkadaşlara da s&amp;ouml;ylediğim gibi &amp;ouml;nce merak sonra bol bol okumak ve bol bol pratik yapmak bu iş i&amp;ccedil;in olmazsa olmazdır.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Kendinizi &amp;ldquo;hacker&amp;rdquo; olarak mı yoksa &amp;ldquo;g&amp;uuml;venlik&amp;nbsp;&lt;a href=&quot;http://uzman.semiyun.com/&quot;&gt;uzman&lt;/a&gt;ı&amp;rdquo; olarak mı tanımlıyorsunuz? Ya da farklı bir tanım var mı?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Yazılı ve g&amp;ouml;rsel medyada 2000 yılından bu yana değişmeyen tek şey hırlıya, hırsıza, bilene, bilmeyene hacker sıfatının yakıştırılıyor olmasıdır. G&amp;uuml;venlik d&amp;uuml;nyasında ger&amp;ccedil;ek manada hacker, PacketStorm&amp;rsquo;dan istismar kodu indiren, derleyen ve sisteme sızan kişi değildir. Hacker, papağan dediğimiz banka kart kopyalamak i&amp;ccedil;in kullanılan cihaz ile banka kartı kopyalayan kişiye de denmez.&lt;/p&gt;\r\n\r\n&lt;p&gt;Hacker, ben hackerım diyene de denmez. Benim i&amp;ccedil;in hacker kısaca ve kabaca programlama bilgi ve becerisine sahip, g&amp;uuml;venlik zafiyeti keşfedebilen, istismar kodu yazabilen ve bunu g&amp;ouml;sterebilen kişiye denir. Eğer bir program ile sisteme sızabilen hacker olsaydı bug&amp;uuml;n Farmville&amp;rsquo;de tarla s&amp;uuml;renin &amp;ccedil;ift&amp;ccedil;i, tayt ve pelerin giyenin S&amp;uuml;perman, fare ve klavye kullanabilenin bilgisayar m&amp;uuml;hendisi, &amp;ccedil;ikita muz&amp;rsquo;u yazanın da sanat&amp;ccedil;ı olması gerekirdi.&lt;/p&gt;\r\n\r\n&lt;p&gt;13-14 yaşında rumuzunu hatırlayamadığım ancak beni doğru y&amp;ouml;nlendiren bir yabancıya, hacker nasıl olabilirim ? sorusunu sorduğumda bana verdiği cevap, C programlama dili bilmeli, ağ programlaması bilmeli ve Linux işletim sistemini kullanabilmelisin olmuştu. O yaşlarda bunları &amp;ouml;ğrenip ardından kendi g&amp;uuml;venlik zafiyetimi keşfedip, kendi istismar kodumu yazabilir hale geldiysem ve &amp;ouml;ğrendiklerimi ve bildiklerimi insanlarla paylaşabiliyorsam, g&amp;ouml;n&amp;uuml;l rahatlığıyla kendime hacker diyebiliyorum. Ancak hacker&amp;rsquo;ın yazılı ve g&amp;ouml;rsel medyada k&amp;ouml;t&amp;uuml; olarak lanse edilmesi, bug&amp;uuml;n geldiğimiz noktada Ethical Hacker kavramının ortaya &amp;ccedil;ıkmasına neden olmuştur.&lt;/p&gt;\r\n\r\n&lt;p&gt;Kısacası karşımdakinin farkındalığına g&amp;ouml;re kimi zaman ethical hacker&amp;rsquo;ı, kimi zaman ahlaklı korsan&amp;rsquo;ı, kimi zaman penetration tester&amp;rsquo;ı, kimi zaman ise bilişim g&amp;uuml;venlik uzmanını kullanmaktayım.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Bir keresinde bir &amp;ldquo;g&amp;uuml;venlik uzmanı&amp;rdquo; asla başka bir hackerı başka bir hackera &amp;ouml;vme demişti bana. Ancak yine de soracağım, sizin &amp;ouml;rnek aldığınız, hayranı olduğunuz bir hacker var mı?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;http://www.vupen.com/english/&quot; target=&quot;_blank&quot;&gt;VUPEN&lt;/a&gt;&amp;nbsp;ekibinin ve Charlie Miller&amp;rsquo;ın yaptığı araştırmaları, &amp;ccedil;alışmaları olduk&amp;ccedil;a beğendiğimi s&amp;ouml;yleyebilirim.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Hackerlar arasında &amp;ldquo;lamer&amp;rdquo; ve &amp;ldquo;uzman&amp;rdquo; lafları sık&amp;ccedil;a kullanılıyor. Sizce lamer&amp;rsquo;in ger&amp;ccedil;ek tanımı nedir kime denir?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Bana g&amp;ouml;re lamer, sahip olduğu teknik bilgi ve beceri hacker ile aynı olmayan, başkalarının &amp;uuml;rettiği programlara bağlı kalan, her mikrofon uzatıldığında ben hackerım diyen ama ortaya somut birşey koyamayan kişiye denir.&lt;br /&gt;\r\n&lt;strong&gt;Artık yasalarında iyileşmesiyle birlikte hacking haberlerini kredi kartı bilgileri vs. yerine sosyal medya &amp;uuml;zerinden daha &amp;ccedil;ok duyar olduk. Sizce Sosyal Medya&amp;rsquo;da kullanılan servisin g&amp;uuml;venlik protokolleri dışında başka &amp;ouml;nlemler almak gerekli mi?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Belki &amp;ccedil;ok klişe olacak ancak insan, g&amp;uuml;venliğin en zayıf halkasıdır bu nedenle en temel kural, servis bağımsız olarak dikkatli ve temkinli olmak, tanımadığımız kişilerden gelen mesajları ve eklentileri a&amp;ccedil;mamak olmalıdır.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Mobilin gelişmesiyle birlikte g&amp;uuml;venlik uzmanları daha &amp;ccedil;ok mobil sistemlerdeki a&amp;ccedil;ıklarla uğraşır oldu. Sanıyorum burada işletim sisteminin de etkisi olduk&amp;ccedil;a b&amp;uuml;y&amp;uuml;k. Sizce en g&amp;uuml;venli mobil işletim sistemi hangisi?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Mobil işletim sistemleri hen&amp;uuml;z emekleme evresinde olan işletim sistemleridir bu nedenle sık&amp;ccedil;a g&amp;uuml;venlik zafiyetleri ile karşılaşıyor olmamızı &amp;ccedil;ok yadırgamıyorum. Bug&amp;uuml;n baktığınız zaman iPhone&amp;rsquo;un Jailbreak edilmesi, bir g&amp;uuml;venlik zafiyetinin istismar edilmesi ile oluyorsa ve bu işlem bir web sitesi &amp;uuml;zerinden ger&amp;ccedil;ekleşebiliyorsa benzer sıkıntılar Android işletim sistemi i&amp;ccedil;in de ge&amp;ccedil;erliyse o veya bu daha g&amp;uuml;venli demem pek doğru olmayacaktır. Ancak soruyu zararlı yazılım bulaşma riski a&amp;ccedil;ısından ele alırsak, Apple firması işi sıkı tuttuğu ve her uygulamayı App Store&amp;rsquo;a y&amp;uuml;klemeden &amp;ouml;nce kaynak kod seviyesinde (code review) kontrolden ge&amp;ccedil;iriyorsa fakat Google bu işi bu kadar sıkı tutmuyorsa, son kullanıcı i&amp;ccedil;in iPhone (iOS) daha g&amp;uuml;venlidir diyebilirim. Bu arada yeri gelmişken, jailbreak ettiğiniz veya root yetkisi kazandığınız her cihazın, &amp;ccedil;eşitli g&amp;uuml;venlik kontrollerini devre dışı bıraktığını dolayısıyla sizi g&amp;uuml;venlik tehditlerine karşı korunmasız hale getirdiğini ayrıca belirtmek isterim.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Son d&amp;ouml;nemlerde sık&amp;ccedil;a telefon g&amp;ouml;r&amp;uuml;şmelerinin dinlenebilir olduğundan bahsediliyor. Dinlenemeyen telefon ya da izlenemeyen mesajlaşma uygulaması var mı?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;ldquo;Akıllı telefonunuzun şarjı &amp;ccedil;abuk bitiyorsa dinleniyor olabilirsiniz&amp;rdquo; gibi s&amp;ouml;ylemler bana daha &amp;ccedil;ok bu işten nemalanmak isteyenlerin akılcı oyunları gibi geliyor.&lt;/p&gt;\r\n\r\n&lt;p&gt;Akıllı telefonlar/cihaz &amp;uuml;zerinde uygulamalar yardımı &amp;ccedil;eşitli şifrelemeler kullanılarak g&amp;ouml;r&amp;uuml;şmelerin, mesajlaşmaların yasa dışı yollardan izlenmesi engellenebilir ancak akıllı telefonlar/cihazlar &amp;uuml;zerinde barınan ve en y&amp;uuml;ksek yetkiye sahip olan bir casus yazılım ile teknik olarak t&amp;uuml;m g&amp;ouml;r&amp;uuml;şmeler dinlenebilir, mesajlaşmalar izlenebilir.&lt;br /&gt;\r\nYasal yollardan ise dinlenemeyen, izlenemeyen bir cihaz olamaz diye d&amp;uuml;ş&amp;uuml;n&amp;uuml;yorum&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;DDoS saldırıları bir &amp;ccedil;ok site i&amp;ccedil;in en sevimsiz ve en kolay ger&amp;ccedil;ekleştirilebilen saldırı. K&amp;uuml;&amp;ccedil;&amp;uuml;k siteler bu saldırılara nasıl karşı koyabilir neler &amp;ouml;nerebilirsiniz?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Ge&amp;ccedil;tiğimiz ay ger&amp;ccedil;ekleşen ve basına da yansıyan 300 GB b&amp;uuml;y&amp;uuml;kl&amp;uuml;ğ&amp;uuml;ndeki bir DDOS saldırısının CloudFlare hizmeti ile engellenmesi, k&amp;uuml;&amp;ccedil;&amp;uuml;k işletmeler, siteler i&amp;ccedil;in kullanılabilecek en akılcı &amp;ccedil;&amp;ouml;z&amp;uuml;m olur diye d&amp;uuml;ş&amp;uuml;n&amp;uuml;yorum.&amp;nbsp;&lt;a href=&quot;http://blog.cloudflare.com/the-ddos-that-almost-broke-the-internet&quot; target=&quot;_blank&quot;&gt;Bkz&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Mobilde ve Masa&amp;uuml;st&amp;uuml;nde hangi antivir&amp;uuml;s ve firewall yazılımlarını &amp;ouml;nerirsiniz?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Mobil işletim sistemleri, uygulamaları kum havuzu (Sandbox) dediğimiz kısıtlı erişime ve yetkiye sahip alanlarda &amp;ccedil;alıştırdığı i&amp;ccedil;in bu alanda &amp;ccedil;alışan ve en y&amp;uuml;ksek yetkiye sahip olmayan bir yazılımdan sisteminizde tam koruma sağlamasını beklemek &amp;ccedil;ok ger&amp;ccedil;ek&amp;ccedil;i olmaz bu nedenle mobil işletim sistemlerinde kullanılan Antivir&amp;uuml;s yazılımlarına &amp;ouml;ncelikle &amp;ccedil;ok g&amp;uuml;venmek ve beklentiyi &amp;ccedil;ok y&amp;uuml;ksek tutmak &amp;ccedil;ok doğru olmayacaktır. İsimden ziyade herhangi bir antivir&amp;uuml;s yazılımı kullanmanız yeterli olacaktır.&lt;/p&gt;\r\n\r\n&lt;p&gt;Masa&amp;uuml;st&amp;uuml; antivir&amp;uuml;s yazılımları da baktığınız zaman ciddi bir siber saldırıda atlatılabildiği, devre dışı bırakılabildiği i&amp;ccedil;in yine isimden ziyade Symantec, Mcafee, Kaspersky, Eset vb. bilinen, k&amp;ouml;kl&amp;uuml; &amp;uuml;reticilere ait antivir&amp;uuml;s yazılımlarından birinin kullanılması faydalı olacaktır.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sosyal Ağlarda Clickjacking, Fake Application vb. saldırılara karşı son kullanıcılara ne gibi &amp;ouml;nerileriniz olabilir?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Sosyal ağlar ve sosyal medya &amp;uuml;zerinden gelebilecek saldırılara karşı daha &amp;ouml;nce de bahsettiğim gibi temkinli ve dikkatli olmak, ş&amp;uuml;pheli mesajları a&amp;ccedil;mamak, her bağlantı adreslerine (link) tıklamamak, clickjacking vb. uygulama saldırılarına karşı Noscript gibi internet tarayıcısı eklentileri kullanmak, sahte uygulamalara karşı ise sizden istediği izinleri kontrol etmek (sizin adınıza mesaj g&amp;ouml;nderme izni, arkadaş listenizi &amp;ccedil;ekme izni gibi.) yararınıza olacaktır.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;T&amp;uuml;rkiye&amp;rsquo;deki hacker gruplarından biraz bahseder misiniz? Aktif olan, herkesin takip etmesi gereken gruplar hangileri?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;T&amp;uuml;rk Ceza Kanunu&amp;rsquo;na ve uluslararası hukuka g&amp;ouml;re bilişim su&amp;ccedil;u işlemeyen bir hacker grubundan haberdar değilim bu nedenle bir tavsiyede bulunamayacağım.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;T&amp;uuml;rkiye bug&amp;uuml;ne dek &amp;ccedil;ok b&amp;uuml;y&amp;uuml;k &amp;ccedil;aplı bir siber saldırıya maruz kaldı mı?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Benim duyduğum ve/veya basına yansıyan Stuxnet, Flame ve benzeri bir siber saldırı ile hen&amp;uuml;z karşılaşmadık ancak karşılaşsaydık mevcut altyapımız ve kullandığımız teknolojiler ile bunu tespit edebilir miydik budan pek emin değilim &amp;ccedil;&amp;uuml;nk&amp;uuml; baktığınız zaman APT (advanced persistent threat) dediğimiz &amp;ldquo;gizlen ve aksiyon al&amp;rdquo; y&amp;ouml;ntemini izleyen bu t&amp;uuml;r siber saldırılardan doğası gereği saldırısından uzunca bir zaman sonra haberdar olmaktayız.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;Ouml;rneğin Kaspersky sayesinde Stuxnet&amp;rsquo;ten sonra ortaya &amp;ccedil;ıkan ve siber silah olarak kullanılan Flame zararlı yazılımının T&amp;uuml;rkiye&amp;rsquo;de bir komuta kontrol merkezi olduğunu &amp;ouml;ğrendik. G&amp;ouml;n&amp;uuml;l isterki bu t&amp;uuml;r analizleri ve tespitleri kendi yerli kaynaklarımızla yapabilelim, yerli haber kaynaklarımız ile bunlardan haberdar olabilelim.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;T&amp;uuml;rkiye&amp;rsquo;de devlet kurumları siber saldırılar i&amp;ccedil;in ne kadar hazır?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Tatbikata ve medya &amp;uuml;zerinden siber g&amp;uuml;venlik bombardımanına/farkındalığına rağmen &amp;ccedil;eşitli gruplar tarafından devlet kurumları hacklenebiliyorsa ve &amp;ouml;zellikle bu saldırıların da uluslararası boyutlarda siber silahlar ile ger&amp;ccedil;ekleştirilen siber saldırılar olmadığını da d&amp;uuml;ş&amp;uuml;nd&amp;uuml;ğ&amp;uuml;m&amp;uuml;zde hazır olduğumuzu s&amp;ouml;ylemem pek doğru olmayacaktır. Umuyorum ki T&amp;uuml;bitak b&amp;uuml;nyesinde kurulan Siber G&amp;uuml;venlik Enstit&amp;uuml;s&amp;uuml; ile siber saldırıları &amp;ouml;nlemeye, tespit etmeye ve aksiyon almaya y&amp;ouml;nelik ciddi adımlar atılacaktır.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;D&amp;uuml;nyada siber saldırılara karşı en hazırlıklı &amp;uuml;lke hangisi?&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Dışarıdan bu konuda net bir şey s&amp;ouml;ylemek olduk&amp;ccedil;a g&amp;uuml;&amp;ccedil; ancak g&amp;ouml;rd&amp;uuml;ğ&amp;uuml;m kadarıyla G&amp;uuml;ney Kore bu konuda olduk&amp;ccedil;a hazırlık yapmış. 20 Mart tarihinde G&amp;uuml;ney Kore&amp;rsquo;ye yapılan siber saldırı ile 3 banka ve 3 medya organı &amp;ccedil;alışamaz hale geldi. Baktığınız zaman 1 saat i&amp;ccedil;inde hem emniyetin hem de ordunun alarm durumuna ge&amp;ccedil;mesi ve soruşturma başlatması, 3 bankadan ikisinin 2 saat i&amp;ccedil;inde tekrar &amp;ccedil;alışır hale gelmesi hazırlığın &amp;ouml;nemini g&amp;ouml;zler &amp;ouml;n&amp;uuml;ne sermektedir.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;http://www.mertsarica.com/&quot; target=&quot;_blank&quot;&gt;&lt;strong&gt;Mert Sarıca&lt;/strong&gt;&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Kariyer hayatım, 2003 yılında eğitim aldığım &amp;uuml;niversitenin elektronik ders se&amp;ccedil;me uygulaması &amp;uuml;zerinde keşfetmiş olduğum kritik g&amp;uuml;venlik zafiyetini &amp;uuml;niversite y&amp;ouml;netimi ile paylaşmam ile başladı. Bu paylaşım &amp;uuml;zerine &amp;uuml;niversite y&amp;ouml;netimi tarafından başarı bursu ile &amp;ouml;d&amp;uuml;llendirildim ve Ethical Hacker olarak işe alındım. 2006 yılında Yeditepe &amp;Uuml;niversitesi, Bilişim Sistemleri ve Teknolojileri b&amp;ouml;l&amp;uuml;m&amp;uuml;nden mezun oldum. 2009 yılında ise Yeditepe &amp;Uuml;niversitesi, İngilizce İşletme (MBA) programını tamamladım.&lt;/p&gt;\r\n\r\n&lt;p&gt;2007 yılından bu yana Finansbank&amp;rsquo;ın Bilgi Teknolojileri firması olan IBTech firmasında Senior Penetration Tester / Ethical Hacker olarak &amp;ccedil;alışmaktayım. Penetrasyon testinin yanı sıra zararlı yazılım analizi, tersine m&amp;uuml;hendislik ve adli bilişim analizi gibi bir &amp;ccedil;ok alanda uzmanlaşmaktayım.&lt;/p&gt;\r\n\r\n&lt;p&gt;Boş vakitlerimi g&amp;uuml;venlik zafiyeti araştırarak, zararlı yazılım analizi ger&amp;ccedil;ekleştirerek, g&amp;uuml;venlik ara&amp;ccedil;ları geliştirerek ve toplumun bilgi g&amp;uuml;venliği farkındalığını arttırmak amacıyla kişisel web sayfamda &amp;nbsp;Bilişim G&amp;uuml;venliği &amp;uuml;zerine makaleler yayımlayarak ge&amp;ccedil;irmekteyim.&lt;/p&gt;', '2020-05-25 00:00:00', 'hacking', 1, 243),
(481, 'about me', '&lt;h2&gt;Hobbies&lt;/h2&gt;\r\n\r\n&lt;hr /&gt;\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://klumim.epizy.com/img/hobby/1.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Keman&lt;/p&gt;\r\n\r\n&lt;p&gt;Bir enstr&amp;uuml;man &amp;ccedil;almak yada &amp;ccedil;almaya &amp;ccedil;alışmak işte b&amp;uuml;t&amp;uuml;n mesele bu.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://klumim.epizy.com/img/hobby/2.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Motosiklet&lt;/p&gt;\r\n\r\n&lt;p&gt;D&amp;ouml;rt tekerlek bedeni iki tekerlek ruhu taşır.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://klumim.epizy.com/img/hobby/3.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Coding&lt;/p&gt;\r\n\r\n&lt;p&gt;Kod, espiri gibidir. A&amp;ccedil;ıklamak zorundaysan k&amp;ouml;t&amp;uuml;d&amp;uuml;r.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://klumim.epizy.com/img/hobby/4.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Kitap&lt;/p&gt;\r\n\r\n&lt;p&gt;Bir damla m&amp;uuml;rekkep bir milyon kişiyi d&amp;uuml;ş&amp;uuml;nd&amp;uuml;rebilir.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://klumim.epizy.com/img/hobby/5.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Film&lt;/p&gt;\r\n\r\n&lt;p&gt;Alternatif evrenlere bir yolculuk.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;img alt=&quot;&quot; src=&quot;http://klumim.epizy.com/img/hobby/6.jpg&quot; /&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Arduino&lt;/p&gt;\r\n\r\n&lt;p&gt;Teknolojinin geldiği son nokta&amp;nbsp;&lt;code&gt;Arduino =P&lt;/code&gt;&lt;/p&gt;', '2020-05-23 00:00:00', 'yazılım ve okul, alaylı yazılımcı', 1, 243),
(483, 'my_blog_project', '&lt;h3&gt;&amp;hellip;or create a new repository on the command line&lt;/h3&gt;\r\n\r\n&lt;pre&gt;\r\necho &amp;quot;# my_blog_project&amp;quot; &amp;gt;&amp;gt; README.md\r\ngit init\r\ngit add README.md\r\ngit commit -m &amp;quot;first commit&amp;quot;\r\ngit remote add origin https://github.com/ozgurkokturk/my_blog_project.git\r\ngit push -u origin master\r\n                &lt;/pre&gt;\r\n\r\n&lt;h3&gt;&amp;hellip;or push an existing repository from the command line&lt;/h3&gt;\r\n\r\n&lt;pre&gt;\r\ngit remote add origin https://github.com/ozgurkokturk/my_blog_project.git\r\ngit push -u origin master&lt;/pre&gt;', '2020-05-26 00:00:00', 'github', 1, 252);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_counter`
--

DROP TABLE IF EXISTS `blog_counter`;
CREATE TABLE IF NOT EXISTS `blog_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitor_ip` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `device` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `browser` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `system` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `current_page` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp(),
  `content_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1227 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `blog_posts` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=427 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `user_id`, `content_id`) VALUES
(347, 1, 404),
(369, 3, 426),
(370, 3, 427),
(371, 3, 428),
(409, 1, 466),
(410, 1, 467),
(411, 1, 468),
(420, 1, 477),
(421, 1, 478),
(422, 1, 479),
(424, 1, 481),
(426, 1, 483);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_title`
--

DROP TABLE IF EXISTS `blog_title`;
CREATE TABLE IF NOT EXISTS `blog_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `home_title` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `home_subtitle` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blog_title`
--

INSERT INTO `blog_title` (`id`, `home_title`, `home_subtitle`) VALUES
(1, 'Bir şeyi öğrenmek için, her şeyden önce onu sevmek gerekir.', 'Html, Css, Bootstrap, Javascript, Jquery, Php, Mysql, Linux, ve Gezi...');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_user`
--

DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE IF NOT EXISTS `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `yetki` int(1) NOT NULL,
  `hakkimda` mediumtext COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blog_user`
--

INSERT INTO `blog_user` (`id`, `user_name`, `password`, `email`, `yetki`, `hakkimda`) VALUES
(1, 'özgür köktürk', '123', 'ozgurkokturk07@gmail.com', 1, '&lt;div class=&quot;container&quot;&gt;\r\n&lt;div class=&quot;row&quot;&gt;\r\n\r\n&lt;div class=&quot;col-sm-3 mb-5&quot;&gt;\r\nHtml\r\n&lt;div class=&quot;progress&quot;&gt;\r\n  &lt;div class=&quot;progress-bar bg-success  progress-bar-striped&quot; role=&quot;progressbar&quot; style=&quot;width: 95%&quot; aria-valuenow=&quot;25&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;95&quot;&gt;Loading...&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;br&gt;\r\n\r\nCss\r\n&lt;div class=&quot;progress&quot;&gt;\r\n  &lt;div class=&quot;progress-bar  progress-bar-striped progress-bar-animated&quot; role=&quot;progressbar&quot; style=&quot;width: 85%&quot; aria-valuenow=&quot;50&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;Loading..&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;br&gt;\r\n\r\nJquery\r\n&lt;div class=&quot;progress&quot;&gt;\r\n  &lt;div class=&quot;progress-bar bg-warning  progress-bar-striped progress-bar-animated&quot; role=&quot;progressbar&quot; style=&quot;width: 80%&quot; aria-valuenow=&quot;75&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;Loading..&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;br&gt;\r\n\r\nPhp\r\n&lt;div class=&quot;progress&quot;&gt;\r\n  &lt;div class=&quot;progress-bar bg-danger  progress-bar-striped progress-bar-animated&quot; role=&quot;progressbar&quot; style=&quot;width: 75%&quot; aria-valuenow=&quot;100&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;Loading..&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;br&gt;\r\n\r\nSQL\r\n&lt;div class=&quot;progress&quot;&gt;\r\n  &lt;div class=&quot;progress-bar bg-info  progress-bar-striped progress-bar-animated&quot; role=&quot;progressbar&quot; style=&quot;width: 60%&quot; aria-valuenow=&quot;100&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;Loading..&lt;/div&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;\r\nLinux\r\n&lt;div class=&quot;progress&quot;&gt;\r\n  &lt;div class=&quot;progress-bar bg-dark progress-bar-striped progress-bar-animated&quot; role=&quot;progressbar&quot; style=&quot;width: 15%&quot; aria-valuenow=&quot;100&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;Loading..&lt;/div&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;br&gt;\r\nPhotoshop\r\n&lt;div class=&quot;progress&quot;&gt;\r\n  &lt;div class=&quot;progress-bar bg-success progress-bar-striped progress-bar-animated&quot; role=&quot;progressbar&quot; style=&quot;width: 15%&quot; aria-valuenow=&quot;100&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot;&gt;Loading..&lt;/div&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n&lt;div class=&quot;col-sm-9&quot;&gt;\r\nMerhaba, bir kamu kurumunda &quot;Bilgisayar İşletmeni&quot; kadrosunda görev yapıyorum. Bilgisayar\'ın benim için olan hikayesini paylaşmak istiyorum.\r\n\r\nSanırım yıl 1999 veya 2000, dükkanımızda olan ve içinde bir çocuğun ilgisini çekebilecek pek fazla şey bulunmayan win98 yüklü bir bilgisayarla başladı bu yolculuk. O zamanlar bilgisayarı ne amaçla kullandıklarını anlamamıştım benim için bilgisayar; ekran uyku moduna girince efektlerle görsel bir show yapan bir ekrandı sadece.\r\n\r\nSıkılan her çocuk gibi ilgimi çekebilecek şeyler ararken bilgisayarın farklı yönlerini keşfetmiştim. Üzerinde resim yapabileceğim bir penceresi açılabiliyordu. Hatta bunu disket denilen şeylere kaydedip başka bilgisayarlarda da görebiliyordun... Ama bu yönüyle bilgisayar benim gibi resim yapma özürlü biri için hâlâ yeterince ilgi çekici değildi.\r\n\r\nBir gün babamın arkadaşlarından birinin o dandik ekrandan ibaret olarak gördüğüm bilgisayarda fifa98 oynadığını gördüğümde işler değişti. Benim için bilgisayar dünyanın en eğlenceli ekranına dönüşü verdi. Sadece o oyunla aylar yıllar geçirdim. O kadar çok oynadım ki oyunu tasarlayanların bile ön göremeyeceği şeyler keşfetmiş olabilir :) Fifa98\'in İntorusunu izlemek için Tıkla !...\r\n\r\nZamanla fifa98\'in gönlümdeki yerini half-life, Counter Strike, Age Of Empires gibi devrin efsane oyuları aldı. Aslında benim için bilgisyar yıllarca sadece oyun anlamına geldi. Artık oyunların kendisinden ziyade nasıl yapıldığı beni kendine hayran bırakıyor.\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;'),
(3, 'aysel köktürk &lt;3', 'aysel', 'aysel@gmail.com', 2, '1990 yılında Balıkesir Bigadiç’te doğdu. İlk öğrenimini Bigadiç Fatih İlköğretim Okulu, Orta öğrenimi Bigadiç Cumhuriyet Lisesi; yükseköğrenimini Konya Selçuk Üniversitesi Kadınhanı Meslek Yüksekokulu Bilgisayar Teknolojisi ve Programlama Bölümünde tamamladı. Memuriyete 2015 yılında Kırklareli Demirköy Adliyesinde 657 sayılı Kanun’un 4/B maddesi uyarınca Sözleşmeli Zabıt Katibi olarak başlamış olup, 2016 yılında Kırklareli Üniversitesi Bilgisayar İşletmeni kadrosuna atanmıştır. 2016 yılından itibaren Kırklareli Üniversitesi Personel Daire Başkanlığı Bilgisayar İşletmeni kadrosunda başlayıp; halen Kırklareli Üniversitesi Personel Daire Başkanlığı Şef kadrosunda görev yapmaktadır.Evlidir.');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `blog_content`
--
ALTER TABLE `blog_content`
  ADD CONSTRAINT `blog_content` FOREIGN KEY (`category_id`) REFERENCES `blog_category` (`id`);

--
-- Tablo kısıtlamaları `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts` FOREIGN KEY (`content_id`) REFERENCES `blog_content` (`id`),
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `blog_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
