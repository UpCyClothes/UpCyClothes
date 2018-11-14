package com.example.user.upcyclothes;


import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.List;

/**
 * Created by user on 2018-10-11.
 */

public class fragmentFAQ extends Fragment{
    private String[] itemID;
    private String[] subject;
    private String[] content;
    private String[] updated;
    private String[] noticeImg;

    DisplayMetrics mMetrics;
    View v;

    public fragmentFAQ(){
        LetsConnect c = new LetsConnect();
        c.getItemInfo();

    }

    private ListView.OnItemClickListener listviewOnItemClickListener
            = new ListView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
            Intent intent = new Intent(getActivity(), DetailNotice.class);

            intent.putExtra("category","FAQ");
            intent.putExtra("item id",itemID[arg2]);
            intent.putExtra("item name",subject[arg2]);
            intent.putExtra("item content",content[arg2]);
            intent.putExtra("item date",updated[arg2]);
            intent.putExtra("item detail url",noticeImg[arg2]);
            startActivity(intent);
        }
    };
    @Override

    public void onCreate(Bundle savedInstanceState)
    {

//
//
//        }

        super.onCreate(savedInstanceState);
    }

    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/communityInfo.php", "noticeType=2",false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            Log.v("result",result);
            parsingItem(result);
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }
        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    itemID=new String[Integer.parseInt(num)];
                    subject=new String[Integer.parseInt(num)];
                    content=new String[Integer.parseInt(num)];
                    updated=new String[Integer.parseInt(num)];
                    noticeImg=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        itemID[i]=jo.getString("noticeID");
                        subject[i]=jo.getString("subject");
                        content[i]=jo.getString("content");
                        updated[i]=jo.getString("updated");
                        noticeImg[i]="https://upcyclothes.duckdns.org"+jo.getString("noticeImg");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState)
    {
        // WebGetImage webGetImage=new WebGetImage();
        //  webGetImage.doInBackground();




        // RelativeLayout layout = (RelativeLayout) inflater.inflate(R.layout.fragment_bag, container, false);
        v = inflater.inflate(R.layout.fragment_notice, container, false);
        ListView listview = (ListView) v.findViewById(R.id.listview);

        listAdapter adapter= new listAdapter(this.getContext(),subject,updated);
        listview.setAdapter(adapter);

        listview.setOnItemClickListener(listviewOnItemClickListener);
        mMetrics = new DisplayMetrics();
        getActivity().getWindowManager().getDefaultDisplay().getMetrics(mMetrics);

        return v;
    }


}
