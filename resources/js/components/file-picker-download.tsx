import React from "react";
import { FilePicker } from "@/components/file-picker";
import { IconDownload } from "justd-icons";
import { Link } from "react-aria-components";
import { Button } from "@/components/ui";

type FilePickerLayoutProps = {
    label: string;
    name: string;
    value?: string | null;
    onChange: (files: FileList | null) => void;
    accept?: string;
    isRequired?: boolean;
    prefix?: React.ReactNode;
    ref?: React.RefObject<HTMLInputElement>;
};

export const FilePickerDownload: React.FC<FilePickerLayoutProps> = ({
    label,
    name,
    value,
    onChange,
    accept,
    isRequired,
    prefix,
    ref,
}) => {
    const computedIsRequired = !value && isRequired;
    return (
        <div className="mb-4 col-span-6 flex items-center gap-4">
            <div className="flex-grow">
                <FilePicker
                    className="w-full"
                    label={label}
                    name={name}
                    value={value}
                    onChange={onChange}
                    accept={accept}
                    isRequired={computedIsRequired}
                    prefix={prefix}
                    ref={ref}
                />
                <span className="text-sm text-muted-fg">
                    Selected File: {value ? value.split("/").pop() : ""}
                </span>
            </div>
            {value && (
                <FileDownload href={value} />
            )}
        </div>
    );
};

type FileDownloadProps = {
    href: string;
};

const FileDownload: React.FC<FileDownloadProps> = ({ href }) => (
    <Link className="mt-2" href={href} target="_blank">
        <Button size="medium" appearance="outline" className="whitespace-nowrap">
            <IconDownload />
            Download
        </Button>
    </Link>
);
