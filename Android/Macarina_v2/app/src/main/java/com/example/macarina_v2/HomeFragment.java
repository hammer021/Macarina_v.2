package com.example.macarina_v2;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.moeidbannerlibrary.banner.BannerLayout;
import com.example.moeidbannerlibrary.banner.BaseBannerAdapter;

import java.util.ArrayList;
import java.util.List;

public class HomeFragment extends Fragment {

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.activity_home_fragment, container, false);
        //        return super.onCreateView(inflater, container, savedInstanceState);
        BannerLayout banner=(BannerLayout) v.findViewById(R.id.Banner);

        List<String> urls = new ArrayList<>();
        urls.add("https://akcdn.detik.net.id/visual/2019/02/27/ee1de75c-ec00-4d78-84da-5921c986a77a_169.jpeg?w=360&q=90");
        urls.add("https://cf.shopee.co.id/file/8f559d5df43c33f9e78d49316e7688b6");
        urls.add("https://cf.shopee.co.id/file/8f559d5df43c33f9e78d49316e7688b6");
        urls.add("https://cf.shopee.co.id/file/8f559d5df43c33f9e78d49316e7688b6");
        urls.add("https://cf.shopee.co.id/file/8f559d5df43c33f9e78d49316e7688b6");


        BaseBannerAdapter webBannerAdapter=new BaseBannerAdapter(getActivity().getApplicationContext(),urls);
        webBannerAdapter.setOnBannerItemClickListener(new BannerLayout.OnBannerItemClickListener() {
            @Override
            public void onItemClick(int position)
            {


            }
        });
        banner.setAdapter(webBannerAdapter);
    return v;
    }



}
