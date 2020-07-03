package com.example.macarina_v2;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.macarina_v2.configfile.Util;

import java.util.List;

public class AdapterPembayaran extends RecyclerView.Adapter<AdapterPembayaran.MyViewHolder> {
    private List<ModalPembayaran> item;
    private Context context;
    private OnHistoryClickListener listener;

    public interface OnHistoryClickListener{
        public void onClick(int position);
    }

    public void setListener(OnHistoryClickListener listener) {
        this.listener = listener;
    }

    public AdapterPembayaran(Context context, List<ModalPembayaran> item){
        this.context = context;
        this.item = item;
    }

    public AdapterPembayaran.MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_pembayaran, parent, false);
        AdapterPembayaran.MyViewHolder myViewHolder = new AdapterPembayaran.MyViewHolder(layout, listener);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final AdapterPembayaran.MyViewHolder holder, int position) {
        ModalPembayaran me = item.get(position);
        holder.kd_transaksi.setText(me.getKd_transaksiPem());
        holder.tgl_transaksi.setText(Util.settanggal(me.getTgl_transaksiPem()));
        holder.total_pembayaran.setText(me.getTotal_pembayaranPem());
        holder.status_bayar.setText(me.getStatus_bayarPem());
    }

    public int getItemCount() {
        return item.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder{
        TextView kd_transaksi, tgl_transaksi, total_pembayaran, status_bayar;
        public MyViewHolder(View itemView, final OnHistoryClickListener listener){
            super(itemView);
            kd_transaksi = itemView.findViewById(R.id.kd_transaksi_pem);
            tgl_transaksi = itemView.findViewById(R.id.tgltransaksi_pem);
            total_pembayaran = itemView.findViewById(R.id.total_pem);
            status_bayar = itemView.findViewById(R.id.stsbyr);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (listener != null){
                        int position = getAdapterPosition();
                        if (position != RecyclerView.NO_POSITION){
                            listener.onClick(position);
                        }
                    }
                }
            });
        }
    }
}
