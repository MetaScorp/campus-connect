package com.campusconnect.sit.ui.fragments;

import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import com.bumptech.glide.Glide;
import com.campusconnect.sit.R;

public class ImageViewFragment extends Fragment {

    private static final String ARG_URL = "image_url";

    private String imageUrl;

    public static ImageViewFragment getInstance(String url) {
        ImageViewFragment fragment = new ImageViewFragment();

        Bundle bundle = new Bundle();
        bundle.putString(ARG_URL, url);
        fragment.setArguments(bundle);

        return fragment;
    }

    @Override
    public View onCreateView(LayoutInflater inflater,
                             ViewGroup container,
                             Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_image_view, container, false);

        ImageView imageView = (ImageView) view.findViewById(R.id.image_view);

        if (getArguments() != null) {
            imageUrl = getArguments().getString(ARG_URL);
        }

        if (imageUrl != null && !imageUrl.isEmpty()) {
            Glide.with(this)
                    .load(imageUrl)
                    .into(imageView);
        }

        return view;
    }
}