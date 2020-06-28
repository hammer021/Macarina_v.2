package com.example.macarina_v2;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.example.macarina_v2.configfile.authdata;
import com.synnapps.carouselview.ImageListener;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

public class ShopActivity {
}
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_shop, container, false);
        carouselView = v.findViewById(R.id.Banner);
        carouselView.setPageCount(sampleImage.length);
        view = v.findViewById(R.id.viewLaporan);
        view.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent a = new Intent(getContext(), ReportActivity.class);
                startActivity(a);
            }
        });
        txtlaporan = v.findViewById(R.id.textlaporan);
        txtlaporan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent b = new Intent(getContext(), ReportActivity.class);
                startActivity(b);
            }
        });

        authdataa = new authdata(getContext());
        txtname = v.findViewById(R.id.tName);
        txtname.setText(authdataa.getNamaUser());

        ImageListener imageListener = new ImageListener() {
            @Override
            public void setImageForPosition(int position, ImageView imageView) {
                imageView.setImageResource(sampleImage[position]);
            }
        };

        carouselView.setImageListener(imageListener);
        return v;
    }

