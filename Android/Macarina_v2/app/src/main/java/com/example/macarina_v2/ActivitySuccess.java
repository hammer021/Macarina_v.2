package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class ActivitySuccess extends AppCompatActivity {
    Button btnsuccess;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_success);
        btnsuccess = findViewById(R.id.btnSuccess);
        btnsuccess.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent a = new Intent(ActivitySuccess.this, MainActivity.class);
                startActivity(a);
                finish();
            }
        });
    }
}
