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

public class AdapterReportActivity extends RecyclerView.Adapter<AdapterReportActivity.HolderDataRiwayat> {
    private List<ModalReportActivity> mItems;
    private Context context;

    public AdapterReportActivity(Context context, List<ModalReportActivity> mItems) {
        this.context = context;
        this.mItems = mItems;
    }

    @NonNull
    @Override
    public HolderDataRiwayat onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_report, parent, false);
        HolderDataRiwayat holderDataRiwayat = new AdapterReportActivity.HolderDataRiwayat(layout);
        return holderDataRiwayat;
    }

    @Override
    public void onBindViewHolder(@NonNull final HolderDataRiwayat holder, int position) {
        ModalReportActivity me = mItems.get(position);
        holder.trtanggal.setText(Util.settanggal(me.getTanggal()));
        holder.trkdtrans.setText(me.getKdtransaksi());
        holder.trgrand.setText(me.getGrandtotal());
    }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    public class HolderDataRiwayat extends RecyclerView.ViewHolder {
        TextView trtanggal, trkdtrans, trgrand;

        public HolderDataRiwayat(@NonNull View itemView) {
            super(itemView);
            trtanggal = itemView.findViewById(R.id.tgltransaksi);
            trkdtrans = itemView.findViewById(R.id.kd_transaksi);
            trgrand = itemView.findViewById(R.id.grandtotal);
        }
    }
}
