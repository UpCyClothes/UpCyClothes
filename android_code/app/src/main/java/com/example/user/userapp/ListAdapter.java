package com.example.user.userapp;

import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;


public class ListAdapter extends BaseAdapter {
    private Context context;

    private String[] itemName;


    public  ListAdapter (Context con, String[] s1){
        this.context=con;

        this.itemName=s1;
    };
    @Override
    public int getCount() {
        return itemName.length;
    }

    @Override
    public String getItem(int pos){
        String item= "";
        item=itemName[pos];
        return item;
    }

    @Override
    public  long getItemId(int pos){
        return pos;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(convertView == null){
            convertView= new listItem(context);
        }
        ((listItem)convertView).setData(itemName[position]);
        return convertView;
    }
}
