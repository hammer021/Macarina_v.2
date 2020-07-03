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

public class AdapterCart extends RecyclerView.Adapter<AdapterCart.MyViewHolder> {
    private List<ModalCart> item;
    private Context context;

    public AdapterCart(Context context, List<ModalCart> item){
        this.context = context;
        this.item = item;
    }

    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_cart, parent, false);
        MyViewHolder myViewHolder = new AdapterCart.MyViewHolder(layout);
        return myViewHolder;
    }

    public void onBindViewHolder(@NonNull final MyViewHolder holder, int position) {
        ModalCart me = item.get(position);
        holder.qty_det.setText(me.getQty_det());
        holder.subtotal.setText(me.getSubtotal());
        holder.nama_barang.setText(me.getNama_barang());
        holder.harga.setText(me.getHarga());
    }

    public int getItemCount() {
        return item.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder{
        TextView qty_det, subtotal, nama_barang, harga;
        public MyViewHolder(View itemView){
            super(itemView);
            qty_det = itemView.findViewById(R.id.teksqty_det);
            subtotal = itemView.findViewById(R.id.tekssbttl);
            nama_barang = itemView.findViewById(R.id.teksnm_brg);
            harga = itemView.findViewById(R.id.tekshrg_brg);
        }
    }
}

