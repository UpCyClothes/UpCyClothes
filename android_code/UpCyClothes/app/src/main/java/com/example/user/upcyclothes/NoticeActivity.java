package com.example.user.upcyclothes;



import android.content.Intent;
import android.support.design.widget.NavigationView;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.GravityCompat;
import android.support.v4.view.ViewPager;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.widget.ImageView;

public class NoticeActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    Button noticeBtn;
    Button faqBtn;
    ViewPager viewPager;
    int maxPage = 2;
    Fragment fragment = new Fragment();

    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notice);

        noticeBtn = (Button)findViewById(R.id.noticeBtn);
        faqBtn = (Button)findViewById(R.id.faqBtn);

        viewPager = (ViewPager) findViewById(R.id.viewpager);

        viewPager.setAdapter(new adapter(getSupportFragmentManager()));
        viewPager.setCurrentItem(0);
        //for fragment
        noticeBtn.setOnClickListener(movePageListener);
        noticeBtn.setTag(0);
        faqBtn.setOnClickListener(movePageListener);
        faqBtn.setTag(1);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        toggle.getDrawerArrowDrawable().setColor(getColor(R.color.colorMain));

        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);


        //툴바의 버튼
        // final ImageView alarmBtn= (ImageView) findViewById(R.id.alarmBtn);
        final ImageView cartBtn= (ImageView) findViewById(R.id.cartBtn);
        final ImageView personBtn= (ImageView) findViewById(R.id.personBtn);
        //새로운 문의가 있을 경우에 보여지고 없으면 안보여진다.

        //툴바 버튼리스너
        personBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();
                if(MainActivity.userID==null) {
                    Intent intent = new Intent(NoticeActivity.this, LoginActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                    //finish();
                }
                else{
                    //마이페이지 고고
                    Intent intent = new Intent(NoticeActivity.this, MypageActivity.class);
                    startActivityForResult(intent,2000);
                }
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(MainActivity.userID==null) {
                    Intent intent = new Intent(NoticeActivity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    Intent intent = new Intent(NoticeActivity.this, MycartActivity.class);
                    startActivity(intent);
                }
            }
        });


    }
    View.OnClickListener movePageListener = new View.OnClickListener() {
                @Override
        public void onClick(View v) {
            int tag = (int) v.getTag();
            viewPager.setCurrentItem(tag);
//                    if(tag==0){
//                        faqBtn.setTextColor(getResources().getColor(R.color.colorGray));
//                    }
//                    else{
//                        noticeBtn.setTextColor(getResources().getColor(R.color.colorGray));
//                    }
        }
    };

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        if(resultCode== RESULT_OK){
            //요청할 때 보낸 요청코드 (3000)
            switch(requestCode) {
                case 2000:
                    Log.v("notice","in");
                    break;
            }
        }
    }
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_new) {
            // Handle the camera action
            Intent intent = new Intent(NoticeActivity.this, NewActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_clo) {
            Intent intent = new Intent(NoticeActivity.this, ClothActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_bag) {
            Intent intent = new Intent(NoticeActivity.this, BagActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_acce) {
            Intent intent = new Intent(NoticeActivity.this, AccActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_shoes) {
            Intent intent = new Intent(NoticeActivity.this, ShoesActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_jewelry) {
            Intent intent = new Intent(NoticeActivity.this, JewActivity.class);
            startActivity(intent);

        } else if (id == R.id.nav_material) {
            Intent intent = new Intent(NoticeActivity.this, MaterialActivity.class);
            startActivity(intent);
        }else if (id == R.id.nav_notice) {
            Intent intent = new Intent(NoticeActivity.this, NoticeActivity.class);
            startActivity(intent);
        } else if (id == R.id.nav_commu) {
            Intent intent = new Intent(NoticeActivity.this, CommunityActivity.class);
            startActivity(intent);

        }else if (id == R.id.nav_messen) {
            Intent intent = new Intent(NoticeActivity.this, MessengerActivity.class);
            startActivity(intent);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
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
                    fragment = new fragmentNotice();

                    break;
                case 1:
                    fragment = new fragmentFAQ();

                    break;
            }
            return fragment;
        }
        @Override
        public int getCount() {
            return maxPage;
        }
    }
}
