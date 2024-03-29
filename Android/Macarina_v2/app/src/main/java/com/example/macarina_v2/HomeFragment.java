package com.example.macarina_v2;

import androidx.annotation.MainThread;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.macarina_v2.configfile.authdata;
import com.synnapps.carouselview.CarouselView;
import com.synnapps.carouselview.ImageListener;

import java.util.ArrayList;
import java.util.List;

public class HomeFragment extends Fragment {
    CarouselView carouselView;
    int[] sampleImage = {
            R.drawable.slideshownya,
            R.drawable.slideshownyaa,
            R.drawable.slideshownyaaa,
            R.drawable.slideshownyaaaa
    };

    View view, view2;
    TextView txtlaporan, txtname, txtlokasi;
    authdata authdataa;
    ImageView order1, carts, order2, pay;


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_home_fragment, container, false);
        carouselView = v.findViewById(R.id.Banner);
        carouselView.setPageCount(sampleImage.length);

        carts = v.findViewById(R.id.Cart);
        carts.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent cartsss = new Intent(getContext(), ActivityCart.class);
                startActivity(cartsss);
            }
        });

        pay = v.findViewById(R.id.Payment);
        pay.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent paayy = new Intent(getContext(), ActivityPembayaran.class);
                startActivity(paayy);
            }
        });

        order1 = v.findViewById(R.id.imageorder1);
        order1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent ord = new Intent(getContext(), ActivityPilihVarian.class);
                startActivity(ord);
            }
        });

        order2 = v.findViewById(R.id.imageorder2);
        order2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent ord2 = new Intent(getContext(), ActivityCheckoutBox.class);
                startActivity(ord2);
            }
        });

//        view = v.findViewById(R.id.viewLaporan);
//        view.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                Intent a = new Intent(getContext(), ReportActivity.class);
//                startActivity(a);
//            }
//        });
//        txtlaporan = v.findViewById(R.id.textlaporan);
//        txtlaporan.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//                Intent b = new Intent(getContext(), ReportActivity.class);
//                startActivity(b);
//            }
//        });
//        view2 = v.findViewById(R.id.viewLocation);
//        view2.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent map = new Intent(getActivity(), MapsActivity.class);
//                startActivity(map);
//            }
//        });
//        txtlokasi = v.findViewById(R.id.textView13);
//        txtlokasi.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent map2 = new Intent(getActivity(), MapsActivity.class);
//                startActivity(map2);
//            }
//        });
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



}
