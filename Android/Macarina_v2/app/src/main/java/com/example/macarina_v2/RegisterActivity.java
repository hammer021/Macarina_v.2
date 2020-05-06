package com.example.macarina_v2;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class RegisterActivity extends AppCompatActivity {
    TextView masuk;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        masuk = findViewById(R.id.tmasuk);
        masuk.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent masuk = new Intent(RegisterActivity.this , LoginActivity.class);
                startActivity(masuk);
            }
        });
    }
}
