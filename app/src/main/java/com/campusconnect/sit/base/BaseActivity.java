package com.campusconnect.sit.base;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;


public abstract class BaseActivity extends AppCompatActivity {


    protected abstract int layoutID();
    protected abstract void ui();
    protected abstract void function();
    protected abstract Fragment setfragment();
    protected abstract int setContainerId();


    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(layoutID());
        ui();
        function();
    }


    public void FrgamentLoader(){
        getSupportFragmentManager().beginTransaction().replace(setContainerId(), setfragment()).commit();
    }

}
