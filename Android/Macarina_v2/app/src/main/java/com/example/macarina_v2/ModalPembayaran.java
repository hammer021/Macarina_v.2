package com.example.macarina_v2;

public class ModalPembayaran {
    private String kd_transaksiPem;
    private String tgl_transaksiPem;
    private String total_pembayaranPem;
    private String status_bayarPem;

    public String getKd_transaksiPem() {
        return kd_transaksiPem;
    }

    public void setKd_transaksiPem(String kd_transaksiPem) {
        this.kd_transaksiPem = "Kode Transaksi : " + kd_transaksiPem;
    }

    public String getTgl_transaksiPem() {
        return tgl_transaksiPem;
    }

    public void setTgl_transaksiPem(String tgl_transaksiPem) {
        this.tgl_transaksiPem = tgl_transaksiPem;
    }

    public String getTotal_pembayaranPem() {
        return total_pembayaranPem;
    }

    public void setTotal_pembayaranPem(String total_pembayaranPem) {
        this.total_pembayaranPem = "Total Pembayaran : " + total_pembayaranPem;
    }

    public String getStatus_bayarPem() {
        return status_bayarPem;
    }

    public void setStatus_bayarPem(String status_bayarPem) {
        this.status_bayarPem = "Status Pembayaran : " + status_bayarPem;
    }

}
