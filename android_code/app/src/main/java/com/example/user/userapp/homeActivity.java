package com.example.user.userapp;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;


/**
 * Created by jinhee on 2018-09-07.
 */

public class homeActivity extends AppCompatActivity {
   // int clog = 1;
   // String userID = "";
   // int userPW = 0;
  //  static ArrayList<String> sauce_list = new ArrayList<>();
    private boolean sessChk=false;
    private String URL="https://upcyclothes.duckdns.org";
    int maxPage = 5;
    ViewPager viewPager;
    Fragment fragment = new Fragment();
   // IDInformation id = new IDInformation();
    //ImageView refill;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        //로그인 결과로 세션아이디 받으면
        Intent intent = getIntent();
        String sessID=intent.getStringExtra("sessID");

        if(sessID!=null){
            Log.v("sessID",sessID);

            LetsConnect connect = new LetsConnect();
            connect.loggedORNot(URL,sessID);
            //세션유지성공!
            sessChk=true;
        }
        viewPager = (ViewPager) findViewById(R.id.viewpager);

        //상단의 버튼 생성

        final Button loginBtn = (Button) findViewById(R.id.btn_login);
        final Button logoutBtn = (Button) findViewById(R.id.btn_logout);
        LinearLayout l1 = (LinearLayout)findViewById(R.id.l1);
        LinearLayout l1_ = (LinearLayout)findViewById(R.id.l1_);
        if(sessChk==true){
            l1.setVisibility(View.INVISIBLE);
            l1_.setVisibility(View.VISIBLE);
        }
        loginBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();

                    Intent intent = new Intent(homeActivity.this, LoginActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                    finish();

            }
        });
        logoutBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();

                    Intent intent = new Intent(homeActivity.this, homeActivity.class);
                    startActivity(intent);
                    finish();

            }
        });
        Button registerBtn = (Button) findViewById(R.id.btn_register);
        if(sessChk==true){
            registerBtn.setEnabled(false);
        }
        registerBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();
                Intent intent = new Intent(homeActivity.this, SignupActivity.class);
                //intent.putExtra("sauce name",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);

            }
        });
        Button materialBtn = (Button) findViewById(R.id.btn_material);
        materialBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();
                Intent intent = new Intent(homeActivity.this, materialActivity.class);
                //intent.putExtra("sauce name",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);

            }
        });
        Button communityBtn = (Button) findViewById(R.id.btn_community);
        communityBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();
                Intent intent = new Intent(homeActivity.this, CommunityActivity.class);
                //intent.putExtra("sauce name",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);

            }
        });
        Button noticeBtn = (Button) findViewById(R.id.btn_notice);
        noticeBtn .setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();
                Intent intent = new Intent(homeActivity.this, mypageActivity.class);
                //intent.putExtra("sauce name",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);

            }
        });
        //중간 단의 버튼 생성
        Button clothBtn = (Button) findViewById(R.id.btn_cloth);
        Button bagBtn = (Button) findViewById(R.id.btn_bags);
        Button accBtn = (Button) findViewById(R.id.btn_accessories);
        Button shoesBtn = (Button) findViewById(R.id.btn_shoes);
        Button walletBtn = (Button) findViewById(R.id.btn_wallet);


        viewPager.setAdapter(new adapter(getSupportFragmentManager()));
        viewPager.setCurrentItem(0);
        //for fragment
        clothBtn.setOnClickListener(movePageListener);
        clothBtn.setTag(0);
        bagBtn.setOnClickListener(movePageListener);
        bagBtn.setTag(1);
        accBtn.setOnClickListener(movePageListener);
        accBtn.setTag(2);
        shoesBtn.setOnClickListener(movePageListener);
        shoesBtn.setTag(3);
        walletBtn.setOnClickListener(movePageListener);
        walletBtn.setTag(4);

        // 하단의 버튼 생성
        Button homeBtn = (Button) findViewById(R.id.btn_home);
        Button alarmBtn = (Button) findViewById(R.id.btn_alarm);
        Button cartBtn = (Button) findViewById(R.id.btn_cart);
        Button mypageBtn= (Button)findViewById(R.id.btn_mypage);
    }

    View.OnClickListener movePageListener = new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            int tag = (int) v.getTag();
            viewPager.setCurrentItem(tag);
        }
    };

    private class LetsConnect {

        protected void loggedORNot(String url,String sessID) {
            URLConnector task = new URLConnector(url,sessID);
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            if(result.equals("OK")){
                return;
            }
        }
    }

    private class adapter extends FragmentPagerAdapter {
        public adapter(FragmentManager fm) {
            super(fm);
        }

        @Override
        public Fragment getItem(int position) {
            if (position < 0 || maxPage <= position)
                return null;
            switch (position) {
                case 0:
                    fragment = new fragmentCloth();
                    Bundle bundle = new Bundle();
                    //bundle.putStringArrayList("sauce_list", sauce_list);
                    //bundle.putString("userID", userID);
                    fragment.setArguments(bundle);
                    break;
                case 1:
                    fragment = new fragmentBag();
                    //Bundle bundle2 = new Bundle();
                    //bundle2.putStringArrayList("sauce_list", sauce_list);
                    //fragment.setArguments(bundle2);
                    break;
                case 2:
                    fragment = new fragmentAcc();
                    //Bundle bundle3 = new Bundle();
                    //bundle3.putStringArrayList("sauce_list", sauce_list);
                    //fragment.setArguments(bundle3);
                    break;
                case 3:
                    fragment = new fragmentShoes();
                    break;
                case 4:
                    fragment = new fragmentWallet();
                    break;
            }
            return fragment;
        }

        @Override
        public int getCount() {
            return maxPage;
        }
    }
    @Override
    public void onBackPressed() {
        new AlertDialog.Builder(this)
                .setIcon(android.R.drawable.ic_dialog_alert)
                .setTitle("Closing Application")
                .setMessage("Are you sure you want to close this application?")
                .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        finish();
                    }
                })
                .setNegativeButton("No", null)
                .show();
    }
}

