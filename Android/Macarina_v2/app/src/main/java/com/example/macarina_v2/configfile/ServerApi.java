package com.example.macarina_v2.configfile;

public class ServerApi {
      public static final String IPServer="http://macarinaid.wsjti.com/RestApi/";
 //     public static final String IPServer="http://192.168.100.88/Macarina_v.2/Web/RestApi/";
    public static final String URL_REGIS=IPServer+"api/RegistrasiReseller";
    public static final String URL_LOGIN=IPServer+"api/Reseller";
    public static final String URL_USER=IPServer+"api/EditUser?id_reseller=";
    public static final String URL_PUT_USER=IPServer+"api/EditUser";
    public static final String URL_CART=IPServer+"api/DetTrans?id_reseller=";
    public static final String URL_ADDCART=IPServer+"api/DetTrans?kd_barang=";
    public static final String URL_GRAND=IPServer+"api/Trans/grand?id_reseller=";
    public static final String URL_TRANSPEM=IPServer+"api/Trans";
    public static final String URL_BERAT=IPServer+"api/Trans/berat?id_reseller=";
    public static final String URL_BRGORI=IPServer+"api/Barang/ori";
    public static final String URL_BRGCKL=IPServer+"api/Barang/coklat";
    public static final String URL_BRGBOX=IPServer+"api/Barang/box";
    public static final String URL_DETPEM=IPServer+"api/Trans/trans";
    public static final String URL_BAYARBOS=IPServer+"api/Trans/bayartrans";
    public static final String URL_BELUMBAYAR=IPServer+"api/Trans/transBelum?id_reseller=";
    public static final String URL_SUDAHBAYAR=IPServer+"api/Trans/transSudah?id_reseller=";
    public static final String URL_PASFOTO="http://macarinaid.wsjti.com/uploads/reseller/pas_foto/";
    public static final String URL_GAMBARBRG="http://macarinaid.wsjti.com/uploads/barang/";
}
