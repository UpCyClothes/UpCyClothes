package com.example.user.upcyclothes;



import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;

public class NoticeActivity extends AppCompatActivity  {

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
