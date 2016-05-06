function [] = Preprocess(in_file, out_file)
im = Binarize(in_file);
imwrite(im, out_file);
end

