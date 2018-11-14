package com.example.user.upcyclothes;


import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;


public class listAdapter extends BaseAdapter {
    private Context context;

    private String[] itemName;
    private String[] itemDate;

    public  listAdapter (Context con, String[] s1, String[] s2){
        this.context=con;

        this.itemName=s1;
        this.itemDate=s2;
    };
    @Override
    public int getCount() {
        return itemName.length;
    }

    @Override
    public String[] getItem(int pos){
        String[] item= new String[2];
        item[0]=itemName[pos];
        item[1]=itemDate[pos];
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
        ((listItem)convertView).setData(itemName[position],itemDate[position]);
        return convertView;
    }
}
