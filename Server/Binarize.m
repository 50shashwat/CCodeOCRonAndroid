function [ bin_im ] = Binarize(im_file)

% Load image
im = imread(im_file);

% convert to gray scale
if(size(im, 3) == 3)
    im = rgb2gray(im);
end

im = im2double(im);

[height, width] = size(im);    
    
bin_im = zeros(height, width);

winHalfWidth = 10; 
localVarThresh = 0.002;

for col = 1:winHalfWidth:width
inCols = max(1,col-winHalfWidth) : min(width,col+winHalfWidth); 
    for row = 1:winHalfWidth:height
        inRows = max(1,row-winHalfWidth) : min(height,row+winHalfWidth);
        inTile = im(inRows, inCols);
        localThresh = graythresh(inTile);
        %localMean = mean2(inTile); 
        localVar = std2(inTile)^2; 
        if localVar > localVarThresh
            bin_im(inRows,inCols) = im2bw(im(inRows,inCols), localThresh);
        else
            bin_im(inRows,inCols) = 1;
        end
    end
end % col
    
% Remove samll region
bin_im = imopen(bin_im, ones(3,3));

% imwrite(bin_im, output_file);
end

