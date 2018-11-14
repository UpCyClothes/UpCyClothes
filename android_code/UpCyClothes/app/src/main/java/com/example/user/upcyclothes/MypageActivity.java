package com.example.user.upcyclothes;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class MypageActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mypage);

        TextView idTV= (TextView)findViewById(R.id.idTV);
        idTV.setText(MainActivity.userID+" 고객님");

        Button mycartBtn = (Button)findViewById(R.id.mycartBtn);
        Button orderBtn = (Button)findViewById(R.id.orderBtn);
        Button messengerBtn = (Button)findViewById(R.id.messengerBtn);
        Button logoutBtn = (Button)findViewById(R.id.logoutBtn);

        mycartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Log.v("장바구니 버튼","눌림");
                Intent intent = new Intent(MypageActivity.this, MycartActivity.class);
                startActivity(intent);
                finish();

            }
        });
        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                Intent intent = new Intent(MypageActivity.this, MyOrderActivity.class);
                startActivity(intent);
                finish();

            }
        });
        logoutBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //세션 정보 지우기
                MainActivity.userID=null;
                Intent intent = new Intent(MypageActivity.this, MainActivity.class);
                startActivity(intent);
                finish();

            }
        });
    }
}
